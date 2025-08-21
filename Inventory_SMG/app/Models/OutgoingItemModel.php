<?php

namespace App\Models;

use CodeIgniter\Model;

class OutgoingItemModel extends Model
{
    protected $table            = 'outgoing_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'issued_at', 'quantity', 'note', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // Ambil semua outgoing item dengan nama produk
    public function getOutgoingWithProduct()
    {
        return $this->select('outgoing_items.*, products.name as product_name, products.unit')
            ->join('products', 'products.id = outgoing_items.product_id')
            ->orderBy('issued_at', 'DESC')
            ->findAll();
    }

    public function getOutgoingByDateRange($start, $end)
    {
        return $this->select('outgoing_items.*, products.name as product_name, products.unit')
            ->join('products', 'products.id = outgoing_items.product_id')
            ->where('issued_at >=', $start)
            ->where('issued_at <=', $end)
            ->orderBy('issued_at', 'ASC')
            ->findAll();
    }

    public function getFiltered($start_date = null, $end_date = null)
    {
        $builder = $this->select('outgoing_items.*, products.name as product_name')
            ->join('products', 'outgoing_items.product_id = products.id', 'left');

        if ($start_date && $end_date) {
            $builder->where('issued_at >=', $start_date . ' 00:00:00')
                ->where('issued_at <=', $end_date . ' 23:59:59');
        }

        return $builder->findAll();
    }
}
