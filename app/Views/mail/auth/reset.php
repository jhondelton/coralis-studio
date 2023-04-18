<?= $this->extend('mail/template') ?>
<?= $this->section('content') ?>
<table class="wrapper table" width="100%" cellpadding="0" cellspacing="0"  role="presentation" data-token="<?= $content['token'] ?>">
    <tr>
        <td align="center td">
            <table class="content table-2" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="header td-2">
                        <a href="<?= base_url('/') ?>" class="href">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="body td-3" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body table-3" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell td-4">
                                    <h1 class="h1">
                                        Halo <?= $receiver['name'] ?> !
                                    </h1>
                                    <p class="p">
                                        Silahkan untuk mengklik Tombol "Ubah Password" dibawah ini, untuk mengaktifkan akun Anda.
                                    </p>
                                    <table class="action table-4" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td align="center td-5">
                                                <table class="table-5" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tr>
                                                        <td class="td-6" align="center">
                                                            <table class="table-5" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                <tr>
                                                                    <td>
                                                                        <a href="<?= $content['url'] ?>" class="button button-primary" target="_blank" style="
                                                                                    box-sizing: border-box;
                                                                                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji',
                                                                                        'Segoe UI Symbol';
                                                                                    position: relative;
                                                                                    -webkit-text-size-adjust: none;
                                                                                    border-radius: 4px;
                                                                                    color: #fff;
                                                                                    display: inline-block;
                                                                                    overflow: hidden;
                                                                                    text-decoration: none;
                                                                                    background-color: #2d3748;
                                                                                    border-bottom: 8px solid #2d3748;
                                                                                    border-left: 18px solid #2d3748;
                                                                                    border-right: 18px solid #2d3748;
                                                                                    border-top: 8px solid #2d3748;
                                                                                ">
                                                                            Ubah Password
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="subcopy table-7" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="td-6">
                                                <p class="p" style="font-size: 14px;">
                                                Jika Anda mengalami masalah saat mengklik tombol "Ubah Password", salin dan tempel URL di bawah ini ke browser web Anda:
                                                    <span>
                                                        <a href="<?= $content['url'] ?>" style="color: #3869d4;">
                                                            <?= $content['url'] ?>
                                                        </a>
                                                    </span>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell td-7" align="center">
                                    <p class="p-2">
                                        © <?= date('Y') ?> JHON DELTON.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?= $this->endSection() ?>