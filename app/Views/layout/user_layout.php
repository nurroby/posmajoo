<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majoo | <?= (($page_title) ?? 'Ayoo Majoo' ) ?></title>

    <link rel="shortcut icon" href="https://majoo.id/favicon.png" />
    <?= view('css/base_user'); ?>
    <style>
        .majoo-bg {
            background-image: linear-gradient(135deg, #e8f1c2, #b6e4e1);
        }
        .rounded-full{border-radius:50em;}
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-light">
            <div class="container">

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url();?>/home" class="nav-link">Majoo Teknologi Indonesia</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a href="<?= base_url();?>/login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url();?>/register" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-md btn-warning pulse mr-4" style="border-radius:50em"
                            onclick="maintenance();" href="#" role="button">
                            <span class="badge badge-danger">3</span>
                            <i class="fas fa-shopping-cart mr-2"></i> cart
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <?= $this->renderSection('content') ?>

        <!-- Main Footer -->
        <footer class="main-footer text-center majoo-bg">
            <!-- Default to the left -->
            <strong"> 2019 &copy; PT Majoo Teknologi Indonesia.</strong>
        </footer>
        <!-- Main Footer -->

        <?= view('js/base_user'); ?>
    </div>
</body>

</html>