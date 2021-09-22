<?= $this->extend('layout/user_layout') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper majoo-bg">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid d-flex justify-content-center">
                <!-- login-box -->
                <div class="login-box">
                    <!-- /.login-logo -->
                    <div class="card card-outline card-success">
                        <div class="card-header text-center">
                            <img src="https://majoo.id/assets/img/main-logo.png" alt="">
                        </div>
                        <div class="card-body">
                            <p class="login-box-msg">Sign in to start your session</p>

                            <form action="../../index3.html" method="post">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary btn-block rounded-full"  onclick="maintenance();">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <hr>
                            <p class="mb-0 text-center">
                                <a href="<?= base_url()?>/register" class="text-default">I don't have account</a>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.login-box -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>