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
      $this->db->where('status', 1);
      $this->db->where('deleted', 0);
      $this->db->order_by('date', 'DESC');
      $this->db->limit(2);
      $query = $this->db->get('tm_agmpedia');
      return $query->result_array();
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
    if($brand != NULL){
      $where = array('b.brand_id' => $brand);
      $this->db->where($where);
    }
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
      b.description, b.image, d.stars, b.main_sp');
    $this->db->from('tr_product_size a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tr_product_best_seller c', 'c.prod_id = a.prod_id', 'left');
    $this->db->join('tm_product d', 'd.id = a.prod_id', 'left');
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
    // TODO: Get Sub price
    $this->db->select('a.id_store, a.id_product, a.id_product_size, a.postpone,
     a.stock_akhir, b.price, b.id as idTr, c.id, c.name, c.size');
    $this->db->from('tr_product a');
    $this->db->join('tr_product_size b', 'b.id = a.id_product_size', 'left');
    $this->db->join('tm_size c', 'c.id = b.size_id', 'left');
    $this->db->join('tr_store_owner_cluster d', 'd.id_store = a.id_store', 'left');
    $this->db->group_by('a.id_product_size');
    $where = array('d.sub_district' => $idDistrict, 'a.id_product' => $idProd);
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
          return $query->row_array();
      }else{
          return FALSE;
      }
  }

  public function detailproduct_order($id_prod, $brand){
    $this->db->select('a.image, b.price');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
    $where = array(
      'a.id' => $id_prod
    );
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
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
      $this->db->select('a.id, a.order_number, a.note, a.status_order, aa.quantity, aa.subtotal, a.total, a.order_date, aa.id_tr_product, c.id as sku, c.brand_id, c.name, c.image,
      f.phone, f.address, f.postcode, g.nama as provinsi, h.nama as kabupaten, i.nama as kecamatan,
      k.name as size_name, k.size, l.image_1, m.kode_voucher');

    $this->db->from('tm_order a');
    $this->db->join('tr_order_detail aa', 'aa.id_tm_order = a.id');
    $this->db->join('tr_product_size b', 'b.id = aa.id_tr_Product', 'left');
    $this->db->join('tm_product c', 'c.id = b.prod_id', 'inner');
    $this->db->join('tm_customer_detail f', 'f.id = a.address_detail', 'left');
    $this->db->join('provinsi g', 'g.id_prov = f.province', 'left');
    $this->db->join('kabupaten h', 'h.id_kab = f.city', 'left');
    $this->db->join('kecamatan i', 'i.id_kec = f.sub_district', 'left');
    $this->db->join('tm_size k', 'k.id = b.size_id', 'left');
      $this->db->join('tr_product_image l', 'l.id_prod = c.id', 'left');
      $this->db->join('tm_voucher m', 'm.id = a.id_voucher', 'left');
    $where = array('a.id' => $idOrder, 'a.id_userLogin' => $idCustomer);
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
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
      $this->db->select('a.id, a.order_number, a.total, a.order_date, a.status_order, sum(b.quantity) as item_number');
      $this->db->from('tm_order a');
      $this->db->join('tr_order_detail b', 'b.id_tm_order = a.id');
      $this->db->where('a.id_userlogin', $id);
      $this->db->where('a.status_order != 1 AND a.status_order != 3');
      $this->db->group_by('a.id');
      $this->db->order_by('order_date', 'DESC');
      $result = $this->db->get();
      return $result->result_array();
  }

    public function getOrderHistory($id) {
        $this->db->select('a.id, a.order_number, a.total, a.order_date, a.status_order, sum(b.quantity) as item_number');
        $this->db->from('tm_order a');
        $this->db->join('tr_order_detail b', 'b.id_tm_order = a.id');
        $this->db->where('a.id_userlogin', $id);
        $this->db->where('(a.status_order = 1 OR a.status_order = 3)');
        $this->db->group_by('a.id');
        $this->db->order_by('order_date', 'DESC');
        $result = $this->db->get();
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
    $this->db->select('a.id, a.name, a.image, a.stars, a.position, c.image_1');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_image c', 'c.id_prod = a.id', 'left');
    $this->db->join('tr_product_size d', 'd.prod_id = a.id', 'left');
    $this->db->where('a.deleted', 0);
    $this->db->where('a.active', 1);
    if ($brand != NULL) {
      $this->db->where('a.brand_id', $brand);
    }
    if ($category != NULL) {
      $this->db->where('a.cat_id', $category);
    }
    $this->db->select_min('d.price');
    $this->db->order_by('a.position', 'asc');
    $this->db->group_by('a.id');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return FALSE;
    }
  }

  public function bed_linenProducts($brand = NULL){
    $this->db->select('a.id, b.name as brand, c.name as category, a.name, a.image, a.stars, d.position, e.image_1');
    $this->db->select_min('f.price');
    $this->db->from('tm_product a');
    $this->db->join('tm_brands b', 'b.id = a.brand_id', 'left');
    $this->db->join('tm_category c', 'c.id = a.cat_id', 'left');
    $this->db->join('tr_product_bed_linen d', 'd.prod_id = a.id', 'left');
    $this->db->join('tr_product_image e', 'e.id_prod = a.id', 'left');
    $this->db->join('tr_product_size f', 'f.prod_id = a.id', 'left');
    $this->db->order_by('d.position', 'asc');
    $this->db->group_by('a.id');
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
    $this->db->select('a.position, b.id, b.name, b.image, b.stars, e.image_1');
    $this->db->select_min('f.price');
    $this->db->from('tr_product_bedding_acc a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tm_brands c', 'c.id = b.brand_id', 'left');
    $this->db->join('tm_category d', 'd.id = b.cat_id', 'left');
    $this->db->join('tr_product_image e', 'e.id_prod = b.id', 'left');
    $this->db->join('tr_product_size f', 'f.prod_id = a.prod_id', 'left');
    $this->db->group_by('f.prod_id');
    $this->db->order_by('a.position', 'asc');
    $where = array(
      'b.cat_id !='   => 1,
      'b.cat_id !='   => 2,
      'b.brand_id !=' => 0
    );
    $this->db->where($where);
    if ($brand != NULL) {
      $this->db->where('b.brand_id', $brand);
    }
    if ($category != NULL) {
      $this->db->where('b.cat_id', $category);
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
    $this->db->where("a.cat_id != 1 AND a.cat_id != 2 AND a.cat_id != 0");
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
    $this->db->where("a.cat_id != 1 AND a.cat_id != 2 AND a.brand_id != 0");
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
    $this->db->select('d.id, d.name as prod, e.name as sizeName, e.size as sizeDetail,
     b.quantity, ');
    $this->db->from('tm_special_package a');
    $this->db->join('tr_special_package b', 'b.id_specialPkg = a.id', 'left');
    $this->db->join('tr_product_size c', 'c.id = b.id_prod_package', 'left');
    $this->db->join('tm_product d', 'd.id = c.prod_id', 'left');
    $this->db->join('tm_size e', 'e.id = c.size_id', 'left');
    $this->db->where('a.main_product', $idSpecialPckg);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function detail_SPCart($idSpecialPckg){
    $this->db->select('c.id, c.name as prod, d.name as sizeName, d.size as sizeDetail, a.quantity');
    $this->db->from('tr_special_package a');
    $this->db->join('tr_product_size b', 'b.id = a.id_prod_package', 'left');
    $this->db->join('tm_product c', 'c.id = b.prod_id', 'left');
    $this->db->join('tm_size d', 'd.id = b.size_id', 'left');
    $this->db->where('a.id_specialPkg', $idSpecialPckg);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function prime_specialPKG($prod_id){
    $this->db->select('a.id, a.name, a.image, a.description, b.price');
    $this->db->from('tm_product a');
    $this->db->join('tr_product_size b', 'b.prod_id = a.id', 'left');
    $this->db->where('a.id', $prod_id);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->row_array();
    }else {
      return FALSE;
    }
  }

  public function listBestSeller_Product($brand = NULL, $cat = NULL){
    $this->db->select('b.id as id, b.name, b.image, b.stars, a.position, c.image_1');
    $this->db->select_min('d.price');
    $this->db->from('tr_product_best_seller a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
    $this->db->join('tr_product_image c','c.id_prod=a.prod_id','left');
    $this->db->join('tr_product_size d', 'd.prod_id=a.prod_id', 'left');
    $this->db->group_by('a.prod_id');
    $this->db->order_by('b.position', 'asc');
    if ($brand != NULL && $cat != NULL) {
      $where = array(
        'b.brand_id'  =>  $brand,
        'b.cat_id'    =>  $cat
      );
      $this->db->where($where);
    }elseif ($brand != NULL && $cat == NULL) {
      $where = array(
        'b.brand_id'  =>  $brand,
      );
      $this->db->where($where);
    }elseif ($brand == NULL && $cat != NULL) {
      $where = array(
        'b.cat_id'    =>  $cat
      );
      $this->db->where($where);
    }
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function topthree_bestSeller(){
    $this->db->select('b.id, a.position, b.name, c.image_1 as image');
    $this->db->from('tr_product_best_seller a');
    $this->db->join('tm_product b', 'b.id = a.prod_id', 'left');
      $this->db->join('tr_product_image c', 'c.id_prod = b.id', 'left');
    $this->db->limit(3);
    $this->db->order_by('a.position', 'asc');
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    }else {
      return FALSE;
    }
  }

  public function getProductImage($idProduct) {
      $this->db->select('a.image_1, a.image_2, a.image_3');
      $this->db->from('tr_product_image a');
      $this->db->join('tm_product b', 'a.id_prod = b.id', 'inner');
      $this->db->where('b.id', $idProduct);
      $query = $this->db->get();
      if ($query->num_rows() != 0) {
          return $query->row_array();
      } else {
          return FALSE;
      }
  }

  function search($keyword)
  {
      $this->db->select('a.id,a.name,a.stars,a.image,b.image_1');
      $this->db->from('tm_product a');
      $this->db->join('tr_product_image b','b.id_prod=a.id','left');
      $this->db->like('name',$keyword);
      $query  =   $this->db->get();
      return $query->result_array();
  }
}
