<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<?php

include('../config/db.php');

$error = $successMsg = "";
if (isset($_POST['addProduct'])) {


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
        $query = "INSERT INTO product (p_name, p_category, p_price, p_color, 
                p_isAvailable, p_count, p_weight, p_brand, p_description,
                p_tags,p_image) 
                VALUES (:p_name, :p_category, :p_price, :p_color, :p_isAvailable,
                 :p_count, :p_weight, :p_brand, :p_desc,:p_tags,:image)";

        if ($stmt = $pdo->prepare($query)) {
            $execRes = $stmt->execute(['p_name' => $p_name, 'p_category' => $p_category, 'p_price' => $p_price,
                'p_color' => $p_color, 'p_isAvailable' => $p_isAvailable, 'p_count' => $p_count, 'p_weight' => $p_weight,
                'p_brand' => $p_brand, 'p_desc' => $p_desc, 'p_tags' => $p_tags, 'image' => $image]);

            if ($execRes) {
                // if was successfull redirect to the admin page
                $successMsg = "Product added successfully !";
                header("location: " . $_SERVER['REQUEST_URI'] . "");
            } else {
                $error = "Something went Wrong!";
            }
            unset($stmt);
        }
    }
}
// close connection
unset($pdo);
?>

<?php
$page_title = "Add Product";
include('../includes/head.php');
?>

<div class="container-fluid">

    <div class="animated fadeIn">
        <div class="row align-items-center justify-content-center">

            <div class="col-lg-4 col-md-6 col-xs-12">

                <form class="mt-5 pt-5mb-5 pb-5 " action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
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
                        <input type="text" name="p_name" class="form-control">
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
                        <input type="text" name="p_price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Color</label>
                        <input type="text" name="p_color" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" name="p_size" class="form-control">
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
                        <input type="number" name="p_count" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Weight</label>
                        <input type="number" name="p_weight" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="p_brand" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" name="p_desc" class="form-control" rows="20" id="ck-editor"></textarea>
                    </div>


                    <label for="">Product Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            <input type="file" class="custom-file-input" name="p_img" id="inputGroupFile01">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tag's</label>
                        <input type="text" name="p_tags" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" name="addProduct" type="submit">ADD</button>
                    </div>

                </form>
            </div>
        </div>
        <!--/row-->
    </div>

</div>
<!--/.container-fluid-->
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
