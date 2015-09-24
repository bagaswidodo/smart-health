<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_dokter extends CI_Model
{

    public $table = 'tb_dokter';
    public $id = 'id_dokter';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_dokter_faskes($id_faskes)
    {
      $this->db->where('id_faskes', $id_faskes);
      return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($data)
    {
        //$this->db->where($this->id, $id);
        $this->db->where($data);
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
        $this->db->like('id_dokter', $keyword);
      	$this->db->or_like('nama_dokter', $keyword);
      	$this->db->or_like('alamat', $keyword);
      	$this->db->or_like('nomor_telpon', $keyword);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search total rows
    function search_name($keyword) {
        $this->db->order_by($this->id, $this->order);
      	$this->db->like('nama_dokter', $keyword);
        return $this->db->get($this->table)->result();
    }


    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_dokter', $keyword);
      	$this->db->or_like('nama_dokter', $keyword);
      	$this->db->or_like('alamat', $keyword);
      	$this->db->or_like('nomor_telpon', $keyword);
      	$this->db->limit($limit, $start);
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
    function delete($data)
    {
        $this->db->where($data);
        $this->db->delete($this->table);
    }

}

/* End of file Model_dokter.php */
/* Location: ./application/models/Model_dokter.php */
