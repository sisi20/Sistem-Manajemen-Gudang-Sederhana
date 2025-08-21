<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Item Pembelian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/purchases') ?>">Pembelian</a></li>
                        <li class="breadcrumb-item active">Item Pembelian</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">
                                Item dari Pembelian: <?= esc($purchase['buyer_name'] ?? '-') ?>
                                (<?= esc($purchase['purchase_date'] ?? '-') ?>)
                            </h3>
                            <?php if ($purchase['status'] == 'pending'): ?>
                                <div class="float-right">
                                    <a href="<?= base_url('/purchase-item/create/' . ($purchase['id'] ?? 0)) ?>" class="btn btn-primary btn-sm me-2">
                                        <i class="fas fa-plus"></i> Tambah Item
                                    </a>
                                    <a href="<?= base_url('/incoming-items/create/' . $purchase['id']) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-box"></i> Barang Masuk
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <p>Status Pembelian:
                                <?php if ($purchase['status'] == 'pending'): ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php elseif ($purchase['status'] == 'completed'): ?>
                                    <span class="badge badge-success">Completed</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Canceled</span>
                                <?php endif; ?>
                            </p>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items)):
                                        $no = 1;
                                        $total = 0;
                                        foreach ($items as $item):
                                            $subtotal = ($item['quantity'] ?? 0) * ($item['unit_price'] ?? 0);
                                            $total += $subtotal;
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td><?= esc($item['unit']) ?></td>
                                                <td><?= esc($item['quantity']) ?></td>
                                                <td><?= number_format($item['unit_price'], 0, ',', '.') ?></td>
                                                <td><?= number_format($subtotal, 0, ',', '.') ?></td>
                                                <td>
                                                    <?php if ($purchase['status'] == 'pending'): ?>
                                                        <a href="<?= base_url('/purchase-item/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url('/purchase-item/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach;
                                    else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada item pembelian</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right">Total Keseluruhan:</th>
                                        <th><?= number_format($total ?? 0, 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <a href="<?= base_url('purchases') ?>" class="btn btn-secondary btn-sm mt-2">
                                <i class="fas fa-arrow-left"></i> Kembali ke Pembelian
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>