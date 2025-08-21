<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IncomingItemModel;
use App\Models\ProductModel;
use App\Models\PurchaseItemModel;
use App\Models\PurchaseModel;

class IncomingItemController extends BaseController
{
    protected $incomingItemModel;
    protected $purchaseItemModel;
    protected $productModel;
    protected $purchaseModel;

    public function __construct()
    {
        $this->incomingItemModel = new IncomingItemModel();
        $this->purchaseItemModel = new PurchaseItemModel();
        $this->productModel      = new ProductModel();
        $this->purchaseModel     = new PurchaseModel();
    }
    // Tampilkan semua barang masuk
    public function index()
    {
        $incomingItemModel = new IncomingItemModel();
        $data['incoming_items'] = $incomingItemModel->getIncomingItems();

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/barang_masuk/barang_masuk', $data);
        echo view('layout/footer');
    }

    // Form input barang masuk
    public function create($purchase_id)
    {
        $purchase = $this->purchaseModel->find($purchase_id);
        if (!$purchase || $purchase['status'] != 'pending') {
            return redirect()->back()->with('error', 'Pembelian tidak bisa ditambahkan barang masuk.');
        }

        $data = [
            'purchase' => $purchase,
            'items'    => $this->purchaseItemModel->getPendingItemsByPurchase($purchase_id)
        ];

        echo view('layout/header');
        echo view('layout/sidebar');
        echo view('transaksi/barang_masuk/form_barang_masuk', $data);
        echo view('layout/footer');
    }

    // Simpan barang masuk
    public function store()
    {
        $purchase_id = $this->request->getPost('purchase_id');
        $purchase    = $this->purchaseModel->find($purchase_id);

        if (!$purchase || $purchase['status'] != 'pending') {
            return redirect()->back()->with('error', 'Tidak bisa menambahkan barang masuk.');
        }

        $items = $this->request->getPost('items'); // ['purchase_item_id' => qty_received]
        foreach ($items as $purchase_item_id => $qty_received) {
            if ($qty_received > 0) {
                $purchaseItem = $this->purchaseItemModel->find($purchase_item_id);
                $productId    = $purchaseItem['product_id'];

                // Simpan incoming item
                $this->incomingItemModel->insert([
                    'purchase_item_id' => $purchase_item_id,
                    'product_id'       => $productId,
                    'quantity'         => $qty_received,
                    'received_at'      => date('Y-m-d H:i:s')
                ]);

                // Update stok produk
                $product = $this->productModel->find($productId);
                $newStock = $product['stock'] + $qty_received;
                $this->productModel->update($productId, ['stock' => $newStock]);
            }
        }

        // Update status purchase
        $allItems    = $this->purchaseItemModel->getItemsByPurchase($purchase_id);
        $totalOrder  = array_sum(array_column($allItems, 'quantity'));
        $incomingAll = $this->incomingItemModel->getIncomingByPurchase($purchase_id);
        $totalReceived = array_sum(array_column($incomingAll, 'quantity'));

        $status = $totalReceived >= $totalOrder ? 'completed' : 'pending';
        $this->purchaseModel->update($purchase_id, ['status' => $status]);

        // Redirect ke halaman index
        return redirect()->to(site_url('incoming-items'))->with('success', 'Barang masuk berhasil disimpan.');
    }

    // Hapus barang masuk dan rollback stok
    public function delete($id)
    {
        $item = $this->incomingItemModel->find($id);

        if ($item) {
            $this->incomingItemModel->delete($id);

            $product = $this->productModel->find($item['product_id']);
            $this->productModel->update($item['product_id'], [
                'stock' => $product['stock'] - $item['quantity']
            ]);
        }

        return redirect()->to(site_url('incoming-items'))->with('success', 'Barang masuk berhasil dihapus.');
    }

    // Data untuk navbar AJAX
    public function navbar()
    {
        $items = $this->incomingItemModel->orderBy('received_at', 'DESC')->limit(5)->findAll();
        $count = count($items);
        return $this->response->setJSON(['count' => $count, 'items' => $items]);
    }
}
