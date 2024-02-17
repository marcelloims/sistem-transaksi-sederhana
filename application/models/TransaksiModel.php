<?php

class TransaksiModel extends CI_Model
{
	public function getDataByLastTime()
	{
		$this->db->select('no_transaksi')->from('penjualan_header');
		$this->db->limit(1);
		$this->db->order_by("created_at", "desc");
		$query = $this->db->get(); 
		return $query->row();
	}

	public function save($transaksi,  $format_no_transaksi)
	{
		$this->db->insert('penjualan_header', $transaksi);

		foreach ($this->cart->contents() as $data) {
			$datailTransaksi = [
				"no_transaksi"	=> $format_no_transaksi,
				"kode_barang"	=> $data['id'],
				"qty"			=> $data['qty'],
				"harga"			=> $data['price'],
				"subtotal"		=> $data['subtotal']
			];

			$this->db->insert('penjualan_header_detail', $datailTransaksi);
		}

		return true;
	}
}
