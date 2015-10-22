<?php

class Price extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model(['price_model', 'category_model', 'success_model']);
  }

  public function chart($fundeName = null, $startDate = null, $endDate = null)
  {
  	if ( ! $startDate) 
  		$startDate = date("Y")-3 . date("-m-d");
  	if ( ! $endDate)
  		$endDate = date("Y-m-d");
  	if ( ! $query = $this->price_model->select_interval($startDate, $endDate, $fundeName) ) {
  		$this->load->view('failure', [
  			'message' => '查無此資料'
			]);
			return;
  	}
  	$fundName = $query[0]->fundName;
  	$this->load->view('price/chart', compact('query', 'fundName'));
  }

  public function success($fundeName = 'FTH05', $startDate = null, $endDate = null, $years = 1)
  { 
    if ( isset($_GET['fundeName'] ) ) {
      redirect('price/success/'.$_GET['fundeName'].'/'.$_GET['startDate'].'/'.$_GET['endDate'].'/');
      return;
    }
    // 抓出所有分類
    $categories = $this->category_model->select_all_data();
    if ( ! $startDate) 
      $startDate = date("Y")-1 . date("-m-d");
    if ( ! $endDate)
      $endDate = date("Y-m-d");
    $query = $this->success_model->select_by_fundename_date($fundeName, $startDate, $endDate);
    if ( empty($query) ) {
      $this->load->view('failure', [
        'message' => '查無此資料'
      ]);
      return;
    }
    $fundName = $query[0]->fundName;
    $fundPrices = $this->price_model->select_interval($startDate, $endDate, $fundeName);
    $this->load->view('price/chart', compact('query', 'fundName', 'fundPrices', 'categories', 'startDate', 'endDate'));
  }

  public function rank()
	{
		// 排行結果
		$ranks = [];
		$categories = $this->category_model->select_all_data();
		foreach ($categories as $count => $fund) {
			// if ( ! preg_match('/^(\w{3})([0-9]{2})$/', $fund->fundeName) ) {
			// 	continue;
			// }
	  	// $query = $this->price_model->select_interval_by_date_fundeName(date("Y")-3 . date("-m-d"), date('Y-m-d'), $fund->fundeName);
	  	$query = $this->price_model->select_interval_by_date_fundeName('2009-06-01', '2012-06-01', $fund->fundeName);
	  	$total = count($query);
	  	if ( $total == 0) {
	  		continue;
	  	}
	  	// $today = $this->price_model->select_last_by_fundeName($fund->fundeName);
	  	$today = $this->price_model->select_by_date_fundename('2012-06-01', $fund->fundeName);
	  	$rank = 0;
	  	foreach ($query as $key => $value) {
	  		if ( $value->price == $today->price ) {
	  			$rank = $key + 1;
	  			break;
	  		}
	  	}
	  	$ranks[$fund->fundName] = (float) $rank / $total * 100;
	  	// echo $fund->fundName . (float) $rank / $total * 100 . '% <br>';
	  	// if ( $count > 3)
	  	// 	break;
  		
	  }
	  arsort($ranks);
  	foreach ($ranks as $key => $value) {
  		echo $key . $value . '% <br>';
  	}
	}	


  public function index($fundeName = 'FTH05')
  {
  	$query = $this->price_model->select_by_fundename($fundeName);
  	$query = $this->price_model->select_interval_by_date_fundeName('2013-12-17', '2014-12-17', $fundeName);

  	$total = count($query);

  	// var_dump($this->price_model->select_by_fundename($fundeName));
  	// var_dump($this->price_model->select_last_by_fundeName($fundeName));
  	$today = $this->price_model->select_last_by_fundeName($fundeName);

  	$today = $this->price_model->select_by_date_fundename('2014-12-17', $fundeName);

  	// $today = $this->price_model->select_by_date_fundename('2002-08-05', $fundeName);

  	// foreach ($query as $key => $value) {
  	// 	echo $value->date . ' ' .$value->price . "<br>";
  	// }
  	$rank = 0;
  	foreach ($query as $key => $value) {
  		if ( $value->price == $today->price ) {
  			$rank = $key + 1;
  			break;
  		}
  	}
  	// echo $rank . "<br>";
  	// echo $total;
  	echo (float) $rank / $total * 100 . '%';
  	// $this->load->view('price/index', compact('query'));
  }

  public function a()
  {
  	$query = $this->price_model->select_interval('2012-10-20', date('Y-m-d'), 'FTH05');
  	$this->load->view('price/index', compact('query'));
  }

}