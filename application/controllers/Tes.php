<?php
class Tes extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
	}
	function index(){
		$this->load->view('v_tes');
	}

	function get(){
		$url = "http://static.scash.bz/test_programmer.php";
		$data = json_decode($this->curl->simple_get($url),true);
		echo json_encode($data);
	}

	function save_data(){
		$date 	= $this->input->post('date');
		$label 	= $this->input->post('label');
		$visit 	= $this->input->post('visit');
		$hits 	= $this->input->post('hits');
		$spent 	= $this->input->post('spent');
		$gen 	= $this->input->post('gen');
		$uniq 	= $this->input->post('uniq');

		$data = array();

			$index = 0;
			foreach ($date as $key) {
				array_push($data, array(
						'date'								=> $date[$index],
						'label' 							=> $label[$index],
						'nb_visits' 						=> $visit[$index],
						'nb_hits'							=> $hits[$index],
						'sum_time_spent' 					=> $spent[$index],
						'nb_hits_with_time_generation'		=> $gen[$index],
						'sum_daily_exit_nb_uniq_visitors'	=> $uniq[$index]
					));
				$index++;			
			}
			$this->delete_first('trafic');
			$insertBatch = $this->insertBatch('trafic',$data);

			if ($insertBatch){
				$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
				redirect(site_url('tes'));
       		}else{
       			echo "Gagal!";
       		}

	}

	function insertBatch($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}

	function delete_first($table)
	{
		$delete = $this->db->truncate($table);
		if ($delete) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

}