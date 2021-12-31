<nav>
    <ul class="pagination">
        <li class="page-item <?php if ($page == 1) echo 'disabled' ?>"><a class="page-link" href="<?php echo $link . '1';
                                                                                                    if (!empty($search)) echo '?search=' . $search  ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($page == $i) {
        ?>
                <li class="page-item active"><a class="page-link" href="<?php echo $link . $i;
                                                                        if (!empty($search)) echo '?search=' . $search  ?>"><?php echo $i; ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item "><a class="page-link" href="<?php echo $link . $i;
                                                                    if (!empty($search)) echo '?search=' . $search  ?>"><?php echo $i; ?></a></li>
        <?php
            }
        }
        ?>
        <li class="page-item <?php if ($page == $count) echo 'disabled' ?>"><a class="page-link" href="<?php echo $link . $count;
                                                                                                        if (!empty($search)) echo '?search=' . $search  ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
    </ul>
</nav>