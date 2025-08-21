<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel  = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    // Tampilkan semua produk
    public function index()
    {
        $data['products']   = $this->productModel->getAllProducts();
        $data['categories'] = $this->categoryModel->findAll();

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/produk/produk', $data);
        echo view('layout/footer');
    }

    // Form tambah produk
    public function create()
    {
        $data['categories'] = $this->categoryModel->findAll();
        $data['formAction'] = site_url('product/store');
        $data['product']    = null; // untuk form multifungsi

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/produk/form_produk', $data);
        echo view('layout/footer');
    }

    // Simpan produk baru
    public function store()
    {
        // Validasi input
        $rules = [
            'category_id' => 'required',
            'name'        => 'required',
            'code'        => 'required|is_unique[products.code]',
            'unit'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'unit'        => $this->request->getPost('unit'),
            'stock'       => 0 // default stock baru
        ];

        if ($this->productModel->insert($data)) {
            return redirect()->to(site_url('products'))
                ->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan produk');
        }
    }

    // Form edit produk
    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to(site_url('products'))->with('error', 'Produk tidak ditemukan');
        }

        $data['product']    = $product;
        $data['categories'] = $this->categoryModel->findAll();
        $data['formAction'] = site_url('product/update/' . $id);

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/produk/form_produk', $data);
        echo view('layout/footer');
    }

    // Update produk
    public function update($id)
    {
        // Validasi input
        $rules = [
            'category_id' => 'required',
            'name'        => 'required',
            'code'        => 'required|is_unique[products.code,id,' . $id . ']',
            'unit'        => 'required',
            'stock'       => 'required|integer|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'name'        => $this->request->getPost('name'),
            'code'        => $this->request->getPost('code'),
            'unit'        => $this->request->getPost('unit'),
            'stock'       => $this->request->getPost('stock'),
        ];

        if ($this->productModel->update($id, $data)) {
            return redirect()->to(site_url('products'))
                ->with('success', 'Produk berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk');
        }
    }

    // Hapus produk
    public function delete($id)
    {
        if ($this->productModel->delete($id)) {
            return redirect()->to(site_url('products'))->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->to(site_url('products'))->with('error', 'Gagal menghapus produk');
        }
    }
}
