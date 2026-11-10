<?php

use Config\Services;

$routes = Services::routes();

// Route Utama / Default
$routes->get('/', 'Home::index');

// Route Produk (CRUD)
$routes->get('produk', 'ProdukController::index');
$routes->get('produk/create', 'ProdukController::create');
$routes->get('produk/edit/(:segment)', 'ProdukController::edit/$1');
$routes->post('produk/store', 'ProdukController::store');
$routes->post('produk/update/(:segment)', 'ProdukController::update/$1');
$routes->post('produk/delete/(:segment)', 'ProdukController::delete/$1');

// Route Penjualan (JOIN & Agregasi)
$routes->get('penjualan/join', 'PenjualanController::joinPenjualan');
$routes->get('penjualan/agregasi', 'PenjualanController::agregasiPelanggan');