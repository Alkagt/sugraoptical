<?php
//session_start();
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Dynamic CSS -->
    <?php if (isset($page) && $page == 'login'): ?>
        <link rel="stylesheet" href="assets/css/login.css">
    <?php else: ?>
        <!-- <link rel="stylesheet" href="assets/css/admin-style.css"> -->
    <?php endif; ?>
	<script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-open');
    }
</script>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Poppins", sans-serif;
}

.container-admin{
    display:flex;flex-wrap: wrap;
}


/* Sidebar */
.sidebar{
    width:250px;
    height:100vh;
    background:#1e293b;
    color:#fff;
    position:fixed;
    left:0;
    top:0;
    transition:0.3s;
    padding:20px 0;
}

.sidebar .logo-md{display: inline-block;padding: 0 20px;}
.sidebar .logo-md img{width: 200px;}

.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    margin:15px 0;
}

.sidebar ul li.active{
        background: #00a1e3;
    border-left: 5px solid #fd4101;
}
.sidebar ul li.active a{color: #fff;}

.sidebar ul li a{
       color: #cbd5e1;
    text-decoration: none;
    display: inline-block;
    padding: 15px 20px;
    width: 100%;
}

.sidebar ul li a:hover{
    color:#fff;
}

/* Hide sidebar */
.sidebar.active{
    left:-250px;
}

/* Main */
.main{
    margin-left:250px;
    width:100%;
    transition:0.3s;
}

/* Shift main when sidebar hidden */
.main.shift{
    margin-left:0;
}

/* Topbar */
.topbar{
    background:#fff;
    padding:15px;
    display:flex;
    align-items:center;
    gap:15px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
        justify-content: space-between;
}

.toggle-btn{
    font-size:22px;
    background:none;
    border:none;
    cursor:pointer;
}

.topbar .right,
.topbar .right .add-btns{    display: flex;
    align-items: center;}

.topbar .right ul.header-top{
        display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.topbar .right ul.header-top li a:hover,
.topbar .right ul.header-top li:focus{text-decoration: none;}

.topbar .right ul.header-top .dropdown-menu{
        right: 0;
    left: unset;
}

    .addproduct-btn{
            background: #00a1e3;
    text-decoration: none;
    padding: 6px 10px;
    display: inline-block;
    color: #fff;
    border-radius: 100px;
        font-size: 15px;
    text-transform: capitalize;
    font-weight: 600;border: 2px solid #00a1e3;transition: 0.3s;
    }
     .addproduct-btn:hover,
     .addproduct-btn:focus{background: #fff;color:#00a1e3; }


     .bell-noti{
        margin: 0 15px;
    font-size: 20px;
    border: 1px solid;
    border-radius: 100px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
     }

/* Content */

.dashboard-all-content .titles{padding: 20px ;}
.dashboard-all-content .titles h1{    margin: 0;}
.dashboard-all-content .titles h2{
        color: #fd4101;
    font-size: 22px;
    text-transform: capitalize;
}
.content{
    padding:20px;
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(200px,1fr));
    gap:20px;
}

.card{
    background:#fff;
    padding:30px;
    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,0.09);
}

.search-bar {
    padding: 8px 12px;
    border-radius: 5px;
    border: 1px solid #ccc;width: 50%;
}

/* Admin Dropdown */
.admin-dropdown {
    position: relative;
}

.admin-btn {
      background: transparent;
    color: #fff;
    padding: 5px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    align-items: center;
}

.admin-btn img{
        background: #f7bfab;
    border-radius: 10px;
    width: 40px;
    padding: 6px;
}

.admin-btn .fa-caret-down{    color: #000;
    padding-left: 10px;}

.dropdown-content {
    position: absolute;
    right: 0;
    top: 55px;
    background: #fff;
    width: 150px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: none;
    border-radius: 5px;
}

.dropdown-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

.dropdown-content a:hover {
    background: #f1f1f1;
}

.dropdown-content.show {
    display: block;
}


/*-------*/


.sales {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sales h2{
        margin: 0;
    font-size: 21px;
    color: #8492af;
}

.sales button::before {
    content: "";
    font-family: FontAwesome;
    position: absolute;
    right: 12px;
    top: 11px;
}

.sales button {
    background: rgb(0 161 227 / 4%) none repeat scroll 0 0;
    border: 1px solid #dadee7;
    border-radius: 100px;
    font-size: 15px;
    letter-spacing: 0.5px;
    padding-right: 32px;
    color: #0e1a35;
}

.sales button::before {
    content: "";
    font-family: FontAwesome;
    position: absolute;
    right: 12px;
    top: 11px;
}
.sales  .btn-group {
    float: right;
}
.sales h2 {
    color: #8492af;
    float: left;
    font-size: 21px;
    font-weight: 600;
    margin: 0;
    padding: 9px 0 0;
}
.btn.btn-secondary.btn-lg.dropdown-toggle > span {
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.sales .dropdown-menu{
    margin: 0px;
    padding: 0px;
    border: 0px;
    border-radius: 8px;
    width: 100%;
    color: #0e1a35;
}
.sales .btn-group.open .dropdown-toggle, .btn.active, .btn:active{
    box-shadow: none;
}
.sales .dropdown-menu > a {
    color: #0e1a35;
    display: inline-block;
    font-weight: 800;
    padding: 9px 0;
    text-align: center;
    width: 100%;text-decoration: none;
}

.sales .dropdown-menu > a:hover{
    color: #5584FF;   
}
/*add-product-CSS*/

button.btn.cancel {
    border: 2px solid #fd4101;
    border-radius: 100px;
    color: #fd4101;
    background: #fff;
    font-size: 15px;
    font-weight: 600;
    padding: 8px 15px;
    display: inline-block;
    text-transform: capitalize;
    transition: 0.3s;
}

button.btn.add-project{
      border: 2px solid #fd4101;
    border-radius: 100px;
    color: #fff;
    background: #fd4101;
    font-size: 15px;
    font-weight: 600;
    padding: 8px 15px;
    display: inline-block;
    text-transform: capitalize;
    transition: 0.3s;
}





/* Responsive */
@media(max-width:1199px){

     .topbar{flex-wrap: wrap;}
    .toggle-btn{    position: absolute;
    right: 20px;
    top: 10px;}
    .search-bar{width: 90%;}

    .sidebar{
        left:-250px;z-index: 9;
    }

    .sidebar.active{
        left:0;
    }

    .main{
        margin-left:0;
    }

    .main.shift{
        margin-left:0;
    }
}


@media(max-width:585px){

}

</style>
</head>

<body class="<?php echo ($page ?? 'home'); ?>">

<?php if (!isset($page) || $page != 'login'): ?>

<div class="container-admin">

       <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
       <a href="dashboard.html" class="logo-md"> <img src="https://sugraoptical.inrank.io/images/logo-sugraoptical.png"> </a>
       <?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
         <ul>
        <li class="<?php if($current_page == 'dashboard.php') echo 'active'; ?>">
            <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
        </li>

        <li class="<?php if($current_page == 'add-product.php') echo 'active'; ?>">
            <a href="add-product.php"><i class="fa fa-plus"></i> Add Product</a>
        </li>

        <li class="<?php if($current_page == 'add-category.php') echo 'active'; ?>">
            <a href="add-category.php"><i class="fa fa-plus"></i> Add Category</a>
        </li>

        <li class="<?php if($current_page == 'products.php') echo 'active'; ?>">
            <a href="products.php"><i class="fa fa-users"></i> Products</a>
        </li>

        <li class="<?php if($current_page == 'category.php') echo 'active'; ?>">
            <a href="category.php"><i class="fa fa-cog"></i> Category</a>
        </li>
    </ul>
    </div>




     <!-- Main Content -->
    <div class="main" id="main">

        <!-- Topbar -->
        <div class="topbar">
            <button class="toggle-btn" onclick="toggleMenu()">☰</button>
              <input type="text" placeholder="Search..." class="search-bar">

             <div class="right">
            

              <ul class="list-inline header-top pull-right">
                            <li>
                                <a href="add-product.php" class="addproduct-btn"><i class="fa fa-plus-circle"></i> Add Product</a>
                            </li>
                            <li>
                                <a href="#" class="bell-noti"><i class="fa fa-bell"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle admin-btn" data-toggle="dropdown">
                                    <img src="https://sugraoptical.inrank.io/images/user.png" alt="User">
                                    <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="navbar-content">
                                        <span><?php echo $_SESSION['user_name']; ?></span>
                                        <p class="text-muted small"><?php echo $_SESSION['user_email']; ?></p>
                                        <a href="logout.php" class="view btn-sm btn-danger">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
       
            </div>
        </div>



    
  <script type="text/javascript" src="assets/js/custom.js"></script>

<?php endif; ?>
