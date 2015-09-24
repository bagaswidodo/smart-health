<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_open_model extends CI_Model
{

    public $table = 'tb_faskes_open';
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
        return $this->db->get('jadwal_faskes')->result(); //without view

    }

    // get all jadwal faskes open
    function get_jadwal($id_faskes)
    {
        $this->db->where('id_faskes',$id_faskes);
        $this->db->order_by('hari','ASC');
        //return $this->db->get('tb_faskes_open')->result();
          return $this->db->get('jadwal_faskes')->result();//with view
    }

    // get data by id
    function get_by_id($data)
    {
        $this->db->where($data);
        //return $this->db->get($this->table)->row();
        return $this->db->get('jadwal_faskes')->row();
    }

    function getByData($data)
    {
        $this->db->where($data);
        return $this->db->get($this->table);
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
      	$this->db->or_like('id_faskes', $keyword);
      	$this->db->or_like('hari', $keyword);
      	$this->db->or_like('jam_buka', $keyword);
      	$this->db->or_like('jam_tutup', $keyword);
      	$this->db->or_like('jam_mulai_istirahat', $keyword);
      	$this->db->or_like('jam_selesai_istirahat', $keyword);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $keyword);
      	$this->db->or_like('id_faskes', $keyword);
      	$this->db->or_like('hari', $keyword);
      	$this->db->or_like('jam_buka', $keyword);
      	$this->db->or_like('jam_tutup', $keyword);
      	$this->db->or_like('jam_mulai_istirahat', $keyword);
      	$this->db->or_like('jam_selesai_istirahat', $keyword);
      	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($finder, $data)
    {
        $this->db->where($finder);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($data)
    {
        $this->db->where($data);
        $this->db->delete($this->table);
    }

}

/* End of file Faskes_open_model.php */
/* Location: ./application/models/Faskes_open_model.php */
