<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProdukController extends BaseController
{
    private const PRODUCT_FIELDS = [
        'kode_produk',
        'nama_produk',
        'satuan',
        'harga_jual',
        'stok',
    ];

    private const VALIDATION_RULES = [
        'kode_produk' => 'required|max_length[20]',
        'nama_produk' => 'required|max_length[100]',
        'satuan'      => 'required|max_length[30]',
        'harga_jual'  => 'required|decimal|greater_than_equal_to[0]',
        'stok'        => 'required|integer|greater_than_equal_to[0]',
    ];

    public function index()
    {
        $data['produk'] = \Config\Database::connect()
            ->table('produk')
            ->orderBy('kode_produk', 'ASC')
            ->get()
            ->getResultArray();

        return view('penjualan/produk_view', $data);
    }

    public function create()
    {
        return view('penjualan/produk_form', [
            'title'   => 'Tambah Produk',
            'action'  => site_url('produk/store'),
            'produk'  => array_fill_keys(self::PRODUCT_FIELDS, ''),
            'errors'  => [],
            'isEdit'  => false,
        ]);
    }

    public function store()
    {
        return $this->saveProduct();
    }

    public function edit(string $kodeProduk)
    {
        $produk = $this->findProduct($kodeProduk);

        return view('penjualan/produk_form', [
            'title'  => 'Ubah Produk',
            'action' => site_url('produk/update/' . rawurlencode($kodeProduk)),
            'produk' => $produk,
            'errors' => [],
            'isEdit' => true,
        ]);
    }

    public function update(string $kodeProduk)
    {
        return $this->saveProduct($kodeProduk);
    }

    public function delete(string $kodeProduk)
    {
        $db = \Config\Database::connect();
        $produk = $this->findProduct($kodeProduk);

        try {
            $deleted = $db->table('produk')
                ->where('kode_produk', $kodeProduk)
                ->delete();
        } catch (DatabaseException $exception) {
            log_message('error', 'Gagal menghapus produk {kode}: {error}', [
                'kode'  => $kodeProduk,
                'error' => $exception->getMessage(),
            ]);

            return redirect()->to(site_url('produk'))
                ->with('error', 'Produk tidak dapat dihapus. Pastikan produk tidak sedang digunakan dalam transaksi.');
        }

        if (! $deleted) {
            log_message('error', 'Query penghapusan produk {kode} gagal: {error}', [
                'kode'  => $kodeProduk,
                'error' => $db->error()['message'] ?? 'Unknown database error',
            ]);

            return redirect()->to(site_url('produk'))
                ->with('error', 'Produk gagal dihapus. Silakan coba lagi.');
        }

        return redirect()->to(site_url('produk'))
            ->with('success', 'Produk ' . $produk['nama_produk'] . ' berhasil dihapus.');
    }

    private function saveProduct(?string $kodeProduk = null)
    {
        $isEdit = $kodeProduk !== null;
        if ($isEdit) {
            $this->findProduct($kodeProduk);
        }

        $submitted = $this->request->getPost(self::PRODUCT_FIELDS);
        $produk = [];

        foreach (self::PRODUCT_FIELDS as $field) {
            $produk[$field] = trim((string) ($submitted[$field] ?? ''));
        }

        if ($isEdit) {
            $produk['kode_produk'] = $kodeProduk;
        }

        $validation = service('validation');
        $validation->setRules(self::VALIDATION_RULES);
        $validation->run($produk);
        $errors = $validation->getErrors();

        if (! $isEdit && $produk['kode_produk'] !== '' && $this->productCodeExists($produk['kode_produk'])) {
            $errors['kode_produk'] = 'Kode produk tersebut sudah digunakan.';
        }

        if ($errors !== []) {
            return $this->renderForm($produk, $errors, $isEdit, $kodeProduk);
        }

        $newKodeProduk = $produk['kode_produk'];
        unset($produk['kode_produk']);
        $db = \Config\Database::connect();

        try {
            $builder = $db->table('produk');
            $saved = $isEdit
                ? $builder->where('kode_produk', $kodeProduk)->update($produk)
                : $builder->insert(['kode_produk' => $newKodeProduk] + $produk);
        } catch (DatabaseException $exception) {
            log_message('error', 'Gagal menyimpan produk {kode}: {error}', [
                'kode'  => $kodeProduk ?? $newKodeProduk,
                'error' => $exception->getMessage(),
            ]);

            return $this->renderForm(
                array_merge($produk, ['kode_produk' => $kodeProduk ?? $newKodeProduk]),
                ['database' => 'Produk gagal disimpan. Periksa kembali data dan pastikan kode produk belum digunakan.'],
                $isEdit,
                $kodeProduk
            );
        }

        if (! $saved) {
            log_message('error', 'Query penyimpanan produk gagal: {error}', [
                'error' => $db->error()['message'] ?? 'Unknown database error',
            ]);

            return $this->renderForm(
                array_merge($produk, ['kode_produk' => $kodeProduk ?? $newKodeProduk]),
                ['database' => 'Produk gagal disimpan. Silakan coba lagi.'],
                $isEdit,
                $kodeProduk
            );
        }

        return redirect()->to(site_url('produk'))
            ->with('success', $isEdit ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');
    }

    private function renderForm(array $produk, array $errors, bool $isEdit, ?string $kodeProduk)
    {
        return $this->response->setStatusCode(422)->setBody(view('penjualan/produk_form', [
            'title'  => $isEdit ? 'Ubah Produk' : 'Tambah Produk',
            'action' => $isEdit
                ? site_url('produk/update/' . rawurlencode((string) $kodeProduk))
                : site_url('produk/store'),
            'produk' => $produk,
            'errors' => $errors,
            'isEdit' => $isEdit,
        ]));
    }

    private function findProduct(string $kodeProduk): array
    {
        $produk = \Config\Database::connect()
            ->table('produk')
            ->where('kode_produk', $kodeProduk)
            ->get()
            ->getRowArray();

        if ($produk === null) {
            throw PageNotFoundException::forPageNotFound('Produk tidak ditemukan.');
        }

        return $produk;
    }

    private function productCodeExists(string $kodeProduk): bool
    {
        return \Config\Database::connect()
            ->table('produk')
            ->where('kode_produk', $kodeProduk)
            ->countAllResults() > 0;
    }
}