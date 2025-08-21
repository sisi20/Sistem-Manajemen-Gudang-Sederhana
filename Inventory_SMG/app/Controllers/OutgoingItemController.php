<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutgoingItemModel;
use App\Models\ProductModel;

class OutgoingItemController extends BaseController
{
    protected $outgoingItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->outgoingItemModel = new OutgoingItemModel();
        $this->productModel      = new ProductModel();
    }

    // Tampilkan semua barang keluar
    public function index()
    {
        $data['outgoing_items'] = $this->outgoingItemModel->getOutgoingWithProduct();

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/barang_keluar/barang_keluar', $data);
        echo view('layout/footer');
    }

    // Form tambah barang keluar
    public function create()
    {
        $data['products'] = $this->productModel->findAll();
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/barang_keluar/form_barang_keluar', $data);
        echo view('layout/footer');
    }

    // Simpan barang keluar dan update stok
    public function store()
    {
        $product_id = $this->request->getPost('product_id');
        $quantity   = (int)$this->request->getPost('quantity');
        $note       = $this->request->getPost('note');

        // Ambil stok barang
        $product = $this->productModel->find($product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan!');
        }

        $current_stock = (int)$product['stock'];

        // Validasi stok
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Jumlah barang keluar harus lebih dari 0!');
        }

        if ($quantity > $current_stock) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $current_stock);
        }

        if ($current_stock - $quantity < 0) {
            return redirect()->back()->with('error', 'Stok tidak boleh minus!');
        }

        // Simpan data barang keluar
        $this->outgoingItemModel->insert([
            'product_id' => $product_id,
            'quantity'   => $quantity,
            'issued_at'  => date('Y-m-d H:i:s'),
            'note'       => $note,
        ]);

        // Update stok produk
        $this->productModel->update($product_id, [
            'stock' => $current_stock - $quantity
        ]);

        return redirect()->to('/outgoing-items')->with('success', 'Barang keluar berhasil disimpan!');
    }

    // Hapus barang keluar dan rollback stok
    public function delete($id)
    {
        $item = $this->outgoingItemModel->find($id);
        if ($item) {
            $this->outgoingItemModel->delete($id);

            // Tambahkan kembali stok produk
            $product = $this->productModel->find($item['product_id']);
            if ($product) {
                $this->productModel->update($item['product_id'], [
                    'stock' => $product['stock'] + $item['quantity']
                ]);
            }
        }

        return redirect()->to('/outgoing-items')->with('success', 'Barang Keluar berhasil dihapus.');
    }
}
