<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<?php

include('../config/db.php');
$successMsg = $error = "";
if (isset($_GET['p_id'])) {
    $productId = $_GET['p_id'];
}

$query = "SELECT * FROM product WHERE p_id=:productId";
$stmt = $pdo->prepare($query);
$stmt->execute(['productId' => $productId]);

while ($row = $stmt->fetch()) {

    $product_id = $row['p_id'];
    $product_name = $row['p_name'];
    $product_category = $row['p_category'];
    $product_image = $row['p_image'];
    $product_price = $row['p_price'];
    $product_desc = $row['p_description'];
    $product_color = $row['p_color'];
    $product_size = $row['p_size'];
    $product_isAvailable = $row['p_isAvailable'];
    $product_addedDate = $row['p_addedDate'];
    $product_count = $row['p_count'];
    $product_weight = $row['p_weight'];
    $product_brand = $row['p_brand'];
    $product_tags = $row['p_tags'];


    // updating product
    if (isset($_POST['updateProduct'])) {

        $p_name = trim(htmlspecialchars($_POST['p_name']));
        $p_category = trim(htmlspecialchars($_POST['p_category']));
        $p_price = trim(htmlspecialchars($_POST['p_price']));
        $p_color = trim(htmlspecialchars($_POST['p_color']));
        $p_isAvailable = trim(htmlspecialchars($_POST['p_isAvailable']));
        $p_count = trim(htmlspecialchars($_POST['p_count']));
        $p_weight = trim(htmlspecialchars($_POST['p_weight']));
        $p_brand = trim(htmlspecialchars($_POST['p_brand']));
        $p_desc = trim(htmlspecialchars(strip_tags($_POST['p_desc'])));
        $p_tags = trim(htmlspecialchars($_POST['p_tags']));
        $image = $_FILES['p_img']['name'];
        $image_tmp = $_FILES['p_img']['tmp_name'];


        move_uploaded_file($image_tmp, "../assets/img/products/" . $image);


        if (empty($p_name) || empty($p_category) || empty($p_price) || empty($p_color) || empty($p_isAvailable)
            || empty($p_count) || empty($p_weight) || empty($p_brand) || empty($p_desc) || empty($p_tags)) {
            $error = "Please fill all the fields";

        } else {
            if ($image == '' || empty($image)) {
                $query = "UPDATE product SET p_name=:p_name, p_category= :p_category, p_price=:p_price, p_color= :p_color, 
                p_isAvailable=:p_isAvailable, p_count=:p_count, p_weight=:p_weight, p_brand=:p_brand, p_description=:p_desc,
                p_tags=:p_tags WHERE p_id=:deleteId";

                $exec = ['p_name' => $p_name, 'p_category' => $p_category, 'p_price' => $p_price,
                    'p_color' => $p_color, 'p_isAvailable' => $p_isAvailable, 'p_count' => $p_count, 'p_weight' => $p_weight,
                    'p_brand' => $p_brand, 'p_desc' => $p_desc, 'p_tags' => $p_tags, "deleteId" => $productId];
            } else {
                $query = "UPDATE product SET p_name=:p_name, p_category= :p_category, p_price=:p_price, p_color= :p_color, 
                p_isAvailable=:p_isAvailable, p_count=:p_count, p_weight=:p_weight, p_brand=:p_brand, p_description=:p_desc,
                p_tags=:p_tags,p_image=:image WHERE p_id=:deleteId";

                $exec = ['p_name' => $p_name, 'p_category' => $p_category, 'p_price' => $p_price,
                    'p_color' => $p_color, 'p_isAvailable' => $p_isAvailable, 'p_count' => $p_count, 'p_weight' => $p_weight,
                    'p_brand' => $p_brand, 'p_desc' => $p_desc, 'p_tags' => $p_tags, 'image' => $image, "deleteId" => $productId];
            }


            if ($upStmt = $pdo->prepare($query)) {
                $execRes = $upStmt->execute($exec);

                if ($execRes) {
                    $successMsg = "Product update successfully !";
                    // if was successfull redirect to the admin page
                    header("location: products.php");
                } else {
                    $error = "Something went Wrong!";
                    unset($stmt);
                }
            }
        }

    }
// close connection
    unset($pdo);
    ?>


    <form class="mt-5 pt-5mb-5 pb-5 " action="" method="post"
          enctype="multipart/form-data">

        <?php
        if (!empty($error)) {
            echo " <div class='alert alert-danger'>$error</div>";
        }

        if (!empty($successMsg)) {
            echo "<div class='alert alert-success'>$successMsg</div>";
        }
        ?>

        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" name="p_name" class="form-control" value="<?php echo $product_name ?>">
        </div>

        <div class="form-group">
            <label for="">Category</label>
            <select class="form-control" name="p_category" id="">
                <option value="mobile">Mobile</option>
                <option value="laptop">Laptop</option>
                <option value="tablet">Tablet</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Price</label>
            <input type="text" name="p_price" class="form-control" value="<?php echo $product_price ?>">
        </div>

        <div class="form-group">
            <label for="">Color</label>
            <input type="text" name="p_color" class="form-control" value="<?php echo $product_color ?>">
        </div>

        <div class="form-group">
            <label for="">Size</label>
            <input type="text" name="p_size" class="form-control" value="<?php echo $product_size ?>">
        </div>

        <div class="form-group">
            <label for="">Is Available</label>
            <select type="text" name="p_isAvailable" class="form-control">
                <option value="true">Yes</option>
                <option value="false">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Count</label>
            <input type="number" name="p_count" class="form-control" value="<?php echo $product_count ?>">
        </div>

        <div class="form-group">
            <label for="">Weight</label>
            <input type="number" name="p_weight" class="form-control" value="<?php echo $product_weight ?>">
        </div>


        <div class="form-group">
            <label for="">Brand</label>
            <input type="text" name="p_brand" class="form-control" value="<?php echo $product_brand ?>">
        </div>

        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" name="p_desc" class="form-control" id="ck-editor">
                <?php echo $product_desc ?>
            </textarea>
        </div>


        <label for="">Product Image</label>
        <div class="input-group mb-3">
            <div class="custom-file">
                <label class="custom-file-label" for="inputGroupFile01"><?php echo $product_image ?></label>
                <input type="file" class="custom-file-input" name="p_img" id="inputGroupFile01">
            </div>
        </div>

        <div class="form-group">
            <label for="">Tag's</label>
            <textarea type="text" rows="5" name="p_tags" class="form-control">
                <?php echo $product_tags ?>
            </textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-warning" name="updateProduct" type="submit">Edit</button>
        </div>

    </form>

    <?php

}// end of while
?>


<?php
include('includes/tail.php')
?>
<script>
    ClassicEditor
        .create(document.querySelector('#ck-editor'))
        .then(editor => {
            console.log(Array.from(editor.ui.componentFactory.names()));
        })
        .catch(error => {
            console.error(error);
        });
</script>
