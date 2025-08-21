<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\IncomingItemModel;
use App\Models\OutgoingItemModel;
use App\Models\ProductModel;

class DashboardController extends BaseController
{
    protected $purchaseModel;
    protected $incomingModel;
    protected $outgoingModel;
    protected $productModel;

    public function __construct()
    {
        $this->purchaseModel = new PurchaseModel();
        $this->incomingModel = new IncomingItemModel();
        $this->outgoingModel = new OutgoingItemModel();
        $this->productModel  = new ProductModel();
        helper(['url', 'form']);
    }

    // Halaman dashboard
    public function index()
    {
        // Statistik umum
        $data['total_purchases'] = $this->purchaseModel->countAllResults();
        $data['total_incoming']  = $this->incomingModel->countAllResults();
        $data['total_outgoing']  = $this->outgoingModel->countAllResults();
        $data['total_products']  = $this->productModel->countAllResults();

        // Ringkasan stok per produk
        $products = $this->productModel->findAll();
        $stock_summary = [];
        foreach ($products as $p) {
            // Hitung barang masuk per produk
            $incoming = $this->incomingModel->where('product_id', $p['id'])->countAllResults();
            // Hitung barang keluar per produk
            $outgoing = $this->outgoingModel->where('product_id', $p['id'])->countAllResults();
            $stock_summary[] = [
                'name' => $p['name'],
                'stock' => $p['stock'],
                'incoming' => $incoming,
                'outgoing' => $outgoing
            ];
        }
        $data['stock_summary'] = $stock_summary;

        // Transaksi hari ini
        $today = date('Y-m-d');
        $data['today_incoming'] = $this->incomingModel->where('DATE(received_at)', $today)->countAllResults();
        $data['today_outgoing'] = $this->outgoingModel->where('DATE(issued_at)', $today)->countAllResults();


        // Load view
        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('dashboard', $data);
        echo view('layout/footer');
    }


    // Fungsi laporan dengan filter tanggal
    public function laporan()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date   = $this->request->getGet('end_date');

        $incoming_items = $this->incomingModel->getFiltered($start_date, $end_date);
        $outgoing_items = $this->outgoingModel->getFiltered($start_date, $end_date);

        $data = [
            'purchases'      => $this->purchaseModel->findAll(),
            'incoming_items' => $incoming_items,
            'outgoing_items' => $outgoing_items,
            'products'       => $this->productModel->findAll(),
            'start_date'     => $start_date,
            'end_date'       => $end_date,
        ];

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('report/laporan', $data);
        echo view('layout/footer');
    }
}
