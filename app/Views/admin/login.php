<?= view('css/base_admin') ?>
<body class="majoo-bg">
    <!-- Content Wrapper. Contains page content -->
    <div class="majoo-bg">
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
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <input type="username" class="form-control" name="username" value="<?= set_value('username');?>" placeholder="username" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" value="<?= set_value('password');?>" placeholder="Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary btn-block rounded-full">Sign In</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.login-box -->
            </div>
        </div>
    </div>
<?= view('js/base_admin') ?>
</body>