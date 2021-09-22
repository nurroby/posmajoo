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
                                    <input type="text" id="name" class="form-control" name="name" value="<?= $val['name'];?>">
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label>Category</label>
                                    <select class="form-control select2" id="category_id" name="category_id"></select>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
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
                                    <img src="<?= base_url('uploads/products/img/'.$val['image']);?>" alt="Image preview" id="preview-image" class="img-thumbnail">
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

    
    function template(data) {
        if ($(data.html).length === 0) {
            return data.text;
        }
        return data.html;
    }
$(document).ready(function () {
    $("#category_id").select2({
        theme:'bootstrap4',
        ajax: {
            url: '<?= base_url(); ?>/api/category',
            dataType: 'json',
            type: 'GET',
            processResults: function(data) {
                let myResults = [];
                if(data.category.length > 0) {
                    let selects = '<?= $val['category_id']?>';
                    $.each(data.category, function(index, item) {
                        myResults.push({
                            id: item.id,
                            text: item.name.toUpperCase(),
                            selected: (item.id === selects),
                        });
                        console.log(item.id,selects)
                        console.log(typeof item.id)
                        console.log(typeof selects)
                        console.table('myResults',myResults)
                    });
                }
                return {
                    results: myResults
                };
            },
            cache: true
        },
        allowClear: true,
        templateResult: template,
        templateSelection: template
    }); 
    var categorySelected = $('#category_id');
    $.ajax({
        type: 'GET',
        url: '<?= base_url(); ?>/api/category'
    }).then(function (data) {
        let selects = '<?= $val['category_id']?>';
        console.log('select = '+selects + ' type '+ typeof selects )
        $.each(data.category, function(index, item) {
                console.log('data',data.category[index])
                console.log('item-name = '+item.name+' type '+typeof item.name)
                console.log('item-id = '+item.id+' type '+typeof item.id)
            if(selects===item.id)
                categorySelected.append(new Option(data.category[index].name,data.category[index].id,true,true)).trigger('change');
        });      

        // manually trigger the `select2:select` event
        categorySelected.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });

    $(':input[type="submit"]').prop('disabled', true);
    $('input[type="text"]').keyup(function() {
        if($(this).val() !== $(this).data().initial) {
        $(':input[type="submit"]').prop('disabled', false);
        }
    });
    categorySelected.on('select2:selecting',function() {
        if($(this).val() !== $(this).data().initial) {
        $(':input[type="submit"]').prop('disabled', false);
        }
    });
    $('.note-editable').keyup(function() {
        if($(this).val() !== $(this).data().initial) {
        $(':input[type="submit"]').prop('disabled', false);
        }
    });
    $('input[type="file"]').change(function() {
        if($(this).val() !== $(this).data().initial) {
        $(':input[type="submit"]').prop('disabled', false);
        }
    });
    
});
</script>
<?= $this->endSection() ?>