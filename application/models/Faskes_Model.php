<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_model extends CI_Model
{

    public $table = 'tb_faskes';
    public $id = 'id_faskes';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        //$this->db->select('id_faskes,nama_faskes,id_tipe,alamat,no_telpon,foto, x(location) as lng, y(location) as lat');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_logged($id)
    {
        //$this->db->select('id_faskes,nama_faskes,id_tipe,alamat,no_telpon,foto, x(location) as lng, y(location) as lat');
        $this->db->where('id_user',$id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
      //    $this->db->select('id_faskes,nama_faskes,id_tipe,alamat,no_telpon,foto, x(location) as lng, y(location) as lat');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }



    // get data by id
    function get_name($id)
    {
          $this->db->select('nama_faskes');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_faskes', $keyword);
      	$this->db->or_like('nama_faskes', $keyword);
      	$this->db->or_like('id_tipe', $keyword);
      	$this->db->or_like('alamat', $keyword);
      	$this->db->or_like('no_telpon', $keyword);
      	$this->db->or_like('foto', $keyword);
      	$this->db->or_like('location', $keyword);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_faskes', $keyword);
      	$this->db->or_like('nama_faskes', $keyword);
      	$this->db->or_like('id_tipe', $keyword);
      	$this->db->or_like('alamat', $keyword);
      	$this->db->or_like('no_telpon', $keyword);
      	$this->db->or_like('foto', $keyword);
      	$this->db->or_like('location', $keyword);
      	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get search data with limit
    function search_by_name($keyword) {
        $this->db->order_by($this->id, $this->order);
      	$this->db->or_like('nama_faskes', $keyword);
        return $this->db->get($this->table)->result();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Faskes_model.php */
/* Location: ./application/models/Faskes_model.php */
