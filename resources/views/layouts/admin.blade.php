<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BugWildFlyCo. Admin</title>

    <!-- Custom CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <!-- Morris Charts CSS -->
    <!-- <link href="morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="admin-body">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">Bugwild</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>USERNAMES<b
                        class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="divider"></li>
                <li>
                    <a href="login.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="/admin/product"><i class="fa fa-fw fa-table"></i>Products</a>
            </li>
            <li>
                <a href="/admin/add_product"><i class="fa fa-fw fa-plus"></i>Add Product</a>
            </li>
            <li>
                <a href="/admin/product_category"><i class="fa fa-fw fa-list-ol"></i>Product Categories</a>
            </li>
            <li>
                <a href="/admin/product_color"><i class="fa fa-fw fa-paint-brush"></i>Product Colors</a>
            </li>
            <li>
                <a href="/admin/product_size"><i class="fa fa-fw fa-arrows-alt"></i>Product Sizes</a>
            </li>
            <li>
                <a href="/admin/posts"><i class="fa fa-fw fa-table"></i>Blog Posts</a>
            </li>
            <li>
                <a href="/admin/add_post"><i class="fa fa-fw fa-plus"></i>Add Blog Post</a>
            </li>
            <li>
                <a href="/admin/post_category"><i class="fa fa-fw fa-list-ol"></i>Blog Categories</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-users"></i>Users</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">


    @yield('content')


</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<!-- <script src="../js/jquery.js"></script> -->
<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Morris Charts JavaScript -->
<!-- <script src="js/plugins/morris/raphael.min.js"></script> -->
<!-- <script src="js/plugins/morris/morris.min.js"></script> -->
<!-- <script src="js/plugins/morris/morris-data.js"></script> -->
</body>
</html>

<style media="screen">

    body {
        margin-top: 100px;
        background-color: #222;
    }

    @media (min-width: 768px) {
        body {
            margin-top: 50px;
        }
    }

    #wrapper {
        padding-left: 0;
    }

    #page-wrapper {
        width: 100%;
        padding: 0;
        background-color: #fff;
    }

    .huge {
        font-size: 50px;
        line-height: normal;
    }

    @media (min-width: 768px) {
        #wrapper {
            padding-left: 225px;
        }

        #page-wrapper {
            padding: 10px;
        }
    }

    /* Top Navigation */

    .top-nav {
        padding: 0 15px;
    }

    .top-nav > li {
        display: inline-block;
        float: left;
    }

    .top-nav > li > a {
        padding-top: 15px;
        padding-bottom: 15px;
        line-height: 20px;
        color: #999;
    }

    .top-nav > li > a:hover,
    .top-nav > li > a:focus,
    .top-nav > .open > a,
    .top-nav > .open > a:hover,
    .top-nav > .open > a:focus {
        color: #fff;
        background-color: #000;
    }

    .top-nav > .open > .dropdown-menu {
        float: left;
        position: absolute;
        margin-top: 0;
        border: 1px solid rgba(0, 0, 0, .15);
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        background-color: #fff;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    }

    .top-nav > .open > .dropdown-menu > li > a {
        white-space: normal;
    }

    ul.message-dropdown {
        padding: 0;
        max-height: 250px;
        overflow-x: hidden;
        overflow-y: auto;
    }

    li.message-preview {
        width: 275px;
        border-bottom: 1px solid rgba(0, 0, 0, .15);
    }

    li.message-preview > a {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    li.message-footer {
        margin: 5px 0;
    }

    ul.alert-dropdown {
        width: 200px;
    }

    /* Side Navigation */

    @media (min-width: 768px) {
        .side-nav {
            position: fixed;
            top: 51px;
            left: 225px;
            width: 225px;
            margin-left: -225px;
            border: none;
            border-radius: 0;
            overflow-y: auto;
            background-color: #222;
            bottom: 0;
            overflow-x: hidden;
            padding-bottom: 40px;
        }

        .side-nav > li > a {
            width: 225px;
        }

        .side-nav li a:hover,
        .side-nav li a:focus {
            outline: none;
            background-color: #000 !important;
        }
    }

    .side-nav > li > ul {
        padding: 0;
    }

    .side-nav > li > ul > li > a {
        display: block;
        padding: 10px 15px 10px 38px;
        text-decoration: none;
        color: #999;
    }

    .side-nav > li > ul > li > a:hover {
        color: #fff;
    }

    /* Flot Chart Containers */

    .flot-chart {
        display: block;
        height: 400px;
    }

    .flot-chart-content {
        width: 100%;
        height: 100%;
    }

    /* Custom Colored Panels */

    .huge {
        font-size: 40px;
    }

    .panel-green {
        border-color: #5cb85c;
    }

    .panel-green > .panel-heading {
        border-color: #5cb85c;
        color: #fff;
        background-color: #5cb85c;
    }

    .panel-green > a {
        color: #5cb85c;
    }

    .panel-green > a:hover {
        color: #3d8b3d;
    }

    .panel-red {
        border-color: #d9534f;
    }

    .panel-red > .panel-heading {
        border-color: #d9534f;
        color: #fff;
        background-color: #d9534f;
    }

    .panel-red > a {
        color: #d9534f;
    }

    .panel-red > a:hover {
        color: #b52b27;
    }

    .panel-yellow {
        border-color: #f0ad4e;
    }

    .panel-yellow > .panel-heading {
        border-color: #f0ad4e;
        color: #fff;
        background-color: #f0ad4e;
    }

    .panel-yellow > a {
        color: #f0ad4e;
    }

    .panel-yellow > a:hover {
        color: #df8a13;
    }

    .side-nav {
        margin-right: 2px;
    }

    #page-wrapper {
        background-color: #F1F1F1 !important;
        height: 100vh;
        overflow-y: scroll;
        width: 87%;
        display: block;
        float: right;
    }

    .product_image {

        width: 200px !important;
        height: 100px !important;

    }

    #admin_sidebar .form-group {

        background-color: #fff;
        padding: 8px;

    }

    #admin_sidebar .form-group hr {

        margin-top: 10px;
        margin-bottom: 10px;

    }

    #admin_sidebar .btn {

        width: 49%;

    }

    td img {
        width: 62px;
        height: auto;
    }
</style>
