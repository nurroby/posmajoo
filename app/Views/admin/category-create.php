<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <?= $page_title;?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('api/category/processAdd') ?>">
                            <div class="row">
                                <div class="form-group col-md-8 col-xs-12">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" required>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 col-xs-12 text-left">
                                    <button class="btn btn-default" onclick="window.location.href = '<?= base_url('admin/category') ?>'; return fasse;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                                </div>
                                <div class="col-md-6 col-xs-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>