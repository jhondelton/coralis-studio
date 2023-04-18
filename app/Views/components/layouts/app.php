
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>JHON DELTON</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="<?= base_url('assets/libs/dropify/dropify.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css"  id="app-stylesheet" />
    <style>
        .hidden {
            display: none!important
        }
    </style>
</head>
<body data-layout="horizontal">
    <div id="wrapper">
        <header id="topnav">
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>
                        <?php if (session()->has('user')) { ?>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url('uploads/'.user('avatar')) ?>" alt="user-image" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome <?= user('name') ?>!</h6>
                                </div>
                                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout-variant"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="logo-box">
                        <a href="javascript:;" class="logo text-center logo-light">
                            <span class="logo-lg">
                                <span class="logo-lg-text-light">JHON DELTON</span>
                            </span>
                            <span class="logo-sm">
                                <span class="logo-sm-text-dark">JHON DELTON</span>
                            </span>
                        </a>
                        <a href="javascript:;" class="logo text-center logo-dark">
                            <span class="logo-lg">
                                <span class="logo-lg-text-dark">JHON DELTON</span>
                            </span>
                            <span class="logo-sm">
                                <span class="logo-lg-text-dark">JHON DELTON</span>
                            </span>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <ul class="navigation-menu">
                            <?= $this->include('components/layouts/menu-list') ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?= $this->renderSection('page-name') ?></h4>
                            </div>
                        </div>
                    </div>     
                    <div class="row hidden" id="alert">
                        <div class="col-lg-12" id="alert-size">
                            <div class="alert alert-success alert-dismissible show fade text-dark" role="alert" id="alert-type">
                                <div class="alert-body" id="alert-body"></div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2023 &copy; JHON DELTON
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="rightbar-overlay"></div>
    <script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/dropify/dropify.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $(".dropify").dropify({
                messages:{
                    default:"Seret atau jatuhkan file disini atau klik",
                    replace:"Seret atau jatuhkan atau klik untuk menggantikn",
                    remove:  'Hapus',
                    error:"Ooops, terjadi kesalahan."
                },
                error:{
                    fileSize:"Ukuran File terlalu besar (Maksimal 10MB)."
                }
            })
	});
        $("#input_form").on('submit', function(element) {
            element.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#preloader').fadeIn("slow");
                    $('button:submit').attr('disabled', 'true');
                    $('button:submit').text('');
                    $('button:submit').append('Mohon tunggu...');
                    $(document).find('input, select').removeClass('is-invalid');
                    $(document).find('small').removeClass('text-danger').text('');
                },
                success: function(response) {
                    $('#preloader').fadeOut("slow");
                    $('button:submit').removeAttr('disabled');
                    $('button:submit').text('Submit');
                    if (response.status == false) {
                        if (response.type == 'validation') {
                            $.each(response.message, function(key, value) {
                                $('input#'+key+', select#'+key+'').addClass('is-invalid');
                                $('small#'+key+'').addClass('text-danger').html(value);
                            });
                            showAlert('sweetalert', 'danger', 'Periksa Input', 3000, 'col-lg-12');
                        } 
                        if (response.type == 'alert') {
                            showAlert(
                                'sweetalert',
                                response.hasOwnProperty('alert') ? response.alert : 'danger', 
                                response.message, 
                                response.hasOwnProperty('timeout') ? response.timeout : 5000, 
                                response.hasOwnProperty('size') ? response.size : 'col-lg-12'
                            );
                        }
                    } else {
                        showAlert(
                            response.type, 
                            'success', 
                            response.message, 
                            response.hasOwnProperty('timeout') ? response.timeout : 5000, 
                            'col-lg-12', 
                            response.hasOwnProperty('redirect') ? response.redirect : ''
                        );
                    }
                },
                error: function() {
                    $('#preloader').fadeOut("slow");
                    $('button:submit').removeAttr('disabled');
                    $('button:submit').text('Submit');
                    showAlert(
                        'sweetalert',
                        'danger', 
                        'Terjadi kesalahan.', 
                        5000, 
                        'col-lg-12'
                    );
                },
            });
        });
        function showAlert(type = 'normal', alert = 'danger', message = 'Halo!', timeOut = 10000, size = 'col-lg-12', redirect = '') {
            if (type == 'sweetalert') {
                var title, icon;
                if (alert == 'danger') {
                    var title = 'Gagal',
                        icon  = 'error';
                } else if (alert == 'success') {
                    var title = 'Berhasil',
                        icon  = 'success';
                } else if (alert == 'info') {
                    var title = 'Informasi',
                        icon  = 'info';
                } else if (alert == 'primary') {
                    var title = 'Informasi',
                        icon  = 'info';
                } else if (alert == 'secondary') {
                    var title = 'Informasi',
                        icon  = 'secondary';
                } else if (alert == 'dark') {
                    var title = 'Informasi',
                        icon  = 'dark';
                }
                swal.fire(title, message, icon);
            } else {
                if (alert == 'danger') {
                    message = '<b><i class="mdi mdi-close-circle"></i> Informasi:</b> '+message;
                } else if (alert == 'success') {
                    message = '<b><i class="mdi mdi-check-circle"></i> Informasi:</b> '+message;
                } else if (alert == 'info') {
                    message = '<b><i class="mdi mdi-information"></i> Informasi:</b> '+message;
                } else if (alert == 'primary') {
                    message = '<b><i class="mdi mdi-information"></i> Informasi:</b> '+message;
                } else if (alert == 'secondary') {
                    message = '<b><i class="mdi mdi-information"></i> Informasi:</b> '+message;
                } else if (alert == 'dark') {
                    message = '<b><i class="mdi mdi-information"></i> Informasi:</b> '+message;
                }
                $('html,body').animate({
                    scrollTop: $('#alert').offset().top
                }, 'slow');
                $('#alert').removeClass('hidden'); 
                $('#alert-body').html(message);
                document.getElementById('alert-size').className = size;
                document.getElementById('alert-type').className = 'text-white alert-dismissible show fade alert alert-'+ alert +' bg-'+ alert +' border-'+ alert;
                setTimeout(() => {
                    $('#alert').addClass('hidden');
                    if (redirect !== '') {
                        window.location = redirect;
                    }
                }, timeOut);
            }
        }
    </script>
    <?php if (session()->has('alert')) { ?>
    <script>
        var type = '<?= session()->getFlashdata('alert')['type'] ?? "normal" ?>';
        var alert = '<?= session()->getFlashdata('alert')['alert'] ?? "danger" ?>';
        var message = '<?= session()->getFlashdata('alert')['message'] ?? "Halo!" ?>';
        var timeOut = '<?= session()->getFlashdata('alert')['timeout'] ?? 5000 ?>';
        var size = '<?= session()->getFlashdata('alert')['size'] ?? "col-lg-12" ?>';
        showAlert(type, alert, message, timeOut, size);
    </script>
    <?php } ?>
</body>
</html>