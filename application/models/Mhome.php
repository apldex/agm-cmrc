<?php defined('BASEPATH') or Exit('No direct script access allowed');

/**
 * this is class model for home
 */
class Mhome extends CI_Model{

  function __construct(){
    parent::__construct();
    $this->load->database();
  }


  public function getDataIndex($id = FALSE){
    if($this->session->userdata('uType') == 1){
      if($id === FALSE){
        $query = $this->db->get('tm_super_admin');
        return $query->result_array();
      }else{
        $query = $this->db->get_where('tm_super_admin', array('id' => $id));
        return $query->row_array();
      }
    } elseif ($this->session->userdata('uType') == 2) {
      if($id === FALSE){
        $query = $this->db->get('tm_store_owner');
        return $query->result_array();
      }else{
        $query = $this->db->get_where('tm_store_owner', array('id' => $id));
        return $query->row_array();
      }
    }
  }

  public function dataPrime($id = NULL){
    $this->db->select(array('emailField' => 'email'));
    $query = $this->db->get_where('user_login', array('user_id' =>$id));
    return $query->row_array();
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

  public function createItems($table){
      $id_creator = $this->session->userdata('uId');
    $items = array(
      'name'            => $this->input->post('items'),
      'id_super_admin'  => $id_creator
    );
    return $this->db->insert($table, $items);
  }

  public function getPedia()
  {
    return $this->db->get('tm_agmpedia');
  }

  public function pediaInput($data)
  {
    $this->db->insert('tm_agmpedia',$data);
  }

  public function getPediaByID($id)
  {
    $this->db->where('id',$id);
    return $this->db->get('tm_agmpedia');
  }

  public function updatePedia($id,$data)
  {
    $this->db->where('id',$id);
    $this->db->set($data);
    $this->db->update('tm_agmpedia');
  }

  public function updateData($condition, $data, $table){
    if ($condition != NULL) {
      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    $this->db->set($data);

    return $this->db->update($table);
  }

  public function deletePedia($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('tm_agmpedia');
  }

  public function inputData($table, $items){
    return $this->db->insert($table, $items);
  }

  public function joinStoreProd($store_id){
    $this->db->select('*');
    $this->db->from('tm_product a');
    $this->db->join('tr_product b', 'b.id_product = a.id', 'left');
    $where = array('b.id_store'=>$store_id, 'b.new'=>1);
    $this->db->where($where);
    $query = $this->db->get();
    if($query->num_rows() != 0){
      return $query->result_array();
    }else{
      return FALSE;
    }
  }

  public function brand_categories($brand){
    $this->db->select('a.id, a.name');
    $this->db->from('tm_category a');
    $this->db->join('tm_product b', 'b.cat_id = a.id', 'left');
    $where = array('b.brand_id' => $brand);
    $this->db->where($where);
    $this->db->group_by('b.cat_id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function getProduct_price($brand, $category){
    $this->db->select('MAX(a.price) as max_price, MIN(a.price)as min_price, b.name, b.id, b.image');
    $this->db->from('tr_product_size a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $where = array('b.brand_id' => $brand, 'b.cat_id' => $category);
    $this->db->where($where);
    $this->db->group_by('a.prod_id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function getProduct_MaxMinPrice($idProduct){
    $this->db->select('a.id, MAX(a.price) as max_price, MIN(a.price) as min_price, b.name, b.id, b.brand_id, b.cat_id,
      b.description, b.image, c.stars');
    $this->db->from('tr_product_size a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tr_product_best_seller c', 'c.prod_id = a.prod_id', 'left');
    $this->db->where('b.id', $idProduct);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function getProduct_categories($idBrand){
    $this->db->select('a.cat_id');
    $this->db->from('tm_product a');
    $this->db->where('a.brand_id', $idBrand);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function fetch_kabupaten($idProvince){
    $this->db->where('id_prov', $idProvince);
    $query = $this->db->get('kabupaten');
    $output = '<option value="">Pilih Kabupaten</option>';
    foreach ($query->result() as $row) {
      $output .= '<option value="'.$row->id_kab.'">'.$row->nama.'</option>';
    }
    return $output;
  }

  // public function checkStock_by_Distcit($idProd, $idDistrict){
  //     $this->db->select('a.id_store, a.id_product, a.id_product_size, d.id, a.quantity, c.price, d.name, d.size');
  //     $this->db->from('tr_product a');
  //     $this->db->join('tm_store_owner b', 'b.id = a.id_store', 'left');
  //     $this->db->join('tr_product_size c', 'c.id = a.id_product_size', 'left');
  //     $this->db->join('tm_size d', 'd.id = c.size_id', 'left');
  //     $this->db->group_by('a.id_product_size');
  //     $where = array('b.sub_district' => $idDistrict, 'a.id_product' => $idProd);
  //     $this->db->where($where);
  //     $query = $this->db->get();
  //   if ($query->num_rows() != 0) {
  //     return $query->result_array();
  //   } else {
  //     return FALSE;
  //   }
  // }

  public function checkStock_by_District($idProd, $idDistrict){
    $this->db->select('a.id_store, a.id_product, a.id_product_size, a.quantity, b.price, c.id, c.name, c.size');
    $this->db->from('tr_product a');
    $this->db->join('tr_product_size b', 'b.id = a.id_product_size', 'left');
    $this->db->join('tm_size c', 'c.id = b.size_id', 'left');
    $this->db->join('tr_store_owner_cluster d', 'd.id_store = a.id_store', 'left');
    $this->db->group_by('a.id_product_size');
    $where = array('d.sub_district' => $idDistrict, 'a.id_product' => $idProd, 'a.quantity >' => 3);
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }

  }

  public function detailProfileCustomer($idUserLogin){
    $this->db->select('a.first_name, a.last_name, a.email, a.phone, a.address, b.nama as provinsi, c.nama as kabupaten,
      d.nama as kecamatan, a.postcode, a.sub_district');
    $this->db->from('tm_customer_detail a');
    $this->db->join('provinsi b', 'b.id_prov = a.province', 'left');
    $this->db->join('kabupaten c', 'c.id_kab = a.city', 'left');
    $this->db->join('kecamatan d', 'd.id_kec = a.sub_district', 'left');
    $where = array('a.id_userlogin' => $idUserLogin, 'a.default_address' => 1);
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function customer_detail($id_cs_detail){
    $this->db->select('a.first_name, a.last_name, a.email, a.phone, a.postcode, a.address, b.nama as provinsi,
      c.nama as kabupaten, d.nama as kecamatan');
    $this->db->from('tm_customer_detail a');
    $this->db->join('provinsi b', 'b.id_prov = a.province', 'left');
    $this->db->join('kabupaten c', 'c.id_kab = a.city', 'left');
    $this->db->join('kecamatan d', 'd.id_kec = a.sub_district', 'left');
    $this->db->where('id', $id_cs_detail);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function historicalShipping($idUserLogin){
   $this->db->select("a.id, a.username, a.address, a.postcode, b.nama as kecamatan");
   $this->db->from('tm_customer_detail a');
   $this->db->join('kecamatan b', 'b.id_kec = a.sub_district', 'left');
   $where = array(
     'a.id_userlogin'    => $idUserLogin,
     'a.default_address' => 0,
   );
   $this->db->where($where);
   $query = $this->db->get();
   if ($query->num_rows() != 0) {
     return $query->result_array();
   } else {
     return FALSE;
   }
 }

  public function sizeStock($id_stock_tr){
      $this->db->select('a.name as name_size, a.size as detail_size');
      $this->db->from('tm_size a');
      $this->db->join('tr_product_size c', 'c.size_id = a.id', 'left');
      $this->db->where('c.id', $id_stock_tr);
      $query = $this->db->get();
      if($query->num_rows()!=0){
          return $query->result_array();
      }else{
          return FALSE;
      }
  }

  public function listOrderCustomer($idUserLogin, $criteria = NULL){
    $this->db->select('a.id, a.order_number, a.id_userlogin, a.total, a.order_date, a.address_detail, a.status_order,
      a.id_voucher, b.id_tr_product, b.quantity, b.subtotal, d.name, d.image');
    $this->db->from('tm_order a');
    $this->db->join('tr_order_detail b', 'b.id_tm_order = a.id', 'left');
    $this->db->join('tr_product c', 'c.id = b.id_tr_product', 'left');
    $this->db->join('tm_product d', 'd.id = c.id_product', 'left');
    $this->db->order_by('a.order_date', 'DESC');
    $where = array('id_userlogin' => $idUserLogin);
    $this->db->where($where);
    if ($criteria !== NULL) {
        $this->db->where($criteria);
    }
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function detailOrder($idOrder, $idCustomer){
    $this->db->select('a.id, a.order_number, a.status_order, aa.quantity, aa.subtotal, a.total, a.order_date, aa.id_tr_product, c.name, c.image,
      f.phone, f.address, f.postcode, g.nama as provinsi, h.nama as kabupaten, i.nama as kecamatan,
      k.name as size_name, k.size');

    $this->db->from('tm_order a');
    $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
    $this->db->join('tr_product b', 'b.id = aa.id_tr_Product', 'left');
    $this->db->join('tm_product c', 'c.id = b.id_product', 'inner');
    $this->db->join('tm_customer_detail f', 'f.id = a.address_detail', 'left');
    $this->db->join('provinsi g', 'g.id_prov = f.province', 'left');
    $this->db->join('kabupaten h', 'h.id_kab = f.city', 'left');
    $this->db->join('kecamatan i', 'i.id_kec = f.sub_district', 'left');
    $this->db->join('tr_product_size j', 'j.id = b.id_product_size', 'left');
    $this->db->join('tm_size k', 'k.id = j.size_id', 'left');
    $where = array('a.id' => $idOrder, 'a.id_userLogin' => $idCustomer);
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result();
    } else {
      return FALSE;
    }
  }

    public function getDetailOrder($orderId){
        $this->db->select('a.id, a.order_number, a.status_order, aa.quantity, aa.subtotal, a.total, a.order_date, aa.id_tr_product');

        $this->db->from('tm_order a');
        $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
        $where = array('a.order_number' => $orderId);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

  public function getOrderList($id) {
      $this->db->where('id_userlogin', $id);
      $this->db->where('status_order != 1 AND status_order != 3');
      $this->db->order_by('order_date', 'DESC');
      $result = $this->db->get('tm_order');
      return $result->result_array();
  }

    public function getOrderHistory($id) {
        $this->db->where('id_userlogin', $id);
        $this->db->where('status_order = 1 OR status_order = 3');
        $this->db->order_by('order_date', 'DESC');
        $result = $this->db->get('tm_order');
        return $result->result_array();
    }

  public function detail_district_cart($idDistrict){
    $this->db->select('a.id_kec, a.nama as kecamatan, a.id_kab, b.nama as kabupaten, c.id_prov, c.nama as provinsi');
    $this->db->from('kecamatan a');
    $this->db->join('kabupaten b', 'b.id_kab = a.id_kab', 'left');
    $this->db->join('provinsi c', 'c.id_prov = b.id_prov', 'left');
    $this->db->where('a.id_kec', $idDistrict);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
  }

  public function getShop_product($brand = NULL, $category = NULL){
    $this->db->select('a.id, a.name, a.image, b.stars, b.position');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_best_seller b', 'b.prod_id = a.id', 'left');
    if ($brand != NULL) {
      $this->db->where('a.brand_id', $brand);
    }
    if ($category != NULL) {
      $this->db->where('a.cat_id', $category);
    }
    $this->db->order_by('b.position', 'asc');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function bed_linenProducts($brand = NULL){
    $this->db->select('a.id, b.name as brand, c.name as category, a.name, a.image, d.stars, d.position');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.cat_id', 'left');
    $this->db->join('tr_product_bed_linen d', 'd.prod_id = a.id', 'left');
    $this->db->order_by('d.position', 'asc');
    if ($brand == NULL) {
      $this->db->where('a.cat_id', 2);
    }else{
      $where = array('a.brand_id' => $brand, 'a.cat_id' => 2);
      $this->db->where($where);
    }
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function bed_linenBrands(){
    $this->db->select('b.id, b.name as brand');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.cat_id', 'left');
    $this->db->where('a.cat_id', 2);
    $this->db->group_by('a.brand_id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function beddingAcc($brand = NULL, $category = NULL){
    $this->db->select('a.id, a.name, a.image, d.stars, d.position');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.cat_id', 'left');
    $this->db->join('tr_product_bedding_acc d', 'd.prod_id = a.id', 'left');
    $this->db->order_by('d.position', 'asc');
    $where = "a.cat_id != 1 AND a.cat_id != 2";
    $this->db->where($where);
    if ($brand != NULL) {
      $this->db->where('a.brand_id', $brand);
    }
    if ($category != NULL) {
      $this->db->where('a.cat_id', $category);
    }
    // foreach ($where as $key => $value) {
    // }
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function beddingACC_Categories($brand = NULL, $category = NULL){
    $this->db->select('c.id, c.name');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.cat_id', 'left');
    $this->db->where("a.cat_id != 1 AND a.cat_id != 2");
    if ($brand != NULL) {
      $this->db->where('a.brand_id', $brand);
    }
    if ($category != NULL) {
      $this->db->where('a.cat_id', $category);
    }
    $this->db->group_by('a.cat_id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function beddingACC_Brands(){
    $this->db->select('b.id, b.name');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.brand_id', 'left');
    $this->db->where("a.cat_id != 1 AND a.cat_id != 2");
    $this->db->group_by('a.brand_id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

    public function addNewsLetter($data){

    return $this->db->insert('tm_newsletter', $data);
  }

  public function findNearestStoreByLatLng($latitude, $longitude, $distance, $limit = NULL)
  {
    $query = $this->db->query("
      SELECT *
        , (
          6371 * acos(
          cos(radians($latitude))
            * cos(radians(latitude))
            * cos(
              radians(longitude) - radians($longitude)
            )
            + sin(radians($latitude))
            * sin(radians(latitude))
          )
        ) AS distance
      FROM tm_store_owner
      HAVING distance < $distance
      ORDER BY distance"
      . (!is_null($limit) ? " LIMIT $limit" : '')
      . ";
    ");
    return $query->result_array();
  }

  public function detail_specialPackage($idSpecialPckg){
    $this->db->select('c.name as prod, d.name as sizeName, d.size as sizeDetail, a.quantity, a.priceSpcl');
    $this->db->from('tr_special_package a');
    $this->db->join('tr_product_size b', 'b.id = a.id_tr_prod_size', 'left');
    $this->db->join('tm_product c', 'c.id = b.prod_id', 'left');
    $this->db->join('tm_size d', 'd.id = b.size_id', 'left');
    $this->db->where('a.id_special_package', $idSpecialPckg);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }
}
