<?php

class Welcome extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['success_model', 'price_model', 'category_model']);
	}

	private function save_today_rank($years)
	{
		$categories = $this->category_model->select_all_data();
		foreach ($categories as $count => $fund) {
	  	$query = $this->price_model->select_interval_by_date_fundeName(date("Y")-$years . date("-m-d"), date("Y-m-d"), $fund->fundeName);
	  	$total = count($query);
	  	if ( $total == 0) {
	  		continue;
	  	}
	  	$today = $this->price_model->select_last_by_fundeName($fund->fundeName);
	  	$rank = 0;
	  	foreach ($query as $key => $value) {
	  		if ( $value->price == $today->price ) {
	  			$rank = $key + 1;
	  			break;
	  		}
	  	}
	  	$this->success_model->insert_data([
	  		'years' => $years,
	  		'fundeName' => $fund->fundeName,
	  		'fundName' => $fund->fundName,
	  		'fundDate' => $today->date,
	  		'date' => date("Y-m-d"),
	  		'price' => $today->price,
	  		'success_percent' => (float) $rank / $total * 100
  		]);
	  }
		return;
	}

	public function index($years = 3)
	{
		if ( ! $query = $this->success_model->select_by_date_years(date("Y-m-d"), $years) ) {
			$this->save_today_rank($years);
		  $query = $this->success_model->select_by_date_years(date("Y-m-d"), $years);
		}
		$this->load->view('welcome/index', compact('query'));
	}
}
