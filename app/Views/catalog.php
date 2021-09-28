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
                <div class="col-md-3 product category category-<?= $products['category_id']?>"
                    id="product-<?= $products['id']?>">
                    <div class="card elevation-1 majoo-bg">
                        <div class="card-header text-center">
                            <img src="<?= base_url().'/uploads/products/img/'.$products['image'];?>"
                                class="card-img-top img-responsive"
                                style="max-height:8em !important;width:auto !important">
                        </div>
                        <div class="card-body pt-0 px-0 row-eq-height">
                            <div class="mb-0 px-3 mt-3 text-center product-name" style="min-height:3em;max-height:5em">
                                <h6 class="text-center"><?= $products['name']?></h6>
                            </div>
                            <hr class="mt-2 mx-3">
                            <div class="px-3 pb-2 product-price" data-value="<?= $products['price'] ?>">
                                <h5 class="text-center"><sup class="text-muted small">Rp.</sup>
                                    <bold><?= number_format($products['price'],0,',','.')?></bold>
                                </h5>
                            </div>
                            <div class="p-3">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <div class="d-flex flex-column ml-1 text-muted"
                                            style="min-height:13em;max-height:20em">
                                            <?= $products['description']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-5 mt-3 mb-2">
                                <button type="button"
                                    class="w-100 text-center btn bg-teal elevation-1 btn-block rounded-pill add-cart">Order</button>
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
                        *Seluruh harga perangkat belum termasuk ongkos kirim, dan harus disertai berlangganan aplikasi
                        wirausaha majoo. Harga bisa berubah sewaktu-waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

    $(function () {

        $('.dropdown-toggle').on('click', function (event) {
            $('.dropdown-menu').slideToggle();
            event.stopPropagation();
        });

        $('.dropdown-menu').on('click', function (event) {
            event.stopPropagation();
        });

        $(window).on('click', function () {
            $('.dropdown-menu').slideUp();
        });

    });

    var shoppingCart = (function () {
        cart = [];

        function Item(id, name, price, image, count) {
            this.id = id;
            this.name = name;
            this.price = price;
            this.image = image;
            this.count = count;
        }

        function saveCart() {
            localStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        function loadCart() {
            cart = JSON.parse(localStorage.getItem('shoppingCart'));
        }

        if (localStorage.getItem("shoppingCart") != null) loadCart();

        var obj = {};

        obj.addItemToCart = function (id, name, price, image, count) {
            for (var item in cart) {
                if (cart[item].id === id) {
                    cart[item].count++;
                    saveCart();
                    return;
                }
            }
            var item = new Item(id, name, price, image, count);
            cart.push(item);
            saveCart();
        }
        obj.setCountForItem = function (id, count) {
            for (var i in cart) {
                if (cart[i].id === id) {
                    cart[i].count = count;
                    break;
                }
            }
        };
        obj.removeItemFromCart = function (id) {
            for (var item in cart) {
                if (cart[item].id === id) {
                    cart[item].count--;
                    if (cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        }

        // Remove all items from cart
        obj.removeItemFromCartAll = function (id) {
            for (var item in cart) {
                if (cart[item].id === id) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        }
        obj.clearCart = function () {
            cart = [];
            saveCart();
        }
        obj.totalCount = function () {
            var totalCount = 0;
            for (var item in cart) {
                totalCount += cart[item].count;
            }

            return (totalCount!==0) ? totalCount : "No Items"
            // return totalCount;
        }
        obj.totalCart = function () {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += Number(cart[item].price) * cart[item].count;            
            }
            return Number(totalCart.toFixed(2));
        }
        obj.listCart = function () {
            var cartCopy = [];
            for (i in cart) {
                item = cart[i];
                itemCopy = {};
                for (p in item) {
                    itemCopy[p] = item[p];
                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy)
            }
            return cartCopy;
        }
        return obj;
    })();

    // Add item
    $('.add-cart').click(function (event) {
        event.preventDefault();
        let id      = ($(this).parents('.product').attr('id')).split('-').pop()        
        let name    = $(this).parent().siblings('.product-name').find('h6').text()
        let price   = Number($(this).parent().siblings('.product-price').attr('data-value'))
        let image   = $(this).parent().parent().siblings('.card-header').find('img').attr('src')
        shoppingCart.addItemToCart(id, name, price, image, 1);
        displayCart();
    });

    // Clear items
    $('.clear-cart').click(function () {
        shoppingCart.clearCart();
        displayCart();
    });


    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = `<span class="dropdown-header total-count"></span>`;
        for (var i in cartArray) {
            output += `
                <div class="dropdown-divider"></div>
                <div class="dropdown-item">
                    <div class="media">
                        <img src="${cartArray[i].image}" alt="" class="img-size-64 mr-2 img-circle">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-12"><p class="text-xs">${cartArray[i].name}</p></div>
                                <div class="col-12 pt-2"><p class="text-md"><sup>Rp.</sup>${cartArray[i].price.toLocaleString("id-ID")}</p></div>
                                <div class="col-12 pt-2">
                                    <div class="row">
                                        <div class="input-group col-8">
                                            <button class="input-group-addon btn btn-sm minus-item" data-id="${cartArray[i].id}"><i class="fa fa-minus-circle"></i></button>
                                            <input class="form-control form-control-sm form-control-border text-center" type="number" name="" id="" min="1" max="99" value="${cartArray[i].count}">
                                            <button class="input-group-addon btn btn-sm plus-item" data-id="${cartArray[i].id}"><i class="fa fa-plus-circle"></i></button>
                                        </div>
                                        <div class="col-4"><button class="float-right btn btn-xs bg-danger delete-item" data-id="${cartArray[i].id}"><i class="fa fa-trash"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
        }
        
        if(cartArray.length > 0)
            output += `<div class="dropdown-divider"></div>
                <div class="dropdown-item"><div class="media"><div class="media-body text-center"><span class="total-cart"></span></div></div></div>
                <div href="#" class="dropdown-item dropdown-footer majoo-bg pt-2">
                    <a role="button" class="btn btn-sm rounded-pill bg-teal" onclick="maintenance()"> checkout <i class="fas fa-arrow-circle-right"></i></a>
                </div>`;
        $('.show-cart').html(output);
        $('.total-cart').html('Total: Rp. '+shoppingCart.totalCart().toLocaleString("id-ID"));
        if(shoppingCart.totalCount()!=="No Items")
            $('.badge.total-count').removeClass('d-none');   
        $('.total-count').html(shoppingCart.totalCount());
        $('.dropdown-header.total-count').html(shoppingCart.totalCount()+' items on cart');
    }

    // Delete item button

    $('.show-cart').on("click", ".delete-item", function (event) {
        let id = $(this).data('id').toString()
        shoppingCart.removeItemFromCartAll(id);
        displayCart();
    })


    // -1
    $('.show-cart').on("click", ".minus-item", function (event) {
        let id = $(this).data('id').toString()
        shoppingCart.removeItemFromCart(id);
        displayCart();
    })
    // +1
    $('.show-cart').on("click", ".plus-item", function (event) {
        var id = $(this).data('id').toString()
        shoppingCart.addItemToCart(id,null,null,null,null);
        displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function (event) {
        var id = $(this).data('id');
        var count = Number($(this).val());
        shoppingCart.setCountForItem(id, count);
        displayCart();
    });

    displayCart();

</script>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>