<?php
include 'auth_check.php';
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - AEAK</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/bootstrap.min.css" rel="stylesheets" />
    <link href="css/dashbd.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border: 1px solid #e0e4e8;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #95a5a6;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: background-color 0.3s ease;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .image-preview {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-input-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .file-input-btn {
            border: 1px solid #e0e4e8;
            display: inline-block;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .file-input-btn:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">AEAK Dashboard</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul> -->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Updates</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Posts
                        </a>
                        <a class="nav-link" href="add_post.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Add Post
                        </a>
                    </div>
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Users</div>
                        <a class="nav-link" href="users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            users
                        </a>
                        <a class="nav-link" href="register-form.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Add user
                        </a>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>