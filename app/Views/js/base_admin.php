<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- Bootstrap 4.3.1 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php 
    if($page_type==='list') {
        print_r(view('js/datatable'));
    }
    if($page_type==='form'){
        print_r(view('js/form'));
    }
?>
<!-- Admin-LTE 3.1 -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js" integrity="sha256-dVs7YxkIJMdWKIx+E4Z7KGIrsH2P7MHj4WDNvzTzsQU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.3/dist/sweetalert2.all.min.js" integrity="sha256-dJtc/tC56+CUFep+WX+wmcSWBPPjSqOSH3Ft+N8YXyc=" crossorigin="anonymous"></script>
<script type="text/javascript">

  <?php $error = $_SESSION['errors'] ?? null; if ($error): ?>
      const Toast = Swal.mixin({
        toast: true, position: 'top-end', showConfirmButton: false, timer: 5000
      });
      Toast.fire({ type: 'error', title: '<?= $error; ?>' })
  <?php endif; ?>    
    function maintenance()
    {
        swal.fire({ 
            title: 'Fitur dalam perbaikan', text: 'Akan segera jadi kok, ditunggu ya.', type: 'warning',
        });
    }
</script>