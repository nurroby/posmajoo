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
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Name</label>
                                    <input type="text" id="name" class="form-control" name="name" value="<?= $val['name'];?>">
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Category</label>
                                    <input type="text" id="category_id" class="form-control" name="category_id" value="<?= set_value('category_id');?>" required>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Price</label>
                                    <input type="text" id="price" class="form-control" name="price" value="<?= $val['price'];?>">
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" name="description"><?= $val['description'];?></textarea>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="fileUpload" name="image" onchange="uploadFile();" accept="image/*">
                                    <div class="mt-2 progress">
                                        <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <img src="" alt="Image preview" id="preview-image" class="d-none img-thumbnail">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 col-xs-12 text-left">
                                    <button class="btn btn-default" onclick="window.location.href = '<?= base_url('admin/category') ?>'; return fasse;"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                                </div>
                                <div class="col-md-6 col-xs-12 text-right">
                                    <button id="submit" class="btn btn-success btn-disabled" type="submit" disabled><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
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
<script> 

    function uploadFile() {
        document.getElementById('progressBar').value = 0;
        var file = document.getElementById("fileUpload").files[0];
        // alert(file.name+" | "+file.size+" | "+file.type);
        var formdata = new FormData();
        formdata.append("fileUpload", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.open("POST",'test.php');
        ajax.send(formdata);
    }

    function progressHandler(event) {
        var percent = (event.loaded / event.total) * 100;
        document.getElementById('progressBar').style.width = Math.round(percent).toString() + "%";
        document.getElementById('progressBar').innerText = Math.round(percent).toString() + "%";
    }
    function completeHandler(event) {
        var output = document.getElementById('preview-image');
            output.classList.remove("d-none");  
            output.src = URL.createObjectURL(document.getElementById("fileUpload").files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
    }
    $("#name").keyup(function() {
        let check = $(this).val() == $(this).data().initial;
        if(!check){ 
            $("#submit").removeAttr('disabled');
        }else{
            $("#submit").attr('disabled');
        }
    });
</script>
<?= $this->endSection() ?>