<?php

class Price_model extends MY_Model {
  protected $table = 'price';
  protected $primaryKey = 'priceId';

  public function __construct()
  {
    parent::__construct();
  }

  public function select_by_fundename($fundeName)
  {
  	$this->db->order_by('price', 'desc');
  	$this->db->where(['fundeName' => $fundeName]);
  	$query = $this->db->get($this->table);
  	return $query->result();
  }

  public function select_by_date_fundename($date, $fundename)
  {
    $query = $this->db->get_where($this->table, [
      'date' => $date,
      'fundename' => $fundename
    ]);
    return $query->row();
  }

  public function select_last_by_fundeName($fundeName)
  {
    $this->db->order_by($this->primaryKey, 'desc');
    $this->db->where(['fundeName' => $fundeName]);
    $query = $this->db->get($this->table);
    return $query->row();
  }

  public function select_interval_by_date_fundeName($startDate, $endDate, $fundeName)
  {
    $this->db->order_by('price', 'desc');
    $this->db->where('date >=', $startDate);
    $this->db->where('date <=', $endDate);
    $this->db->where('fundeName', $fundeName);
    $query = $this->db->get($this->table);
    return $query->result();
  }  

  public function select_interval($startDate, $endDate, $fundeName)
  {
    // $this->db->order_by('price', 'desc');
    $this->db->where('date >=', $startDate);
    $this->db->where('date <=', $endDate);
    $this->db->where('fundeName', $fundeName);
    $query = $this->db->get($this->table);
    return $query->result();
  }

}