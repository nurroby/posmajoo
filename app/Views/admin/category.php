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
        <div class="row" id="category-tab" style="display:flex?>">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools d-flex justify-content-end">
                            <a href="<?= base_url() ?>/admin/category/add" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Add <?= $page_title ?>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped fancyTable" id="tb-category">
                            <thead>
                                <tr>
                                    <th>Name</th>
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


<div class="modal fade" id="modal-danger">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light bg-danger swalDefaultSuccess" id="proceed-delete"
                    data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-outline-light bg-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-revive">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light bg-danger swalDefaultSuccess" id="proceed-revive"
                    data-dismiss="modal">Modify</button>
                <button type="button" class="btn btn-outline-light bg-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function () {

        let exportOptionsBrand = {
            exportOptions: {
                columns: [0, 1]
            }
        };
        
        var tableBundle = $('#tb-category').DataTable({
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
                url: "<?= base_url()?>/api/category",
                dataSrc: function (data) {
                    data.draw = data.Category.draw
                    data.recordsTotal = data.Category.recordsTotal
                    data.recordsFiltered = data.Category.recordsFiltered
                    return data.Category.data
                },
                "cache": "true"
            },
            "columns": [
                {
                    "data": "name",
                    "orderable": true,
                },
                {
                    "data": 'id',
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-content-start">
                        <button class="btn btn-sm btn-secondary mx-1" data-toggle="tooltip" onclick="window.location.href = '<?= base_url('admin/category/edit/') ?>/${data}'" title="Edit"><i class="fas fa-edit"></i></button>&nbsp
                        <button class="btn btn-sm btn-danger btn-delete mx-1" data-toggle="tooltip" data-tab="bundle" data-id="${data}" title="Hapus"><i class="fas fa-trash"></i></button>
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
                $('#tb-category_wrapper div.dt-buttons button').attr('disabled', true)
                $('#tb-category_wrapper div.dt-buttons button').attr('title',
                    "Ubah pilihan show jadi 'All' atau sama/melebihi jumlah data untuk melakukan aksi"
                    )
            } else if (sett._iDisplayLength === -1 || sett._iDisplayLength >= sett._iRecordsTotal) {
                $('#tb-category_wrapper div.dt-buttons button').attr('disabled', false)
                $('#tb-category_wrapper div.dt-buttons button').attr('title', '')
            }
        })

        $('#tb-category_wrapper div.dt-buttons button').attr('disabled', true)

        $(document).on('click', '.btn-delete', function () {
            $('#modal-danger').modal('show')
            $('#modal-danger #proceed-delete').attr('data-id', $(this).attr('data-id'))
            $('#modal-danger #proceed-delete').attr('data-tab', $(this).attr('data-tab'))
            let title = 'Kategori'
            $('#modal-danger .modal-title').text('Confirmation deleting ' + title)
            $('#modal-danger .modal-body p').text('Are you sure deleting ' + title.toLowerCase() +
                ' ini?')
        })


        $(document).on('click', '.btn-reverse-delete', function () {
            $('#modal-revive').modal('show')
            $('#modal-revive #proceed-revive').attr('data-id', $(this).attr('data-id'))
            $('#modal-revive #proceed-revive').attr('data-status', $(this).attr('data-status'))
            $('#modal-revive #proceed-revive').attr('data-tab', $(this).attr('data-tab'))
            let title = 'Kategori'
            $('#modal-revive .modal-title').text('Confirmation reverse ' + title)
            $('#modal-revive .modal-body p').text('Are you sure reverse ' + title
            .toLowerCase() + ' ini?')
        })

        $('#modal-orders').on('hide.bs.modal', function () {
            $('#modal-orders table tbody').empty()
            $('#modal-orders .widget-user-header').empty()
        })
    })
</script>
<?= $this->endSection() ?>