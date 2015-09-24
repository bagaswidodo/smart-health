<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_praktek_dokter_model extends CI_Model
{

    public $table = 'tb_faskes_praktek_dokter';
    public $id = '';
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

    // get all
    function get_jadwal($data)
    {
        $this->db->where($data);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($data)
    {
      //  $this->db->where($this->id, $id);
        $this->db->where($data);
        //return $this->db->get($this->table)->row();
        return $this->db->get('jadwal_praktek_dokter')->row();

    }

    // get data by id
    function get_name($data)
    {
      //  $this->db->where($this->id, $id);
        $this->db->where($data);
        return $this->db->get('dokter_faskes')->row();
    }

    function cek_hari($data)
    {
        $this->db->select('hari');
        $this->db->where($data);
        return $this->db->get('jadwal_praktek_dokter');
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
        $this->db->like('', $keyword);
      	$this->db->or_like('hari', $keyword);
      	$this->db->or_like('jam_buka', $keyword);
      	$this->db->or_like('jam_tutup', $keyword);
      	$this->db->or_like('jam_mulai_istirahat', $keyword);
      	$this->db->or_like('jam_selesai_istirahat', $keyword);
      	$this->db->or_like('id_faskes', $keyword);
      	$this->db->or_like('id_dokter', $keyword);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $keyword);
      	$this->db->or_like('hari', $keyword);
      	$this->db->or_like('jam_buka', $keyword);
      	$this->db->or_like('jam_tutup', $keyword);
      	$this->db->or_like('jam_mulai_istirahat', $keyword);
      	$this->db->or_like('jam_selesai_istirahat', $keyword);
      	$this->db->or_like('id_faskes', $keyword);
      	$this->db->or_like('id_dokter', $keyword);
      	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($data)
    {
        $this->db->where($data);
        $this->db->delete($this->table);

    }

}

/* End of file Faskes_praktek_dokter_model.php */
/* Location: ./application/models/Faskes_praktek_dokter_model.php */
