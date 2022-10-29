<div>
    <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: center;">
            <li class="page-item">
                <a class="page-link" href="?page_layout=TimKiem&per_page=<?= $QuantityItemPage ?>&page=1&id=<?=$Info_TimKiem?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                <?php if ($i >= $CurrentPage - 1 && $i <= $CurrentPage + 1) { ?>
                    <?php if ($i == $CurrentPage) { ?>
                        <li class="page-item"><strong><a class="page-link" href="#"><?= $CurrentPage ?></a></strong></li>
                    <?php } else { ?>

                        <li class="page-item"><a class="page-link" href="?page_layout=TimKiem&per_page=<?= $QuantityItemPage ?>&page=<?= $i ?>&id=<?=$Info_TimKiem?>"><?= $i ?></a></li>
                    <?php }  ?>
                <?php } ?>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="?page_layout=TimKiem&per_page=<?= $QuantityItemPage ?>&page=<?= $totalPage ?>&id=<?=$Info_TimKiem?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>