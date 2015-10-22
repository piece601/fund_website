<?php

require_once('BASE_Model.php');

class MY_Model extends BASE_Model {

	protected $table; // 一定要設定 table 名稱
	protected $primaryKey; // 一定要設定 primaryKey

	function __construct()
	{
		parent::__construct();
	}

	function select_all_data($order = 'desc') // 撈出所有資料 $order為大到小 or 小到大
	{
		$this->db->order_by($this->primaryKey, $order); // 排序
		$query = $this->db->get($this->table); 
		return $query->result();
	}

	function select_data($id) //撈出單筆資料
	{
		$query = $this->db->get_where($this->table, array($this->primaryKey => $id));
		return $query->row();
	}

	function insert_data($data) // 傳陣列進來
	{
		$this->db->insert($this->table, $data); 
		return $this->db->insert_id(); // 回傳主鍵
	}

	function update_data($data){ // 傳陣列進來
		$this->db->where($this->primaryKey, $data[$this->primaryKey]);
		$this->db->update($this->table ,$data);
		return $this->db->affected_rows(); // 還傳影響幾筆資料
	}

	function delete_data($id){ //刪除單筆資料
		$this->db->delete($this->table, array($this->primaryKey => $id)); 
		return $this->db->affected_rows();
	}
}