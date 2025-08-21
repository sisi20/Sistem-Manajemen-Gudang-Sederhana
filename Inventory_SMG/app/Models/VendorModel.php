<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table            = 'vendors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // bisa diubah 'object' jika mau
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'address', 'created_at', 'updated_at'];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Ambil semua vendor
    public function getAllVendors()
    {
        return $this->findAll();
    }

    // Ambil vendor berdasarkan ID
    public function getVendorById($id)
    {
        return $this->find($id);
    }

    // Tambah vendor
    public function addVendor($data)
    {
        return $this->insert($data);
    }

    // Update vendor
    public function updateVendor($id, $data)
    {
        return $this->update($id, $data);
    }

    // Hapus vendor
    public function deleteVendor($id)
    {
        return $this->delete($id);
    }
}
