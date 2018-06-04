<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah_sakit extends MX_Controller {

	public function index()
	{
		$this->functions->check_access($this->session->role_id, $this->uri->segment(1)); // access read
		$data['priv']	= $this->functions->check_priv($this->session->role_id, $this->uri->segment(1)); // for button show and hide

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
					}	
				}
			} else {
				$value['jadwal'] = '-';
			}
				
			if($image->num_rows() > 0) {
				foreach ($image->result_array() as $key3 => $value3) {
					if($value['id'] == $value3['rumah_sakit_id']) {
						$value['foto'][$key3] = $value3;
					}	
				}	
			} else {
				$value['foto'] = '-';
			}
			
			$data_rumah_sakit[$key]		= $this->check_null($value);
		}

		$data['rumah_sakit'] = $data_rumah_sakit;
		// dd($data['rumah_sakit']);
		$this->slice->view('v_rumah_sakit', $data);
	}

	public function add()
	{
		$this->load->library('upload');

		$this->functions->check_access2($this->session->role_id, $this->uri->segment(1), $this->uri->segment(2));
		$this->form_validation->set_rules('nama_rumah_sakit', 'Nama Rumah Sakit', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$jenis_rumah_sakit = $this->global->get('jenis_rumah_sakit','jenis_rumah_sakit.id, jenis_rumah_sakit.description as text',
									['text'=>'ASC'])->result_array();
			$data['jenis_rumah_sakit'] = json_encode($jenis_rumah_sakit);
			$this->slice->view('f_rumah_sakit',$data);
		} else { 
			$this->db->trans_begin();

			$data_rumah_sakit = [
				'jenis_rumah_sakit_id'	=> $this->input->post('jenis_rumah_sakit_id'),
				'nama_rumah_sakit'		=> $this->input->post('nama_rumah_sakit'),
				'alamat'				=> $this->input->post('alamat'),
				'lat'					=> $this->input->post('lat'),
				'lng'					=> $this->input->post('lng'),
				'no_telp'				=> $this->input->post('no_telp'),
				'no_fax'				=> (!empty($this->input->post('no_fax'))) ? $this->input->post('no_fax') : NULL,
				'email'					=> (!empty($this->input->post('email'))) ? $this->input->post('email') : NULL,
				'created_at'			=> date('Y-m-d H:i:s')
			];

			$rumah_sakit_id = $this->global->create('rumah_sakit',$data_rumah_sakit, TRUE);

			$count_foto = count(array_filter($_FILES['userfile']['name']));

			// for($i = 0; $i < $count_foto; $i++) {
			// 	// $_FILES['userfile']['name']     = $_FILES['userfile']['name'][$i];
   //  //             $_FILES['userfile']['type']     = $_FILES['userfile']['type'][$i];
   //  //             $_FILES['userfile']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
   //  //             $_FILES['userfile']['error']    = $_FILES['userfile']['error'][$i];
   //  //             $_FILES['userfile']['size']     = $_FILES['userfile']['size'][$i];

				$config['upload_path'] 		= './assets/images/rumah_sakit/';
				$config['allowed_types'] 	= 'gif|jpg|png';
				$config['max_size']      	= 1024 * 3;
				$config['encrypt_name']		= TRUE;

				// $data_foto = [];
				foreach($_FILES['userfile']['name'] as $field) {
					$this->upload->initialize($config);
					// dd($this->upload->do_upload($value));
					if($this->upload->do_upload($field)) {
						$data_foto[] = [
							'rumah_sakit_id'	=> $rumah_sakit_id,
							'foto'				=> $this->upload->data('file_name'),
							'created_at'		=> date('Y-m-d H:i:s')
						];
					}
				}

				// dd($_FILES);
				// if(!empty($data_foto)) {
				// 	$this->global->create('foto_rumah_sakit',$data_foto);
				// }
			// }
			dd($data_foto);

			$this->global->create_batch('foto_rumah_sakit',$data_foto);

			// for($j = 0; $j < count($this->input->post('hari')); $j++) {
			// 	$data_jadwal[] = [
			// 		'rumah_sakit_id'	=> $rumah_sakit_id,
			// 		'hari'				=> $this->input->post('hari')[$j],
			// 		'jam_mulai'			=> $this->input->post('jam_mulai')[$j],
			// 		'jam_selesai'		=> $this->input->post('jam_selesai')[$j],
			// 		'operational'		=> $this->input->post('operational')[$j],
			// 		'created_at'		=> date('Y-m-d H:i:s')
			// 	];
			// }

			// $this->global->create_batch('jadwal_rumah_sakit',$data_jadwal);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				$result['error']	= TRUE;
				$result['type']		= 'error';
				$result['message']	= 'Rumah sakit fail to created!';
	        } else {
	        	$this->db->trans_commit();
				$result['error']	= FALSE;
				$result['type']		= 'success';
				$result['message']	= 'Rumah sakit success to created!';
	        }

			echo json_encode($result);
		}
	}

	public function update()
	{

	}

	public function delete()
	{
		$this->functions->check_access2($this->session->role_id, $this->uri->segment(1), $this->uri->segment(2));
		
		$id = decode($this->input->post('id'));
		$this->global->getCond('rumah_sakit','*',['id'=>$id])->row_array();

		if(empty($id)) {
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Rumah sakit has been deleted!';			
			$this->global->delete('rumah_sakit', ['id' => $id]);
			$this->global->delete('jadwal_rumah_sakit', ['rumah_sakit_id' => $id]);
			$this->unlink_image($id);
			$this->global->delete('foto_rumah_sakit', ['rumah_sakit_id' => $id]);
		} else {
			$result['error']	= TRUE;
			$result['type']		= 'success';
			$result['message']	= 'Rumah sakit fail to delete!';	
		}
		echo json_encode($result);
	}

	private function check_null($item)
	{
		$data = [];
		foreach ($item as $key => $value) {
			$data[$key] = (empty($value) ? '-' : $value);
		}

		return $data;
	}

	private function unlink_image($id)
	{
		$image = $this->global->getCond('foto_rumah_sakit',['rumah_sakit_id' => $id])->result_array();
		foreach ($image as $key => $value) {
			$path_image = './assets/images/rumah_sakit/' . $value['foto'];
			unlink($path_image);		
		}
	}

}

/* End of file Rumah_sakit.php */
/* Location: ./application/modules/rumah_sakit/controllers/Rumah_sakit.php */