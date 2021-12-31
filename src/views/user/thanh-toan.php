<?php
include ROOT_DIR . '/src/views/user/head.php';
?>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">Brand</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="catalog-page.html">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="shopping-cart.html">Shopping Cart</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Payment</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                        mattis vitae leo.</p>
                </div>
                <form method="get" action="<?php echo BASE_URL . '/check-out/' ?>">
                    <div class="products">
                        <h3 class="title">Checkout</h3>
                        <?php
                        foreach ($products as $product) {
                        ?>
                            <div class="item"><span class="price"><?php echo number_format($product['product_price'] * (100 - $product['product_sale']) / 100, 0, '', ','); ?>đ</span>
                                <p class="item-name"><?php echo $product['product_title'] ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="total"><span>Total</span><span class="price"><?php echo number_format($total, 0, '', ',') ?>đ</span></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <input type="text" class="form-control" name="customer">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            </div>
        </section>
    </main>
</body>

<?php
include ROOT_DIR . '/src/views/user/foot.php';
?>