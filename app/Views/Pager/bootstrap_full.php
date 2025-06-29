<?php $pager->setSurroundCount(1) ?>

<?php if ($pager->hasPages()) : ?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Tombol ke halaman pertama -->
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                    &laquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                    &lsaquo;
                </a>
            </li>
        <?php endif ?>

        <!-- Link halaman -->
        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <!-- Tombol ke halaman terakhir -->
        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Next">
                    &rsaquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                    &raquo;
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
<?php endif ?>
