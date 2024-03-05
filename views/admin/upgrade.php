<div class="container py-5">
    <div class="align-items-center text-center">
        <h2>Fitur <span class="text-warning"><u>Kurir</u></span> hanya tersedia jika Anda Upgrade ke <span class="text-warning"><u>Premium</u></span></h2>
        <?php
        echo '<a class="mt-3 btn btn-lg btn-warning" href="' . raj_fs()->get_upgrade_url() . '">' .
            __('Upgrade Sekarang <i class="fa-solid fa-chevron-right"></i>', 'rajaongkirstarter') .
            '</a>';
        ?>
    </div>
</div>