<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseItemModel extends Model
{
    protected $table            = 'purchase_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // <--- NONAKTIFKAN
    protected $protectFields    = true;
    protected $allowedFields    = ['purchase_id', 'product_id', 'quantity', 'unit_price', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil semua item untuk satu purchase
     */
    public function getItemsByPurchase($purchase_id)
    {
        return $this->select('purchase_items.*, products.name as product_name, products.unit')
            ->join('products', 'products.id = purchase_items.product_id', 'left')
            ->where('purchase_items.purchase_id', $purchase_id)
            ->findAll();
    }

    /**
     * Ambil item tertentu dengan join product
     * @param int $id
     * @return array|null
     */
    public function getItemWithProduct($id)
    {
        return $this->select('purchase_items.*, products.name as product_name, products.unit')
            ->join('products', 'products.id = purchase_items.product_id', 'left')
            ->where('purchase_items.id', $id)
            ->first();
    }

    /**
     * Hitung total harga satu purchase
     */
    public function getTotalByPurchase($purchase_id)
    {
        $items = $this->getItemsByPurchase($purchase_id);
        $total = 0;
        foreach ($items as $item) {
            $quantity   = isset($item['quantity']) ? (float)$item['quantity'] : 0;
            $unit_price = isset($item['unit_price']) ? (float)$item['unit_price'] : 0;
            $total += $quantity * $unit_price;
        }
        return $total;
    }

    // Ambil semua item purchase + total barang masuk
    public function getPendingItemsByPurchase($purchase_id)
    {
        return $this->select('purchase_items.*, products.name as product_name, products.unit,
                             COALESCE(SUM(incoming_items.quantity), 0) as total_received')
            ->join('products', 'products.id = purchase_items.product_id', 'left')
            ->join('incoming_items', 'incoming_items.purchase_item_id = purchase_items.id', 'left')
            ->where('purchase_items.purchase_id', $purchase_id)
            ->groupBy('purchase_items.id, products.name, products.unit')
            ->findAll();
    }
}
