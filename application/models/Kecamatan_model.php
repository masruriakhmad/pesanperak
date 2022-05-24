<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{

    public $table = 'kecamatan';
    public $id = 'id_kecamatan';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_kecamatan', $q);
	$this->db->or_like('id_kabupaten', $q);
	$this->db->or_like('nama_kecamatan', $q);
	$this->db->or_like('col1', $q);
	$this->db->or_like('col2', $q);
	$this->db->or_like('col3', $q);
	$this->db->or_like('col4', $q);
	$this->db->or_like('col5', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->or_like('isactive', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kecamatan', $q);
	$this->db->or_like('id_kabupaten', $q);
	$this->db->or_like('nama_kecamatan', $q);
	$this->db->or_like('col1', $q);
	$this->db->or_like('col2', $q);
	$this->db->or_like('col3', $q);
	$this->db->or_like('col4', $q);
	$this->db->or_like('col5', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->or_like('isactive', $q);
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
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Kecamatan_model.php */
/* Location: ./application/models/Kecamatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-17 23:52:02 */
/* http://harviacode.com */