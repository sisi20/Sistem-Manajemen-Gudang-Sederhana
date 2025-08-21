<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Bisa juga 'object' jika ingin
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'name', 'code', 'unit', 'stock', 'created_at', 'updated_at'];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Ambil semua produk dengan nama kategori
    public function getAllProducts()
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->orderBy('products.name', 'ASC')
            ->findAll();
    }


    public function getProductById($id)
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.id', $id)
            ->first();
    }
    // Tambah produk
    public function addProduct($data)
    {
        return $this->insert($data);
    }

    // Update produk
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    // Hapus produk
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    // Update stok (tidak boleh minus)
    public function updateStock($id, $quantity, $type = 'in')
    {
        $product = $this->find($id);

        if (!$product) return false;

        if ($type === 'in') {
            $newStock = $product['stock'] + $quantity;
        } else {
            $newStock = $product['stock'] - $quantity;
            if ($newStock < 0) return false; // cegah stok minus
        }

        return $this->update($id, ['stock' => $newStock]);
    }

    public function getLowStock($limit = 5)
    {
        return $this->where('stock <=', 5) // stok <= 5 dianggap menipis
            ->orderBy('stock', 'ASC')
            ->findAll($limit);
    }
}
