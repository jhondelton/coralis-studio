<?php if (session()->has('user')) { ?>
<li class="has-submenu">
    <a href="<?= base_url('/') ?>">
        <i class="mdi mdi-home-outline"></i>Dasbor
    </a>
</li>
<?php } else { ?>
<li class="has-submenu">
    <a href="<?= base_url('auth/login') ?>">
        <i class="mdi mdi-account-arrow-right-outline"></i>Masuk
    </a>
</li>
<li class="has-submenu">
    <a href="<?= base_url('auth/register') ?>">
        <i class="mdi mdi-account-plus-outline"></i>Daftar
    </a>
</li>
<li class="has-submenu">
    <a href="<?= base_url('auth/reset') ?>">
        <i class="mdi mdi-account-key-outline"></i>Lupa Password
    </a>
</li>
<?php } ?>