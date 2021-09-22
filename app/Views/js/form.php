<script
    src="https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/js/bootstrap-datetimepicker.min.js"
    integrity="sha512-4lTnmq2kNbykTiOPulgEvxRgqegB5/YMhMqaBWvxji/9wRgR9W/TSGF51/mIG1hQ6janxTojpr41y5/gaW9LRA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.full.min.js"
    integrity="sha512-pR0V9qBlotAMIH3xO3alWMVQbC5hd24itpzUYRZ6EU7Qb1cjhjDN4SAtMNrrAvWy83H3zK46lJXu/PulhrIAQA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"
    integrity="sha512-J+763o/bd3r9iW+gFEqTaeyi+uAphmzkE/zU8FxY6iAvD3nQKXa+ZAWkBI9QS9QkYEKddQoiy0I5GDxKf/ORBA=="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>

<script>
    $(document).ready(function () {
        $('input[required]').parent().find('label').append('<b class="text-danger">*</b>');
        $('select[required]').parent().find('label').append('<b class="text-danger">*</b>');
        $('textarea[required]').parents('.form-group').find('label').append('<b class="text-danger">*</b>');
        $("select[readonly]").css("pointer-events", "none");
        $("input[readonly]").css("pointer-events", "none");
        $("textarea[readonly]").css("pointer-events", "none");
    })
    $('#summernote').summernote({
        toolbar:[            
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('select').select2({
        theme: 'bootstrap4'
    });
    $(".date").datetimepicker();
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>