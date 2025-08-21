<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan list kategori
    public function index()
    {
        $data['categories'] = $this->categoryModel->getAllCategories();
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/kategori/kategori', $data);
        echo view('layout/footer');
    }

    // Form tambah kategori
    public function create()
    {
        $data['formAction'] = site_url('category/store');
        $data['formTitle'] = 'Tambah Kategori';
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/kategori/form_kategori', $data);
        echo view('layout/footer');
    }

    // Simpan kategori baru
    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name')
        ];

        $this->categoryModel->addCategory($data);

        return redirect()->to(site_url('category'))->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form edit kategori
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);

        if (!$category) {
            return redirect()->to(site_url('category'))->with('error', 'Kategori tidak ditemukan');
        }

        $data['category'] = $category;
        $data['formAction'] = site_url('category/update/' . $id);
        $data['formTitle'] = 'Edit Kategori';

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('data_master/kategori/form_kategori', $data);
        echo view('layout/footer');
    }


    // Update kategori
    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name')
        ];

        $this->categoryModel->updateCategory($id, $data);

        return redirect()->to(site_url('category'))->with('success', 'Kategori berhasil diperbarui');
    }

    // Hapus kategori
    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to(site_url('category'))->with('success', 'Kategori berhasil dihapus');
    }
}
