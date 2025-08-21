 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Kategori</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                         <li class="breadcrumb-item active">Kategori</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">

                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Data Kategori</h3>
                             <a href="<?= base_url('/category/create') ?>" class="btn btn-primary btn-sm float-right">
                                 <i class="fas fa-plus"></i> Tambah Kategori
                             </a>
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

                             <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                     <tr>
                                         <th>No</th>
                                         <th>Nama Kategori</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $no = 1;
                                        foreach ($categories as $cat): ?>
                                         <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $cat['name']; ?></td>
                                             <td>
                                                 <a href="<?= base_url('/category/edit/' . $cat['id']) ?>" class="btn btn-warning btn-sm">
                                                     <i class="fas fa-edit"></i>
                                                 </a>
                                                 <a href="<?= base_url('/category/delete/' . $cat['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">
                                                     <i class="fas fa-trash"></i>
                                                 </a>
                                             </td>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>No</th>
                                         <th>Nama Kategori</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </tfoot>
                             </table>
                         </div>
                     </div>


                 </div>
             </div>
         </div>
     </section>

     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->