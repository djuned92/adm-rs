<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	/*
	* AUTH
	* ====================================================================
	*/
	public function login()
	{
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$device_token = $this->input->post('device_token');
		$user 		= $this->global->getCond('users','*', ['username' => $username])->row_array();
	
		if(!empty($user)) {
			if(password_verify($password, $user['password'])) {
				$data_user = [
					'logged_in' => TRUE,
					'id'		=> $user['id'],
					'username'	=> $user['username'],
					'device_token' => $device_token,
				];

				// update last login
				$data['last_login'] = date('Y-m-d H:i:s');
				$data['device_token'] = ($device_token != null) ? $device_token : NULL;
				(isset($user['id'])) ? $this->global->update('users', $data, array('id'=> $user['id'])) : '';

				$response['code']  	= 200;
				$response['error'] 	= FALSE;
				$response['user']  	= $data_user;
			} else {
				$response['code'] 	= 400;
				$response['error'] 	= TRUE;
				$response['message'] 	= 'Wrong password';
			}
		} else {
			$response['code'] 	= 404;
			$response['error'] 	= TRUE;
			$response['message']	= 'User not found';
		}

		echo json_encode($response);
	}

	public function logout()
	{
		$id 		= $this->input->post('id');
		$username 	= $this->input->post('username');

		$user = $this->global->getCond('users','*', ['username' => $username])->row_array();
		
		if(!empty($id)) {
			// update last login
			$data['last_login'] 	= date('Y-m-d H:i:s');
			$data['device_token'] 	= NULL;
			(isset($user['id'])) ? $this->global->update('users', $data, array('id'=> $user['id'])) : '';

			$response['code']  	= 200;
			$response['error'] 	= FALSE;
			$response['message']= 'Success Logout';
		}

		echo json_encode($response);
	}

	public function register()
	{
		$this->db->trans_begin();
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$options = [
		    'cost' => 11,
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
		
		$data = [
			'username'	=> $username,
			'password'	=> $password_hash,
			'role_id'	=> 2,
			'created_at'=> date('Y-m-d H:i:s'),
		];

		$user_id = $this->global->create('users', $data, TRUE);

		$data_profile = [
			'user_id'	=> $user_id,
			'fullname'	=> $this->input->post('fullname'),
			'address'	=> $this->input->post('address'),
			'phone'		=> $this->input->post('phone'),
			'email'		=> $this->input->post('email'),
			'gender'	=> $this->input->post('gender'),
			'created_at'=> date('Y-m-d H:i:s'),
		];

		$this->global->create('profiles', $data_profile);

		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $response['code']		= 501;
			$response['error']	= FALSE;
			$response['message']	= 'Failed registered!';
        } else {
        	$this->db->trans_commit();
			$response['code']		= 200;
			$response['error']	= FALSE;
			$response['message']	= 'Success registered!';
        }

		echo json_encode($response);	
	}

	/*
	* ====================================================================
	* END AUTH
	*/


	/*
	* PROFILE
	* ====================================================================
	*/
	public function get_profile_by_id($id)
	{
		$profile = $this->global->getCond('profiles','*',['user_id'=>$id]);

		if($profile->num_rows() > 0) {
			$data 		= $profile->row_array();
			$url_image 	= ($data['photo'] == NULL) ? ['url_photo' => base_url('assets/images/no-image.png')]:['url_photo' => base_url('assets/images/profiles/').$data['photo']];
			$data_profile = array_merge($data,$url_image);

			$response['code']		= 200;
			$response['error']		= FALSE;
			$response['profile']	= $data_profile;
		} else {
			$response['code']		= 404;
			$response['error']		= TRUE;
			$response['message']	= 'Profile not found!';			
		}

		echo json_encode($response);
	}
	
	public function update_profile()
	{
	    $id = $this->input->post('id');
	    $data_profile = [
			'fullname'	=> $this->input->post('fullname'),
			'address'	=> $this->input->post('address'),
			'phone'		=> $this->input->post('phone'),
			'email'		=> $this->input->post('email'),
			'gender'	=> $this->input->post('gender')
	    ];

		$update = $this->global->update('profiles', $data_profile,['user_id'=>$id]);
		
		if($update == FALSE) {
			$response['code'] 	= 204;
			$response['error']	= TRUE;
			$response['message']= 'No content profile to updated!';
		} else {
			$response['code'] 	= 200;
			$response['error']	= FALSE;
			$response['message']= 'Profile has been updated!';
		}
		
		echo json_encode($response);
	}
	
	public function update_photo_profile()
	{
		$this->load->library('upload');

		$config['upload_path'] 		= './assets/images/profiles/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']  		= 2048;
		$config['encrypt_name'] 	= TRUE;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			$response['error'] = $error;
		} else {
			// print_r($this->upload->data());die();
			$id = $this->input->post('id');

			$data_profile = [
				'photo'	=> $this->upload->data('file_name'),
			];

			$update = $this->global->update('profiles', $data_profile, ['user_id'=>$id]);
					
			if($update == FALSE) {
				$response['code'] 	= 204;
				$response['error']	= TRUE;
				$response['message']= 'No content profile to updated!';
			} else {
				$response['code'] 	= 200;
				$response['error']	= FALSE;
				$response['message']= 'Profile has been updated!';
			}
		}
		echo json_encode($response);
	}
	/*
	* ====================================================================
	* END PROFILE
	*/


	/*
	* RUMAH SAKIT
	* ====================================================================
	*/
	private function check_null($item)
	{
		$data = [];
		foreach ($item as $key => $value) {
			$data[$key] = (empty($value) ? '-' : $value);
		}

		return $data;
	}

	public function get_rs()
	{
		$rumah_sakit 	= $this->global->getJoin('rumah_sakit','rumah_sakit.*, jenis_rumah_sakit.description',
							['jenis_rumah_sakit'=>'rumah_sakit.jenis_rumah_sakit_id = jenis_rumah_sakit.id'])->result_array();
		$jadwal 		= $this->global->get('jadwal_rumah_sakit','*',['id'=>'ASC']);
		$image 			= $this->global->get('foto_rumah_sakit');

		$data_rumah_sakit = [];
		foreach ($rumah_sakit as $key => $value) {
			if($jadwal->num_rows() > 0) {	
				foreach ($jadwal->result_array() as $key2 => $value2) {
					if($value['id'] == $value2['rumah_sakit_id']) {
						$value['jadwal'][$key2] = $value2;
					} else {
						$value['jadwal'] = '-'; 
					}	
				}
			} else {
				$value['jadwal'] = '-'; 
			}
				
			if($image->num_rows() > 0) {
				foreach ($image->result_array() as $key3 => $value3) {
					if($value['id'] == $value3['rumah_sakit_id']) {
						$value['foto'][$key3] = base_url() . 'assets/images/rumah_sakit/' . $value3['foto'];
					} else {
						$value['foto'] =  base_url() . 'assets/images/no-image.png';
					}
				}
			} else {
				$value['foto'] =  base_url() . 'assets/images/no-image.png';
			}	
			
			$data_rumah_sakit[$key]		= $this->check_null($value);
		}

		if(count($data_rumah_sakit) > 0) {
			$response['code']		= 200;
			$response['error']		= FALSE;
			$response['rumah_sakit']= $data_rumah_sakit;
		} else {
			$response['code']		= 204;
			$response['error']		= TRUE;
			$response['message']	= 'No content rumah sakit!';			
		}

		echo json_encode($response);
	}

	public function get_rs_by_id($id)
	{
		$rumah_sakit 	= $this->global->getCondJoin('rumah_sakit','rumah_sakit.*, jenis_rumah_sakit.description',
							['rumah_sakit.id'=> $id],
							['jenis_rumah_sakit'=>'rumah_sakit.jenis_rumah_sakit_id = jenis_rumah_sakit.id'])->result_array();
		$jadwal 		= $this->global->get('jadwal_rumah_sakit','*',['id'=>'ASC']);
		$image 			= $this->global->get('foto_rumah_sakit');

		$data_rumah_sakit = [];
		foreach ($rumah_sakit as $key => $value) {
			if($jadwal->num_rows() > 0) {	
				foreach ($jadwal->result_array() as $key2 => $value2) {
					if($value['id'] == $value2['rumah_sakit_id']) {
						$value['jadwal'][$key2] = $value2;
					} else {
						$value['jadwal'] = '-'; 
					}	
				}
			} else {
				$value['jadwal'] = '-'; 
			}
				
			if($image->num_rows() > 0) {
				foreach ($image->result_array() as $key3 => $value3) {
					if($value['id'] == $value3['rumah_sakit_id']) {
						$value['foto'][$key3] = base_url() . 'assets/images/rumah_sakit/' . $value3['foto'];
					} else {
						$value['foto'] =  base_url() . 'assets/images/no-image.png';
					}
				}
			} else {
				$value['foto'] =  base_url() . 'assets/images/no-image.png';
			}	
			 
			$data_rumah_sakit[$key]		= $this->check_null($value);
		}

		if(count($data_rumah_sakit) > 0) {
			$response['code']		= 200;
			$response['error']		= FALSE;
			$response['rumah_sakit']= $data_rumah_sakit;
		} else {
			$response['code']		= 404;
			$response['error']		= TRUE;
			$response['message']	= 'Rumah sakit not found!';			
		}

		echo json_encode($response);	
	}

	public function get_rs_by_tipe($tipe)
	{
		$rumah_sakit 	= $this->global->getCondJoin('rumah_sakit','rumah_sakit.*, jenis_rumah_sakit.description',
							['rumah_sakit.jenis_rumah_sakit_id'=> $tipe],
							['jenis_rumah_sakit'=>'rumah_sakit.jenis_rumah_sakit_id = jenis_rumah_sakit.id'])->result_array();
		$jadwal 		= $this->global->get('jadwal_rumah_sakit','*',['id'=>'ASC']);
		$image 			= $this->global->get('foto_rumah_sakit');

		$data_rumah_sakit = [];
		foreach ($rumah_sakit as $key => $value) {
			if($jadwal->num_rows() > 0) {	
				foreach ($jadwal->result_array() as $key2 => $value2) {
					if($value['id'] == $value2['rumah_sakit_id']) {
						$value['jadwal'][$key2] = $value2;
					} else {
						$value['jadwal'] = '-'; 
					}	
				}
			} else {
				$value['jadwal'] = '-'; 
			}
				
			if($image->num_rows() > 0) {
				foreach ($image->result_array() as $key3 => $value3) {
					if($value['id'] == $value3['rumah_sakit_id']) {
						$value['foto'][$key3] = base_url() . 'assets/images/rumah_sakit/' . $value3['foto'];
					} else {
						$value['foto'] =  base_url() . 'assets/images/no-image.png';
					}
				}
			} else {
				$value['foto'] =  base_url() . 'assets/images/no-image.png';
			}	
			
			$data_rumah_sakit[$key]		= $this->check_null($value);
		}

		if(count($data_rumah_sakit) > 0) {
			$response['code']		= 200;
			$response['error']		= FALSE;
			$response['rumah_sakit']= $data_rumah_sakit;
		} else {
			$response['code']		= 404;
			$response['error']		= TRUE;
			$response['message']	= 'Rumah sakit not found!';			
		}

		echo json_encode($response);
	}

	public function get_jenis_rs()
	{
		$jenis_rs = $this->global->getCond('jenis_rumah_sakit');

		if($jenis_rs->num_rows() > 0) {
			$response['code']		= 200;
			$response['error']		= FALSE;
			$response['jenis_rumah_sakit']	= $jenis_rs->result_array();;
		} else {
			$response['code']		= 404;
			$response['error']		= TRUE;
			$response['message']	= 'No content jenis rumah sakit!';			
		}

		echo json_encode($response);
	}
	/*
	* ====================================================================
	* END RUMAH SAKIT
	*/

}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */