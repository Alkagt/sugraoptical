<?php
session_start();
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = rand(1000, 9999);
}
include "admin/connection.php";

/*
|--------------------------------------------------------------------------
| 1) Handle add/update/remove actions
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart (from single-product.php)
if (isset($_POST['add_to_cart'])) {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $qty        = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;
    $qty        = max(1, $qty);
    $model      = isset($_POST['selected_model']) ? trim($_POST['selected_model']) : '';

    if ($product_id <= 0) {
        $_SESSION['cart_success'] = "Invalid product.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // Model mandatory
    if ($model === '') {
        $_SESSION['cart_success'] = "Please select model first.";
        header("Location: single-product.php?id=" . $product_id);
        exit;
    }

    // Keep different models as separate cart lines
    $cart_key = $product_id . '|' . $model;

    if (isset($_SESSION['cart'][$cart_key])) {
        $_SESSION['cart'][$cart_key]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$cart_key] = [
            'product_id' => $product_id,
            'model'      => $model,
            'qty'        => $qty
        ];
    }

    $_SESSION['cart_success'] = "Success: Product added to enquiry cart!";
    header("Location: enquiry-cart.php");
    exit;
}

// Update qty
if (isset($_POST['update_cart'])) {
    $cart_key = isset($_POST['cart_key']) ? trim($_POST['cart_key']) : '';
    $qty      = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;
    $qty      = max(1, $qty);

    if ($cart_key !== '' && isset($_SESSION['cart'][$cart_key])) {
        $_SESSION['cart'][$cart_key]['qty'] = $qty;
    }
}

// Remove item
if (isset($_POST['remove_item'])) {
    $cart_key = isset($_POST['cart_key']) ? trim($_POST['cart_key']) : '';
    if ($cart_key !== '' && isset($_SESSION['cart'][$cart_key])) {
        unset($_SESSION['cart'][$cart_key]);
    }
}

/*
|--------------------------------------------------------------------------
| 2) Build cart list
|--------------------------------------------------------------------------
*/
$cartRows = [];

if (!empty($_SESSION['cart'])) {
    // Build unique product id list
    $ids = [];
    foreach ($_SESSION['cart'] as $item) {
        if (!empty($item['product_id'])) {
            $ids[] = (int)$item['product_id'];
        }
    }
    $ids = array_values(array_unique(array_filter($ids)));

    if (!empty($ids)) {
        $idList = implode(',', $ids);

        $sql = "SELECT product_id, product_name, size, product_image
                FROM product
                WHERE product_id IN ($idList)";
        $res = mysqli_query($conn, $sql);

        // Map products by product_id
        $productsById = [];
        while ($p = mysqli_fetch_assoc($res)) {
            $productsById[(int)$p['product_id']] = $p;
        }

        // Build rows using session cart keys (product|model)
        foreach ($_SESSION['cart'] as $cart_key => $citem) {
            $pid = (int)$citem['product_id'];
            if (!isset($productsById[$pid])) {
                continue;
            }

            $p = $productsById[$pid];
            $p['cart_key'] = $cart_key;
            $p['model'] = $citem['model'];
            $p['qty'] = (int)$citem['qty'];

            $cartRows[] = $p;
        }
    }
}

/*
|--------------------------------------------------------------------------
| 3) Submit enquiry (SMTP only, no tables)
|--------------------------------------------------------------------------
*/
if (isset($_POST['submit_enquiry'])) {

    $full_name    = trim($_POST['full_name'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $company_name = trim($_POST['company_name'] ?? '');
    $country      = trim($_POST['country'] ?? '');
    $gst_no       = trim($_POST['gst_no'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $message      = trim($_POST['message'] ?? '');
    $captcha      = trim($_POST['captcha'] ?? '');

    // ✅ CAPTCHA
    if ($captcha != $_SESSION['captcha']) {
        $_SESSION['cart_success'] = "Invalid captcha!";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Required fields
    if ($full_name === '' || $phone === '' || $email === '' || $country === '' || $address === '') {
        $_SESSION['cart_success'] = "Please fill all required fields.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Name validation (only letters + space)
    if (!preg_match("/^[a-zA-Z ]{2,50}$/", $full_name)) {
        $_SESSION['cart_success'] = "Invalid name. Only letters allowed (2-50 chars).";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['cart_success'] = "Invalid email address.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Phone validation (India: 10 digits, starts with 6-9)
    if (!preg_match("/^[6-9][0-9]{9}$/", $phone)) {
        $_SESSION['cart_success'] = "Invalid phone number. Enter valid 10-digit number.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Optional: GST validation (basic format)
    if (!empty($gst_no) && !preg_match("/^[0-9A-Z]{15}$/", $gst_no)) {
        $_SESSION['cart_success'] = "Invalid GST number.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // ✅ Cart check
    if (empty($cartRows)) {
        $_SESSION['cart_success'] = "Your enquiry cart is empty.";
        header("Location: enquiry-cart.php");
        exit;
    }

    // 📩 Mail body
    $mailBody  = "New Enquiry\n\n";
    $mailBody .= "Name: $full_name\n";
    $mailBody .= "Phone: $phone\n";
    $mailBody .= "Email: $email\n";
    $mailBody .= "Company: $company_name\n";
    $mailBody .= "Country: $country\n";
    $mailBody .= "GST: $gst_no\n";
    $mailBody .= "Address: $address\n\n";

    $mailBody .= "Products:\n";
    foreach ($cartRows as $row) {
        $mailBody .= "- {$row['product_name']} | Model: {$row['model']} | Qty: {$row['qty']}\n";
    }

    $to = getenv('ADMIN_EMAIL') ?: "admin@example.com";
    $subject = "New Product Enquiry";
    
    $headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type:text/plain;charset=UTF-8\r\n";
	$headers .= "From: noreply@example.com\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();

   if (mail($to, $subject, $mailBody, $headers)) {
    unset($_SESSION['cart']);

    // ✅ RESET CAPTCHA HERE
    unset($_SESSION['captcha']);

    $_SESSION['cart_success'] = "Enquiry sent successfully!";
    } else {
        $_SESSION['cart_success'] = "Mail failed. Try again.";
    }

    header("Location: enquiry-cart.php");
    exit;
}
include "header.php";
?>

<div class="hero-block inner-hero clear">
    <div class="item"><img src="images/inner-hero.jpg" alt="hero" /></div>
    <div class="caption">
        <div class="table1">
            <div class="table2">
                <div class="containers">
                    <div class="content">
                        <h1>Enquiry Cart</h1>
                        <div class="breadcrumb">
                            <div class="containers-lg">
                                <a href="index.html">Home</a>
                                <span>›</span>
                                <span class="current"> Enquiry Cart </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

<section class="enquirycart-one clear">
    <div class="containers">
        <?php if (!empty($_SESSION['cart_success'])): ?>
            <div class="success-txt">
                <?php echo htmlspecialchars($_SESSION['cart_success']); ?>
            </div>
            <?php unset($_SESSION['cart_success']); ?>
        <?php endif; ?>

        <h2>Enquiry Cart</h2>

        <table>
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Product Details</th>
                    <th>Model</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($cartRows)): ?>
                <?php $i = 1; foreach ($cartRows as $row): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($row['product_name']); ?></strong>
                        </td>
                        <td><?php echo htmlspecialchars($row['model']); ?></td>
                        <td>
                            <form method="post" style="display:inline-block;">
                                <input type="hidden" name="cart_key" value="<?php echo htmlspecialchars($row['cart_key']); ?>">
                                <input type="number" name="qty" min="1" value="<?php echo (int)$row['qty']; ?>" style="width:70px;">
                                <button type="submit" name="update_cart">Update</button>
                            </form>

                            <form method="post" style="display:inline-block; margin-left:8px;">
                                <input type="hidden" name="cart_key" value="<?php echo htmlspecialchars($row['cart_key']); ?>">
                                <button type="submit" name="remove_item">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Your enquiry cart is empty.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="checkout-btn">
            <button class="cta-button2" type="button">Proceed to Checkout</button>
        </div>

        <div class="contact-info-form">
            <h2>Contact Information</h2>
            <div class="contact-info-flex">
                <form method="post" action="">
                    <div class="col2">
                        <label>Name<sup>*</sup></label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="col2">
                        <label>Phone Number<sup>*</sup></label>
                        <input type="tel" name="phone" required>
                    </div>
                    <div class="col2">
                        <label>Email ID<sup>*</sup></label>
                        <input type="text" name="email" required>
                    </div>
                    <div class="col2">
                        <label>Company Name</label>
                        <input type="text" name="company_name">
                    </div>
                    <div class="col2">
                        <label>Country<sup>*</sup></label>
                        <input type="text" name="country" required>
                    </div>
                    <div class="col2">
                        <label>GST No.</label>
                        <input type="text" name="gst_no">
                    </div>
                    <div class="col2">
                        <label>Address<sup>*</sup></label>
                        <textarea name="address" required></textarea>
                    </div>
                    <div class="col2">
                        <label>Message</label>
                        <?php
                        $cartSummary = "Enquiry Cart Items:\n";
                        foreach ($cartRows as $row) {
                            $cartSummary .= "- {$row['product_name']} (Model: {$row['model']}), Qty: {$row['qty']}\n";
                        }
                        ?>
                        <textarea name="message"><?php echo htmlspecialchars($cartSummary); ?></textarea>
                    </div>
                    <div class="col2">
                        <label>Enter Captcha: <strong><?php echo $_SESSION['captcha']; ?></strong></label>
                        <input type="text" name="captcha" required>
                    </div>
                    <div class="col1 submit-btn">
                        <span class="cta-button2"><input type="submit" name="submit_enquiry" value="Submit"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>