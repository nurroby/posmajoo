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
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name');?>" required>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Category</label>
                                    <select class="form-control select2" id="category_id" name="category_id" value="<?= set_value('category_id');?>" required>
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Price</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?= set_value('price');?>" required>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" name="description" required><?= set_value('description');?></textarea>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="fileUpload" name="image" onchange="uploadFile();" accept="image/*" required>
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
    
    $('#category_id').select2({
            minimumInputLength: 3,
            language: {
                inputTooShort: (arg) => `Masukkan ${arg.minimum - arg.input.length} karakter. Gunakan kata kunci yang detail.`
            },
            ajax: {
                url: '<?= base_url(); ?>/api/category',
                dataType: "json",
                crossDomain: true,
                delay: 150,
                data: function(params) {
                    return {
                        search: params.term.toUpperCase()
                    };
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
                processResults: function(data) {
                    let myResults;
                    myResults = [];
                    if(data.data.length > 0) {
                        $.each(data.data, function(index, item) {
                            myResults.push({
                                id: item.id,
                                text: item.name.toUpperCase()
                            });
                        });
                    }
                    return {
                        results: myResults
                    };
                },
                transport: function(params, success, failure) {
                    var $request = $.ajax(params)

                    $request
                        .done((data) => {
                            success(data)
                        })
                        .fail((err) => {
                            success({
                                data: []
                            })
                        })
                },
                cache: false
            }
        });
</script>
<?= $this->endSection() ?>