<?php if ($pager->hasMore() || $pager->getCurrentPage() > 1): ?>
<nav>
    <ul class="pagination justify-content-center">

        <!-- Tombol Sebelumnya -->
        <?php if ($pager->getPreviousPageURI()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPageURI() ?>">«</a>
            </li>
        <?php endif; ?>

        <!-- Daftar Halaman -->
        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <!-- Tombol Berikutnya -->
        <?php if ($pager->getNextPageURI()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPageURI() ?>">»</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>
<?php endif ?>
