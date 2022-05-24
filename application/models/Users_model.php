<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id_user';
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
        $this->db->select("bb.*,aa.*");
        $this->db->where($this->id, $id);
        $this->db->join('user_group as bb', 'aa.id_group=bb.id', 'left');
        return $this->db->get($this->table." aa")->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_user', $q);
	$this->db->or_like('fullname', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('id_group', $q);
	$this->db->or_like('foto', $q);
	$this->db->or_like('telp', $q);
	$this->db->or_like('note', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('updated_by', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->or_like('note_1', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->join('user_group ','user_group.id=users.id_group', 'left');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('users.id_user', $q);
	$this->db->or_like('users.fullname', $q);
	$this->db->or_like('users.username', $q);
	$this->db->or_like('users.password', $q);
	$this->db->or_like('users.email', $q);
	$this->db->or_like('users.id_group', $q);
	$this->db->or_like('users.foto', $q);
	$this->db->or_like('users.telp', $q);
	$this->db->or_like('users.note', $q);
	$this->db->or_like('users.created_by', $q);
	$this->db->or_like('users.updated_by', $q);
	$this->db->or_like('users.created_at', $q);
	$this->db->or_like('users.updated_at', $q);
	$this->db->or_like('users.note_1', $q);
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

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-13 02:45:48 */
/* http://harviacode.com */