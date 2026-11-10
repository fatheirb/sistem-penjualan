<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PenjualanController extends Controller
{
  public function joinPenjualan()
{
    $db = \Config\Database::connect();
    $builder = $db->table('penjualan p');

  // Kolom di tabel PostgreSQL adalah tgl_penjualan dan total, bukan tanggal/total_transaksi.
  $builder->select('p.no_penjualan, p.tgl_penjualan AS tanggal, c.nama_pelanggan, p.total AS total_transaksi', false);
    $builder->join('pelanggan c', 'c.kode_pelanggan = p.kode_pelanggan');
  $builder->orderBy('p.tgl_penjualan', 'DESC');

  $data['penjualan'] = $builder->get()->getResultArray();

  return view('penjualan/join_view', $data);
}
    public function agregasiPelanggan()
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pelanggan c');
        $builder->select('c.kode_pelanggan, c.nama_pelanggan, COUNT(p.no_penjualan) as jumlah_transaksi, SUM(p.total) as total_nilai_penjualan');
        $builder->join('penjualan p', 'p.kode_pelanggan = c.kode_pelanggan', 'left');
        $builder->groupBy('c.kode_pelanggan, c.nama_pelanggan');
        
        $data['agregasi'] = $builder->get()->getResultArray();
        
        return view('penjualan/agregasi_view', $data);
    }
}