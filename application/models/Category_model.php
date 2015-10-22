<?php

class Category_model extends MY_Model {
  protected $table = 'category';
  protected $primaryKey = 'categoryId';

  public function __construct()
  {
    parent::__construct();
  }
}