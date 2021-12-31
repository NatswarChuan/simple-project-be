<?php
include ROOT_DIR . '/src/views/user/head.php';
?>

<body>
    <?php
    include ROOT_DIR . '/src/views/user/navbar.php';
    ?>
    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Shopping Cart</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                        mattis vitae leo.</p>
                </div>
                <div class="content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">
                                <?php
                                foreach ($products as $product) {
                                ?>
                                    <div class="product">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-3">
                                                <div class="product-image"><img class="img-fluid d-block mx-auto image" src="<?php echo BASE_URL . '/upload/' . explode(',', $product['product_image'])[0] ?>"></div>
                                            </div>
                                            <div class="col-md-3 product-info"><a class="product-name" href="#"><?php echo $product['product_title'] ?></a>

                                            </div>
                                            <div class="col-6 col-md-4 price"><span><?php echo number_format($product['product_price'] * (100 - $product['product_sale']) / 100, 0, '', ','); ?>đ</span></div>
                                            <div class="col-md-1">
                                                <a class="btn btn-danger" href="<?php echo BASE_URL . '/remove-cart-item/' . $product['product_id'] ?>"><span>x</span></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Summary</h3>
                                <h4><span class="text">Total</span><span class="price"><?php echo number_format($total, 0, '', ',') ?>đ</span></h4><a class="btn btn-primary btn-block btn-lg" href="<?php echo BASE_URL . '/thanh-toan' ?>">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

<?php
include ROOT_DIR . '/src/views/user/foot.php';
?>