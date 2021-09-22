<?= $this->extend('layout/user_layout') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-lg-8">
                    <h1 class="m-0"> with Majoo </h1>
                </div><!-- /.col -->
                <div class="col-lg-4">
                    <form class="form-inline">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show me</label>
                        <select class="form-control select2" id="category" style="min-width:200px;">
                            <option value="category-0">ALL ITEMS</option>
                            <?php foreach($category as $categories): ?>
                                <option value="category-<?= $categories['id']?>"><?= $categories['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row mt-5" id="product">
                <?php foreach($product as $products): ?>
                    <div class="col-md-3 category category-<?= $products['category_id']?>">
                        <div class="card elevation-1 majoo-bg"> 
                        <div class="card-header text-center">
                            <img src="<?= base_url().'/uploads/products/img/'.$products['image'];?>" class="card-img-top img-responsive" style="max-height:8em !important;width:auto !important">
                        </div>    
                            <div class="card-body pt-0 px-0 row-eq-height">
                                <div class="mb-0 px-3 mt-3 text-center" style="min-height:3em;max-height:5em">
                                    <h6 class="text-center"><?= $products['name']?></h6>
                                </div>
                                <hr class="mt-2 mx-3">
                                <div class="px-3 pb-2"">
                                    <h5 class="text-center"><sup class="text-muted small">Rp.</sup> <bold><?= number_format($products['price'],0,',','.')?></bold></h5>
                                </div>
                                <div class="p-3">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex flex-column ml-1 text-muted" style="min-height:13em;max-height:20em">
                                                <?= $products['description']?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-5 mt-3 mb-2">
                                    <button type="button" class="w-100 text-center btn bg-teal elevation-1 btn-block rounded-full" onclick="maintenance();">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <div class="content">
        <div class="container">
            <div class="row mt-5 pb-5">
                <div class="col-12">
                    <p class="text-center text-bold">
                    *Seluruh harga perangkat belum termasuk ongkos kirim, dan harus disertai berlangganan aplikasi wirausaha majoo. Harga bisa berubah sewaktu-waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>