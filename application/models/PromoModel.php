<?php

class PromoModel extends CI_Model
{
	public function getData()
	{
		return $this->db->get('promo');
	}

	public function getDataByLastTime()
	{
		$this->db->select('kode_promo')->from('promo');
		$this->db->limit(1);
		$this->db->order_by("created_at", "desc");
		$query = $this->db->get(); 
		return $query->row();
	}

	public function getDataByLimit($limit, $offset)
	{
		return $this->db->limit($limit, $offset)->get('promo');
	}

	public function getRows($table)
	{
		return $this->db->get($table)->num_rows();
	}

	public function getRowById($code)
	{
		return $this->db->where('kode_promo', $code)->get('promo');
	}

	public function update($data, $code)
	{
		return $this->db->where('kode_promo', $code)->update('promo', $data);
	}

	public function store($data)
	{
		return $this->db->insert('promo', $data);
	}

	public function destroy($code)
	{
		return $this->db->where('kode_promo', $code)->delete('promo');
	}
}
