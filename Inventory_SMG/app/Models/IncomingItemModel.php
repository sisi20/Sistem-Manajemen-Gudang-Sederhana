<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomingItemModel extends Model
{
    protected $table            = 'incoming_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'purchase_item_id',
        'product_id',
        'received_at',
        'quantity',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Tambahkan method custom
    public function getAllIncoming()
    {
        return $this->select('incoming_items.*, products.name as product_name, purchases.buyer_name, purchases.purchase_date')
            ->join('products', 'products.id = incoming_items.product_id')
            ->join('purchase_items', 'purchase_items.id = incoming_items.purchase_item_id')
            ->join('purchases', 'purchases.id = purchase_items.purchase_id')
            ->findAll();
    }

    public function getIncomingByPurchase($purchaseId)
    {
        return $this->select('
                incoming_items.*, 
                products.name AS product_name, 
                purchase_items.unit_price
            ')
            ->join('purchase_items', 'purchase_items.id = incoming_items.purchase_item_id')
            ->join('products', 'products.id = incoming_items.product_id')
            ->where('purchase_items.purchase_id', $purchaseId)
            ->orderBy('incoming_items.received_at', 'DESC')
            ->findAll();
    }

    public function getIncomingItems()
    {
        return $this->select('
                incoming_items.*, 
                products.name as product_name, 
                categories.name as category_name,
                vendors.name as vendor_name
            ')
            ->join('products', 'products.id = incoming_items.product_id')
            ->join('categories', 'categories.id = products.category_id')
            ->join('purchase_items', 'purchase_items.id = incoming_items.purchase_item_id', 'left')
            ->join('purchases', 'purchases.id = purchase_items.purchase_id', 'left')
            ->join('vendors', 'vendors.id = purchases.vendor_id', 'left')
            ->findAll();
    }

    public function getIncomingWithProduct()
    {
        return $this->select('incoming_items.*, products.name as product_name')
            ->join('products', 'products.id = incoming_items.product_id')
            ->orderBy('received_at', 'DESC')
            ->findAll();
    }

    public function getFiltered($start_date = null, $end_date = null)
    {
        $builder = $this->select('incoming_items.*, products.name as product_name')
            ->join('products', 'incoming_items.product_id = products.id', 'left');

        if ($start_date && $end_date) {
            $builder->where('received_at >=', $start_date . ' 00:00:00')
                ->where('received_at <=', $end_date . ' 23:59:59');
        }

        return $builder->findAll();
    }
}
