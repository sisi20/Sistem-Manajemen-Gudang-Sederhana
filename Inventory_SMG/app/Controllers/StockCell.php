<?php

namespace App\Controllers;

use App\Models\ProductModel;

class StockCell
{
    public function emptyStock()
    {
        $productModel = new ProductModel();
        $emptyStock = $productModel->where('stock', 0)->findAll();

        return view('cells/empty_stock', ['emptyStockProducts' => $emptyStock]);
    }
}
