<?= $this->extend('layout/user_layout') ?>
<?= $this->section('content') ?>
<!-- register-box -->

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
            <!-- register-box -->
            <div class="register-box">
                <div class="card card-outline card-success">
                    <div class="card-header text-center">
                        <img src="https://majoo.id/assets/img/main-logo.png" alt="">
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Register a new membership</p>

                        <form action="../../index.html" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Full name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="phone" class="form-control" placeholder="Phone">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-mobile"></span>
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
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Retype password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                        <label for="agreeTerms">
                                            I agree to the <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="button"
                                        class="btn btn-primary btn-block rounded-full" onclick="maintenance();">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <a href="<?= base_url()?>/login" class="text-center">I already have a membership</a>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>