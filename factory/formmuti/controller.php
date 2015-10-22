<?php

class _PARAM1 extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
  	if ( empty($_FILES) ){
			$this->load->view('_PARAM2');
			return true;
		}
		if ( ! $data = $this->mutiUploading() ){ //上傳失敗
			$this->load->view('failure', [
				'message' => '上傳失敗'
			]);
			return false;
		}
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		return true;
  }
}