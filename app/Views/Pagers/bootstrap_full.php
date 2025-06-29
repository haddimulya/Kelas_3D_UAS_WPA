<nav aria-label="Navigasi halaman">
    <ul class="pagination justify-content-center">
        <?php if ($pager->hasPrevious()): ?>
            <!-- Tombol pertama -->
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" title="Halaman pertama" aria-label="<?= lang('Pager.first') ?>">
                    «
                </a>
            </li>
            <!-- Tombol sebelumnya -->
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPageURI() ?>" title="Sebelumnya" aria-label="<?= lang('Pager.previous') ?>">
                    ‹
                </a>
            </li>
        <?php endif; ?>

        <!-- Nomor halaman -->
        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()): ?>
            <!-- Tombol berikutnya -->
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPageURI() ?>" title="Berikutnya" aria-label="<?= lang('Pager.next') ?>">
                    ›
                </a>
            </li>
            <!-- Tombol terakhir -->
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" title="Halaman terakhir" aria-label="<?= lang('Pager.last') ?>">
                    »
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
