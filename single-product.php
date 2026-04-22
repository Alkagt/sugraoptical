<?php
include "admin/connection.php";
include "header.php";

$category_slug = $_GET['category'] ?? '';
$product_slug  = $_GET['product'] ?? '';
$product_id    = $_GET['id'] ?? '';

// Fetch product
$query = mysqli_query($conn, "
    SELECT product.*, category.category_slug, category.category_name 
    FROM product 
    INNER JOIN category ON product.category_id = category.category_id
    WHERE product.product_id = '" . mysqli_real_escape_string($conn, $product_id) . "'
");

$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<p>Product not found.</p>";
    include "footer.php";
    exit;
}

$models_raw = explode(',', (string)$data['size']);
$models = [];
foreach ($models_raw as $m) {
    $m = trim($m);
    if ($m !== '') {
        $models[] = $m;
    }
}
?>
<div class="hero-block inner-hero clear">
    <div class="item"><img src="<?php echo BASE_FRONT_URL; ?>/images/inner-hero.jpg" alt="hero" /></div>
    <div class="caption">
        <div class="table1">
            <div class="table2">
                <div class="containers">
                    <div class="content">
                        <h1>Our Products</h1>
                        <div class="breadcrumb">
                            <div class="containers-lg">
                                <a href="index.html">Home</a>
                                <span>›</span>
                                <a href="products.html">Products</a>
                                <span>›</span>
                                <a href="products.html"><?php echo htmlspecialchars($data['category_name']); ?></a>
                                <span>›</span>
                                <span class="current"><?php echo htmlspecialchars($data['product_name']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="products-categories clear">
    <div class="containers">
        <div class="product">
            <div class="product-images">
                <div class="image-wrapper">
                    <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo htmlspecialchars($data['product_image']); ?>"
                         class="main-image"
                         id="mainImage"
                         alt="">
                </div>
            </div>

            <div class="product-details">
                <h1><?php echo htmlspecialchars($data['product_name']); ?></h1>

                <p class="description">
                    <b>Category Name: </b><?php echo htmlspecialchars($data['category_name']); ?>
                </p>

                <form method="POST" action="<?php echo BASE_FRONT_URL; ?>/enquiry-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo (int)$data['product_id']; ?>">

                    <div class="quantity-size">
                        <div class="quantity-box">
                            <label>Quantity</label>
                            <div class="quantity">
                                <button type="button" class="qty-btn" data-change="-1">-</button>
                                <input type="number" name="qty" id="qty" value="1" min="1">
                                <button type="button" class="qty-btn" data-change="1">+</button>
                            </div>
                        </div>
                        <div class="size-box">
                            <label>Model</label>
                            <select name="selected_model" id="size" required>
                                <option value="" disabled selected>Select Model</option>
                                <?php foreach ($models as $modelpro) { ?>
                                    <option value="<?php echo htmlspecialchars($modelpro); ?>"><?php echo htmlspecialchars($modelpro); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="add_to_cart" class="cta-button2" style="margin-top:12px;">
                        Add to Cart
                    </button>
                </form>

                <div class="needhelp">
                    <label><strong>Need Help?</strong> Call Us: <a href="#">+91-9911838303</a> / Email Us: <a href="#">sugraoptical@gmail.com</a></label>
                    <label><strong>Opening Hours:</strong> Mon-Sat: 11:00AM - 05:00PM</label>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="clear">
    <div class="containers">
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab-btn active" data-tab="tab1" type="button">Description</button>
                <button class="tab-btn" data-tab="tab2" type="button">Product Details</button>
                <button class="tab-btn" data-tab="tab3" type="button">Reviews</button>
                <div class="tab-indicator"></div>
            </div>

            <div class="tab-content-wrapper">
                <div class="tab-content active" id="tab1">
                    <?php echo $data['product_description']; ?>
                    <b>Product Specification: <?php echo $data['product_specification']; ?></b>
                </div>
                <div class="tab-content" id="tab2">
                    <ul>
                        <li><span>Country of Origin</span> <?php echo htmlspecialchars($data['country']); ?></li>
                        <li><span>Packaging Type</span> <?php echo htmlspecialchars($data['packaging_type']); ?></li>
                        <li><span>Material</span> <?php echo htmlspecialchars($data['material']); ?></li>
                        <li><span>Brand</span> <?php echo htmlspecialchars($data['brand']); ?></li>
                        <li><span>Size</span> <?php echo htmlspecialchars($data['size']); ?></li>
                    </ul>
                </div>
                <div class="tab-content" id="tab3">
                    <div class="review-card">
                        <div class="single-review">
                            <div class="review-img"><img src="images/avtar.jpg" alt=""></div>
                            <div class="review-content">
                                <div class="review-top-wrap">
                                    <div class="review-left">
                                        <div class="review-name"><h4>Xyz</h4></div>
                                        <div class="rating-product">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="review-left"><a href="#">Reply</a></div>
                                </div>
                                <div class="review-bottom"><p>Review text placeholder.</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="add-reviews">
                        <h2>Add a Review</h2>
                        <div class="review-input">
                            <input type="text" name="" placeholder="Name">
                            <input type="email" name="" placeholder="Email">
                            <textarea placeholder="Message" name="Your Review"></textarea>
                            <input type="submit" name="" value="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$cat_id = (int)$data['category_id'];
$related_products = mysqli_query($conn, "
    SELECT * FROM product
    WHERE category_id = '$cat_id' AND product_id != '" . mysqli_real_escape_string($conn, $product_id) . "'
    ORDER BY product_id DESC LIMIT 6
");
if ($related_products && mysqli_num_rows($related_products) > 0) {
    ?>
    <section class="related-product clear">
        <div class="containers">
            <h2>Related Products</h2>
            <div class="owl-carousel owl-theme arrow-owl product-cat">
                <?php while ($rel = mysqli_fetch_assoc($related_products)) {
                    $rel_url = BASE_FRONT_URL . '/single-product.php?id=' . (int)$rel['product_id']
                        . '&category=' . urlencode($data['category_slug'])
                        . '&product=' . urlencode($rel['product_slug']);
                    ?>
                    <div class="subcard-cat">
                        <div class="cardicon">
                            <img src="<?php echo BASE_URL; ?>/assets/uploads/<?php echo htmlspecialchars($rel['product_image']); ?>" alt="">
                        </div>
                        <h3><?php echo htmlspecialchars($rel['product_name']); ?></h3>
                        <a href="<?php echo BASE_FRONT_URL.'/'.$data['category_slug'].'/'.$rel['product_slug'].'/p/'.$rel['product_id']; ?>" class="cta-button2">View product</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
}

include "footer.php";
?>