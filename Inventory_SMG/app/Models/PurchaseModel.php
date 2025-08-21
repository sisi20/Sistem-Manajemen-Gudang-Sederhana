<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // lebih fleksibel untuk view
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['vendor_id', 'buyer_name', 'purchase_date', 'status', 'created_at', 'updated_at'];

    // Timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil semua pembelian beserta nama vendor
     */
    public function getAllPurchases()
    {
        return $this->select('purchases.*, vendors.name as vendor_name')
            ->join('vendors', 'vendors.id = purchases.vendor_id', 'left')
            ->orderBy('purchases.purchase_date', 'DESC')
            ->findAll();
    }

    /**
     * Ambil satu pembelian beserta nama vendor
     */
    public function getPurchaseById($id)
    {
        return $this->select('purchases.*, vendors.name as vendor_name')
            ->join('vendors', 'vendors.id = purchases.vendor_id', 'left')
            ->where('purchases.id', $id)
            ->first();
    }

    public function getPurchaseId($id)
    {
        return $this->find($id);
    }
    /**
     * Tambah pembelian baru
     */
    public function addPurchase($data)
    {
        return $this->insert($data);
    }

    /**
     * Update pembelian
     */
    public function updatePurchase($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Hapus pembelian
     */
    public function deletePurchase($id)
    {
        return $this->delete($id);
    }
}
