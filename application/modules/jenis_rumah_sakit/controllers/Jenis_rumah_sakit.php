<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_rumah_sakit extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->functions->is_login();
	}

	public function index()
	{
		$this->functions->check_access($this->session->role_id, $this->uri->segment(1)); // access read
		$data['priv']		= $this->functions->check_priv($this->session->role_id, $this->uri->segment(1)); // for button show and hide
		
		$data['jenis_rumah_sakit'] = $this->global->get('jenis_rumah_sakit')->result_array();
		$this->slice->view('v_jenis_rumah_sakit', $data);
	}

	public function add()
	{
		$this->functions->check_access2($this->session->role_id, $this->uri->segment(1), $this->uri->segment(2));
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->slice->view('f_jenis_rumah_sakit');
		} else {
			$data = [
				'description' => $this->input->post('description'),
				'created_at'=> date('Y-m-d H:i:s'),
			];

			$create = $this->global->create('jenis_rumah_sakit',$data);
			if($create == FALSE) {
				$result['error'] 	= TRUE;
				$result['type']		= 'error';
				$result['message']	= 'Jenis rumah sakit fail to created!'; 
			} else {
				$result['error']	= FALSE;
				$result['type']		= 'success';
				$result['message']	= 'Jenis rumah sakit success to created!';
			}
			echo json_encode($result);
		}	
	}

	public function update()
	{
		$this->functions->check_access2($this->session->role_id, $this->uri->segment(1), $this->uri->segment(2));
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id 						= decode($this->uri->segment(3));
			$data['jenis_rumah_sakit'] 	= $this->global->getCond('jenis_rumah_sakit', '*', ['id' => $id])->row_array();
			(isset($data['jenis_rumah_sakit'])) ? $data['jenis_rumah_sakit'] : show_404();

			$this->slice->view('f_jenis_rumah_sakit',$data);
		} else {
			$this->db->trans_begin();
			
			$data = [
				'description'	=> $this->input->post('description'),
			];
			$id = decode($this->input->post('id'));

			$this->global->update('jenis_rumah_sakit', $data, ['id' => $id]);

			if ($this->db->trans_status() === FALSE) {
	            $this->db->trans_rollback();
				$result['error']	= TRUE;
				$result['type']		= 'error';
				$result['message']	= 'Jenis rumah sakit fail to updated!';
	        } else {
	        	$this->db->trans_commit();
				$result['error']	= FALSE;
				$result['type']		= 'success';
				$result['message']	= 'Jenis rumah sakit success to upated!';
	        }
			echo json_encode($result);
		}
	}	

	public function delete()
	{
		$this->functions->check_access2($this->session->role_id, $this->uri->segment(1), $this->uri->segment(2));
		
		$id = decode($this->input->post('id'));
		$this->global->getCond('jenis_rumah_sakit','*',['id'=>$id])->row_array();

		if($id != NULL || $id != '') {
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Jenis rumah sakit has been deleted!';
			$this->global->delete('jenis_rumah_sakit', array('id' => $id));
		} else {
			$result['error']	= TRUE;
			$result['type']		= 'success';
			$result['message']	= 'Jenis rumah sakit fail to delete!';	
		}
		echo json_encode($result);
	}
}

/* End of file jenis_rumah_sakit.php */
/* Location: ./application/controllers/jenis_rumah_sakit.php */