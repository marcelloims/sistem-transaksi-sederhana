<?php

class MasterBarangModel extends CI_Model
{
	public function getData()
	{
		return $this->db->get('master_barang');
	}

	public function getDataByLastTime()
	{
		$this->db->select('kode_barang')->from('master_barang');
		$this->db->limit(1);
		$this->db->order_by("created_at", "desc");
		$query = $this->db->get(); 
		return $query->row();
	}

	public function getDataByLimit($limit, $offset)
	{
		return $this->db->limit($limit, $offset)->get('master_barang');
	}

	public function getRows($table)
	{
		return $this->db->get($table)->num_rows();
	}

	public function getRowById($code)
	{
		return $this->db->where('kode_barang', $code)->get('master_barang');
	}

	public function update($data, $code)
	{
		return $this->db->where('kode_barang', $code)->update('master_barang', $data);
	}

	public function store($data)
	{
		return $this->db->insert('master_barang', $data);
	}

	public function destroy($code)
	{
		return $this->db->where('kode_barang', $code)->delete('master_barang');
	}
}
