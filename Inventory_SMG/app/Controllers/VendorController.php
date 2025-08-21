<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VendorModel;

class VendorController extends BaseController
{
    protected $vendorModel;

    public function __construct()
    {
        $this->vendorModel = new VendorModel();
    }

    // Tampilkan semua vendor
    public function index()
    {
        $data['vendors'] = $this->vendorModel->getAllVendors();
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/vendor/vendor', $data);
        echo view('layout/footer');
    }

    // Form tambah vendor
    public function create()
    {
        $data['formAction'] = site_url('vendor/store');
        $data['formTitle']  = 'Tambah Vendor';
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/vendor/form_vendor', $data);
        echo view('layout/footer');
    }

    // Simpan vendor baru
    public function store()
    {
        $this->vendorModel->save([
            'name'    => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/vendors')->with('success', 'Vendor berhasil ditambahkan');
    }

    // Form edit vendor
    public function edit($id)
    {
        $vendor = $this->vendorModel->getVendorById($id);
        if (!$vendor) {
            return redirect()->to('/vendors')->with('error', 'Vendor tidak ditemukan');
        }

        $data['vendor']     = $vendor;
        $data['formAction'] = site_url('vendor/update/' . $id);
        $data['formTitle']  = 'Edit Vendor';
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/vendor/form_vendor', $data);
        echo view('layout/footer');
    }

    // Update vendor
    public function update($id)
    {
        $this->vendorModel->updateVendor($id, [
            'name'    => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/vendors')->with('success', 'Vendor berhasil diperbarui');
    }

    // Hapus vendor
    public function delete($id)
    {
        $this->vendorModel->deleteVendor($id);
        return redirect()->to('/vendors')->with('success', 'Vendor berhasil dihapus');
    }
}
