<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembelian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Pembelian</li>
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
                            <h3 class="card-title">Daftar Pembelian</h3>
                            <a href="<?= base_url('/purchase/create') ?>" class="btn btn-primary btn-sm float-right">
                                <i class="fas fa-plus"></i> Tambah Pembelian
                            </a>
                        </div>
                        <div class="card-body">

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Vendor</th>
                                            <th>Pembeli</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($purchases as $purchase): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($purchase['vendor_name']) ?></td>
                                                <td><?= esc($purchase['buyer_name']) ?></td>
                                                <td><?= esc($purchase['purchase_date']) ?></td>
                                                <td><?= esc($purchase['status']) ?></td>
                                                <td>
                                                    <?php if ($purchase['status'] == 'pending'): ?>
                                                        <a href="<?= base_url('/purchase/edit/' . $purchase['id']) ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url('/purchase/delete/' . $purchase['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('purchase-item/' . $purchase['id']) ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat Item
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>