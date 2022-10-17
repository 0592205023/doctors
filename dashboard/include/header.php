<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة التحكم</title>
  <!-- favicon -->
  <link rel="icon" type="image/png" href="../layout/images/logo1.png">
  <!-- Bootstrap and Bootstrap Rtl -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/bootstrap2.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/bootstrap-rtl.css">
  <link rel="stylesheet" href="./css/all.min.css">
  <!-- Custom css -->
  <link rel="stylesheet" href="./css/custom.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">لوحة التحكم <i class="fa-solid fa-desktop"></i></div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">نظرة عامة <i class="fa-solid fa-eye"></i></a>
        <a href="news.php" class="list-group-item list-group-item-action bg-light">اخبار <i class="fa-solid fa-newspaper"></i></a>
          <a href="user1.php" class="list-group-item list-group-item-action bg-light">المستخدمين <i class="fa-solid fa-users"></i></a>
          <a href="categories.php" class="list-group-item list-group-item-action bg-light">التخصصات <i class="fa-solid fa-id-card"></i></a>
          <a href="doctor.php" class="list-group-item list-group-item-action bg-light">الاطباء <i class="fa-solid fa-user-doctor"></i></a>
          <a href="order1.php" class="list-group-item list-group-item-action bg-light">الحجوزات <i class="fa-solid fa-calendar-days"></i></a>
          <a href="doctors.php" class="list-group-item list-group-item-action bg-light">جدول المواعيد<i class="fa-solid fa-calendar-days"></i></a>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php" target="_blank">عرض الموقع <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Show user Name  -->
                <?php
                echo $_SESSION['adminInfo'];
                ?>
                <i class="fa-solid fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="logout.php">تسجيل الخروج</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
