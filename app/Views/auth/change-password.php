<?= $this->extend('components/layouts/app') ?>
<?= $this->section('page-name') ?>
    Ubah Password
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title m-0 text-white">Ubah Password</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <form method="post" action="<?= current_url() ?>" id="input_form">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label class="form-label">Password Baru <text class="text-danger">*</text></label>
                            <input class="form-control" type="password" name="new_password" id="new_password">
                            <small id="new_password"></small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru <text class="text-danger">*</text></label>
                            <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password">
                            <small id="confirm_new_password"></small>
                        </div>
                        <div class="button-items d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn btn-block waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title m-0 text-white">Tentang Saya</h3>
            </div>
            <div class="card-body">
                <ul>
                    <li>Email: delton018@gmail.com </li>
                    <li>Whatsapp: +6281292958103</li>
                    <li>Handphone: +6281292958103</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>