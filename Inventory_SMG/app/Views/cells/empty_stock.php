<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        <span class="badge badge-danger navbar-badge"><?= count($emptyStockProducts) ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Stok Kosong</span>
        <div class="dropdown-divider"></div>
        <?php if (count($emptyStockProducts) > 0): ?>
            <?php foreach ($emptyStockProducts as $p): ?>
                <a href="<?= base_url('/products') ?>" class="dropdown-item">
                    <i class="fas fa-exclamation-circle mr-2 text-danger"></i> <?= esc($p['name']) ?>
                </a>
                <div class="dropdown-divider"></div>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="dropdown-item">Tidak ada stok kosong</span>
        <?php endif; ?>
    </div>
</li>