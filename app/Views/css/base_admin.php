<!-- Fontawesome 5.15 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css"
    integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" crossorigin="anonymous">
<!-- Admin-LTE 3.1.0 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.css"
    integrity="sha256-qWC6Hjoa6pZLtNjUZQZbtxD8iGPYJc5J6nu5wN3keSU=" crossorigin="anonymous">
<?php 
    if($page_type=="list") { print_r(view('css/datatable')); }
    if($page_type=="form"){ print_r(view('css/form')); }
?>
<!-- jQuery 3.4.1-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ=="
    crossorigin="anonymous"></script>

<style>
    .majoo-bg {
        background-image: linear-gradient(135deg, #e8f1c2, #b6e4e1);
    }

    .rounded-full {
        border-radius: 50em;
    }

    [class*="sidebar-light-"] .nav-sidebar>.nav-item.menu-open>.nav-link,
    [class*="sidebar-light-"] .nav-sidebar>.nav-item:hover>.nav-link {
        transition: ease-in .33s ease;
    }
</style>