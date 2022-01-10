<?php include ROOT_DIR . '/src/views/user/head.php'; ?>
<form action="../su-ly-sua-san-pham/<?php echo URL[1] ?>" method="post">
    <input type="text" name="name" placeholder="product title" value="<?php echo $product['product_title'] ?>" />
    <input type="text" name="price" placeholder="product price" value="<?php echo $product['product_price'] ?>">
    <input type="text" name="sale" placeholder="product sale" value="<?php echo $product['product_sale'] ?>">
    <textarea name="desciption"><?php echo $product['product_description'] ?></textarea>
    <input id="ckfinder-input-2" type="text" style="width:60%" name="image" value="<?php echo $product['product_image'] ?>">
    <div id="ckfinder-popup-2" class="button-a button-a-background">Browse Server</div>
    <img src="<?php echo $product['product_image'] ?>" id="img-1" style="max-width:100px">
    <?php
    foreach ($categories as $category) {
    ?>
        <div class="form-check form-check-inline">
            <input <?php echo in_array($category, $categories_product) ? 'checked' : ''; ?> class="form-check-input" type="checkbox" id="inlineCheckbox<?php echo $category['categories_id'] ?>" value="<?php echo $category['categories_id'] ?>" name="category-<?php echo $category['categories_id'] ?>">
            <label class="form-check-label" for="inlineCheckbox1"><?php echo $category['category_name'] ?></label>
        </div>
    <?php
    }
    ?>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox" name="status" <?php echo $product['status'] == 1 ? 'checked' : ''; ?>>
        <label class="form-check-label" for="inlineCheckbox1">satus</label>
    </div>
    <input hidden value="<?php echo $product['last_update'] ?>" name="last_update">
    <input type="submit">
</form>
<script>
    var editor = CKEDITOR.replace('desciption');
    CKFinder.setupCKEditor(editor);

    var button2 = document.getElementById('ckfinder-popup-2');
    var img = document.getElementById('img-1');

    button2.onclick = function() {
        selectFileWithCKFinder('ckfinder-input-2');
    };

    function selectFileWithCKFinder(elementId) {
        CKFinder.popup({
            chooseFiles: true,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById(elementId);
                    output.value = file.getUrl();
                    img.src = file.getUrl();
                });

                finder.on('file:choose:resizedImage', function(evt) {
                    var output = document.getElementById(elementId);
                    output.value = evt.data.resizedUrl;
                });
            }
        });
    }
</script>

<?php
include ROOT_DIR . '/src/views/user/foot.php';
?>