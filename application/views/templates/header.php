<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>


<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav_bar_main">
        <div class="container">

            <div class="navbar-nav">
                <a class="navbar-brand" href="<?= base_url(''); ?>">
                    <i class="fas fa-dog"></i>
                    Kouvee Pet
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href=<?= base_url(''); ?>>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=<?= base_url('main/menu_products'); ?>>Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('main/menu_about'); ?>">About Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('auth'); ?>" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>