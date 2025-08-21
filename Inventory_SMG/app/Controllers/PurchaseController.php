<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PurchaseModel;
use App\Models\VendorModel;

class PurchaseController extends BaseController
{
    protected $purchaseModel;
    protected $vendorModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchaseModel();
        $this->vendorModel   = new VendorModel();
    }

    // Tampilkan semua pembelian
    public function index()
    {
        $data['purchases'] = $this->purchaseModel->getAllPurchases(); // ambil dengan join vendor
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/pembelian', $data);
        echo view('layout/footer');
    }

    // Form tambah pembelian
    public function create()
    {
        $data['vendors']    = $this->vendorModel->findAll();
        $data['formAction'] = site_url('purchase/store');
        $data['formTitle']  = 'Tambah Pembelian';

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/form_pembelian', $data);
        echo view('layout/footer');
    }

    // Simpan pembelian baru
    public function store()
    {
        $this->purchaseModel->addPurchase([
            'vendor_id'     => $this->request->getPost('vendor_id'),
            'buyer_name'    => $this->request->getPost('buyer_name'),
            'purchase_date' => $this->request->getPost('purchase_date'),
            'status'        => $this->request->getPost('status') ?? 'Pending',
        ]);

        return redirect()->to(site_url('purchases'))->with('success', 'Pembelian berhasil ditambahkan');
    }

    // Form edit pembelian
    public function edit($id)
    {
        $purchase = $this->purchaseModel->getPurchaseById($id);
        if (!$purchase) {
            return redirect()->to(site_url('purchases'))->with('error', 'Pembelian tidak ditemukan');
        }

        $data['purchase']   = $purchase;
        $data['vendors']    = $this->vendorModel->findAll();
        $data['formAction'] = site_url('purchase/update/' . $id);
        $data['formTitle']  = 'Edit Pembelian';

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/pembelian/form_pembelian', $data);
        echo view('layout/footer');
    }

    // Update pembelian
    public function update($id)
    {
        $this->purchaseModel->updatePurchase($id, [
            'vendor_id'     => $this->request->getPost('vendor_id'),
            'buyer_name'    => $this->request->getPost('buyer_name'),
            'purchase_date' => $this->request->getPost('purchase_date'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to(site_url('purchases'))->with('success', 'Pembelian berhasil diperbarui');
    }

    // Hapus pembelian
    public function delete($id)
    {
        $this->purchaseModel->deletePurchase($id);
        return redirect()->to(site_url('purchases'))->with('success', 'Pembelian berhasil dihapus');
    }
}
