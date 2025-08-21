<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($category) ? 'Edit Kategori' : 'Tambah Kategori' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active"><?= isset($category) ? 'Edit Kategori' : 'Tambah Kategori' ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- form column -->
                <div class="col-md-12">
                    <!-- form card -->
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white"><?= isset($category) ? 'Form Edit Kategori' : 'Form Tambah Kategori' ?></h3>
                        </div>
                        <!-- form start -->
                        <form action="<?= isset($formAction) ? $formAction : site_url('category/store') ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Nama Kategori</label>
                                    <input type="text" class="form-control" id="category_name" name="name"
                                        placeholder="Masukkan nama kategori"
                                        value="<?= isset($category) ? $category['name'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= site_url('category') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->