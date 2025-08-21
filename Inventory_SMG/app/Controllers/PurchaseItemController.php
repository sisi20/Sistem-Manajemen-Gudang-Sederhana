<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PurchaseItemModel;
use App\Models\PurchaseModel;
use App\Models\ProductModel;

class PurchaseItemController extends BaseController
{
    protected $purchaseItemModel;
    protected $purchaseModel;
    protected $productModel;

    public function __construct()
    {
        $this->purchaseItemModel = new PurchaseItemModel();
        $this->purchaseModel     = new PurchaseModel();
        $this->productModel      = new ProductModel();
    }

    // Tampilkan semua item pembelian untuk satu purchase
    public function index($purchase_id)
    {
        $purchase = $this->purchaseModel->getPurchaseById($purchase_id);
        if (!$purchase) {
            return redirect()->to(site_url('purchases'))->with('error', 'Pembelian tidak ditemukan');
        }

        $data['purchase']   = $purchase;
        $data['items']   = $this->purchaseItemModel->getItemsByPurchase($purchase_id);
        $data['products'] = $this->productModel->findAll();

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/pembelian_item', $data);
        echo view('layout/footer');
    }

    // Form tambah item pembelian
    public function create($purchase_id)
    {
        $purchase = $this->purchaseModel->find($purchase_id);
        if (!$purchase) {
            return redirect()->to('/purchases')->with('error', 'Pembelian tidak ditemukan');
        }

        $data = [
            'purchase'   => $purchase,
            'products'   => $this->productModel->findAll(),
            'formAction' => site_url('purchase-item/store'),
            'purchase_id' => $purchase_id,
        ];

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/form_pembelian_item', $data);
        echo view('layout/footer');
    }

    // Simpan item pembelian baru
    public function store()
    {
        $purchase_id = $this->request->getPost('purchase_id');
        $product_id  = $this->request->getPost('product_id');
        $quantity    = $this->request->getPost('quantity');
        $unit_price  = $this->request->getPost('unit_price');

        if (!$purchase_id || !$product_id || !$quantity || !$unit_price) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi');
        }

        $this->purchaseItemModel->save([
            'purchase_id' => $purchase_id,
            'product_id'  => $product_id,
            'quantity'    => $quantity,
            'unit_price'  => $unit_price,
        ]);

        return redirect()->to('/purchase-item/' . $purchase_id)
            ->with('success', 'Item pembelian berhasil ditambahkan');
    }

    // Form edit item pembelian
    public function edit($id)
    {
        $item = $this->purchaseItemModel->find($id);
        if (!$item) {
            return redirect()->to('/purchases')->with('error', 'Item tidak ditemukan');
        }

        $data = [
            'item'       => $item,
            'purchase'   => $this->purchaseModel->find($item['purchase_id']),
            'products'   => $this->productModel->findAll(),
            'formAction' => site_url('purchase-item/update/' . $id),
        ];

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/form_pembelian_item', $data);
        echo view('layout/footer');
    }

    // Update item pembelian
    public function update($id)
    {
        $item = $this->purchaseItemModel->find($id);
        if (!$item) {
            return redirect()->to('/purchases')->with('error', 'Item tidak ditemukan');
        }

        $this->purchaseItemModel->update($id, [
            'product_id' => $this->request->getPost('product_id'),
            'quantity'   => $this->request->getPost('quantity'),
            'unit_price' => $this->request->getPost('unit_price'),
        ]);

        return redirect()->to('/purchase-item/' . $item['purchase_id'])
            ->with('success', 'Item pembelian berhasil diperbarui');
    }

    // Hapus item pembelian
    public function delete($id)
    {
        $item = $this->purchaseItemModel->find($id);
        if (!$item) {
            return redirect()->to('/purchases')->with('error', 'Item tidak ditemukan');
        }

        $this->purchaseItemModel->delete($id);

        return redirect()->to('/purchase-item/' . $item['purchase_id'])
            ->with('success', 'Item pembelian berhasil dihapus');
    }

    // Data untuk navbar AJAX
    public function navbar()
    {
        $items = $this->purchaseItemModel->orderBy('purchase_date', 'DESC')->limit(5)->findAll();
        $count = count($items);
        return $this->response->setJSON(['count' => $count, 'items' => $items]);
    }
}
