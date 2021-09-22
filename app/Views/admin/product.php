<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <h5><i class="fas fa-tag"></i> Page <?= $page_title ?></h5>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row" id="product-tab" style="display:flex?>">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools d-flex justify-content-end">
                            <a href="<?= base_url() ?>/admin/product/add" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Add <?= $page_title ?>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped fancyTable" id="tb-product">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
    $(document).ready(function () {

        let exportOptionsBrand = {
            exportOptions: {
                columns: [0, 1]
            }
        };
        
        var tableBundle = $('#tb-product').DataTable({
            "dom": '<"row"<"col-sm-12"B><"pb-5">><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                $.extend(true, {}, exportOptionsBrand, {
                    extend: 'print',
                    text: 'Print <i class="fas fa-print"></i>',
                    className: 'btn btn-sm btn-primary',
                    collectionLayout: 'fixed two-column',
                }),
                $.extend(true, {}, exportOptionsBrand, {
                    extend: 'excelHtml5',
                    text: 'Xlsx <i class="fas fa-file-spreadsheet"></i>',
                    className: 'btn btn-sm btn-success',
                    collectionLayout: 'fixed two-column',
                }),
                $.extend(true, {}, exportOptionsBrand, {
                    extend: 'pdfHtml5',
                    text: 'Pdf <i class="fas fa-file-pdf"></i>',
                    className: 'btn btn-sm btn-danger',
                    collectionLayout: 'fixed two-column',
                }),
                $.extend(true, {}, exportOptionsBrand, {
                    extend: 'csvHtml5',
                    text: 'Csv <i class="fas fa-file-csv"></i>',
                    className: 'btn btn-sm bg-teal',
                    collectionLayout: 'fixed two-column',
                })
            ],
            "ajax": {
                url: "<?= base_url()?>/api/product",
                dataSrc: function (data) {
                    data.draw = data.Product.draw
                    data.recordsTotal = data.Product.recordsTotal
                    data.recordsFiltered = data.Product.recordsFiltered
                    return data.Product.data
                },
                "cache": "true"
            },
            "columns": [
                {
                    "data": "name",
                    "orderable": true,
                },
                {
                    "data": "category",
                    "orderable": true,
                },
                {
                    "data": "price",
                    "orderable": true,
                },
                {
                    "data": 'id',
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-content-start">
                        <button class="btn btn-sm btn-secondary mx-1" data-toggle="tooltip" onclick="window.location.href = '<?= base_url('admin/product/edit/') ?>/${data}'" title="Edit"><i class="fas fa-edit"></i></button>&nbsp
                        <button class="btn btn-sm btn-danger btn-delete mx-1" data-toggle="tooltip" data-tab="bundle" data-id="${data}" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                        `
                    },
                    "orderable": false,
                }
            ],
            "order": [1, 'DESC'],
            "lengthMenu": [
                [10, 25, 50, 100, 250, 500, 1000, -1],
                [10, 25, 50, 100, 250, 500, 1000, "All"]
            ],
            serverSide: true,
        }).on('draw', function (e, sett) {
            if (sett._iDisplayLength !== -1 && sett._iDisplayLength < sett._iRecordsTotal) {
                $('#tb-product_wrapper div.dt-buttons button').attr('disabled', true)
                $('#tb-product_wrapper div.dt-buttons button').attr('title',
                    "Ubah pilihan show jadi 'All' atau sama/melebihi jumlah data untuk melakukan aksi"
                    )
            } else if (sett._iDisplayLength === -1 || sett._iDisplayLength >= sett._iRecordsTotal) {
                $('#tb-product_wrapper div.dt-buttons button').attr('disabled', false)
                $('#tb-product_wrapper div.dt-buttons button').attr('title', '')
            }
        })

        $('#tb-product_wrapper div.dt-buttons button').attr('disabled', true)

        $(document).on('click', '.btn-delete', function () {
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                text: "It will be deleted permanently!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: '<?= base_url('admin/product/delete')?>/' + id,
                                type: 'GET',
                            })
                            .done(function(response) {
                                Swal.fire('Deleted!', 'Your file has been deleted.', 'success')
                                tableBundle.ajax.reload();
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                            });
                    });
                },
            })
        })    
    })
</script>
<?= $this->endSection() ?>