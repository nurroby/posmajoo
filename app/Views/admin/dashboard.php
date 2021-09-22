<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange elevation-2">
                        <div class="inner">
                            <h3><?= $count['order']?></h3><p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <a href="#" class="small-box-footer" onclick="maintenance();"><i class="fas fa-plus-circle"></i> Add More</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon elevation-2">
                        <div class="inner">
                            <h3><?= $count['user']?></h3><p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer" onclick="maintenance();"><i class="fas fa-plus-circle"></i> Add More</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-indigo elevation-2">
                        <div class="inner">
                            <h3><?= $count['product']?></h3><p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="<?= base_url()?>/admin/product/add" class="small-box-footer"><i class="fas fa-plus-circle"></i> Add More</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-lightblue elevation-2">
                        <div class="inner">
                            <h3><?= $count['category']?></h3><p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <a href="<?= base_url()?>/admin/category/add" class="small-box-footer"><i class="fas fa-plus-circle"></i> Add More</a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Orders</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($latest['order'] as $order):?>
                                        <tr>
                                            <td><a href="#" onclick="maintenance()"><?= $order['order_id']?></a></td>
                                            <td><a href="#" onclick="maintenance()"><?= $order['user_id']?></a></td>
                                            <td><?= $order['total_price']?></td>
                                            <td><span class="badge badge-success"><?= $order['status']?></span></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="#" class="btn btn-sm btn-info float-left" onclick="maintenance()">Place New Order</a>
                            <a href="#" class="btn btn-sm btn-secondary float-right" onclick="maintenance()">View All Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Products</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <?php foreach($latest['product'] as $product):?>
                                <li class="item">
                                    <div class="product-img">
                                        <img src="<?= base_url('uploads/products/thumb/'.$product['image']) ?>" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-title" onclick="maintenance()"><?= $product['name']?>
                                            <span class="badge badge-warning float-right">Rp. <?= number_format($product['price'],0,',','.')?></span></a>
                                        <span class="product-description">
                                            <?= $product['description']?>
                                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?= base_url('/admin/product')?>" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


<?= $this->endSection() ?>