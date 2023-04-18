<?= $this->extend('components/layouts/app') ?>
<?= $this->section('page-name') ?>
    Dasbor
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <img src="<?= base_url('uploads/'.user('avatar')) ?>" class="avatar-md rounded-circle mr-3 align-self-center" alt="user">
                    <div class="media-body">
                        <h5 class="font-14 mt-0 mb-1"><?= user('name') ?></h5>
                        <p class="mb-1 font-13"><?= user('email') ?></p>
                        <small class="text-primary"><b>User</b></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title m-0 text-white">Ubah Avatar</h3>
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('update-avatar') ?>" id="input_form" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="file" name="avatar" class="dropify" data-default-file="<?= base_url('uploads/'.user('avatar')) ?>"  />
                    <small id="avatar"></small>
                    <div class="button-items d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn btn-block waves-effect waves-light">Submit</button>
                    </div>
                </form>
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