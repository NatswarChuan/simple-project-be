<?php
include ROOT_DIR . '/src/views/user/head.php';
?>

<body>
    <?php
    include ROOT_DIR . '/src/views/user/navbar.php';
    ?>
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info"><?php echo $product['product_title'] ?></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                        mattis vitae leo.</p>
                </div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div class="sp-wrap">
                                        <?php
                                        foreach ($product_image as $image) {
                                        ?>
                                            <a href="<?php echo BASE_URL . '/upload/' . $image ?>">
                                                <img class="img-fluid d-block mx-auto" src="<?php echo BASE_URL . '/upload/' . $image ?>">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3><?php echo $product['product_title'] ?></h3>
                                    <div class="price">
                                        <h3><?php echo number_format($price, 0, '', ',');  ?>đ</h3>
                                    </div><button class="btn btn-primary" type="button"><i class="icon-basket"></i>Add
                                        to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" id="description-tab" href="#description">Description</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <?php echo $product['product_description'] ?>
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