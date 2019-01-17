<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Super admin and admin controller
 */
class Madmin extends CI_Model {

  function __construct() {
    parent::__construct();

    $this->load->database();
  }

  public function getProducts($condition = NULL, $selection = NULL, $table, $singleRowResult =  FALSE){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    if ($selection != NULL) {
      foreach ($selection as $key => $value) {
        $this->db->select($value);
      }
    }

    $query =  $this->db->get($table);

    if ($singleRowResult === TRUE) {
      return $query->row_array();
    }else {
      return $query->result_array();
    }
  }

  public function inputData($table, $items){
    return $this->db->insert($table, $items);
  }

  public function updateData($condition = NULL, $table, $items){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }

    return $this->db->update($table, $items);
  }

  public function deleteData($condition = NULL, $table){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    return $this->db->delete($table);
  }

  public function createItems($table){
    $id_creator = $this->session->userdata('uId');
    $items = array(
      'name'            => $this->input->post('items'),
      'id_super_admin'  => $id_creator
    );
    return $this->db->insert($table, $items);
  }

  public function getDataIndex($id = FALSE){
    if($id === FALSE){
      $query = $this->db->get('tm_store_owner');
      return $query->result_array();
    }else{
      $query = $this->db->get_where('tm_store_owner', array('id' => $id));
      return $query->row_array();
    }
  }

  public function dataPrime($id = NULL){
    $this->db->select(array('emailField' => 'email'));
    $query = $this->db->get_where('user_login', array('user_id' =>$id));
    return $query->row_array();
  }
}
