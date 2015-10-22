<?php

class Success_model extends MY_Model {
  protected $table = 'success';
  protected $primaryKey = 'successId';

  public function __construct()
  {
    parent::__construct();
  }

  public function select_by_date_years($fundDate, $years)
  {
  	$this->db->order_by('success_percent', 'desc');
  	$this->db->where([
      'fundDate' => $fundDate,
      'years' => $years
    ]);
  	$query = $this->db->get($this->table);
  	return $query->result();
  }

  public function select_by_fundename_years($fundeName, $years = 1)
  {
    $this->db->order_by('fundDate', 'asc');
    $this->db->where([
      'fundeName' => $fundeName,
      'years' => $years
    ]);
    $this->db->where('fundDate >', '2014-01-01');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function select_by_fundename_date($fundeName, $startDate, $endDate, $years = 1)
  {
    $this->db->order_by('fundDate', 'asc');
    $this->db->where([
      'fundeName' => $fundeName,
      'years' => $years
    ]);
    $this->db->where('fundDate >=', $startDate);
    $this->db->where('fundDate <=', $endDate);
    $query = $this->db->get($this->table);
    return $query->result();
  }
}