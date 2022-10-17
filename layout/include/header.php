<?php
session_start();
require_once('dashboard/include/connection.php');
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
<link rel="shortcut icon" href="layout/images/logo1.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="font-family: 'Cairo', sans-serif;" >مستفي يافا</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="layout/images/logo.png">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="layout/css/bootstrap-rtl.css">
    <!--  Custom css  -->
    <link rel="stylesheet" href="layout/css/custom.css?v=<?php echo time(); ?>">
    <!-- Font -->
    <link rel="stylesheet" href="layout/font/droid-kufi.css">

    <link rel="stylesheet" href="layout/css/lightbox.min.css">
    <link rel="stylesheet" href="layout/css/all.min.css" />
    <script type="text/javascript" src="layout/js/lightbox-plus-jquery.min.js"></script>

</head>

<body>

    <!--    Start navbar    -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a href="index.php" class="navbar-brand"><img width="80px" src="layout/images/logg.png"></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">الرئسية <i class="fa-solid fa-house"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="intrvec.php" class="nav-link">تخصصاتنا <i class="fa-solid fa-sparkles"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">مواعيدنا <i class="fa-solid fa-calendar"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="callUs.php" class="nav-link">تواصل معنا <i class="fa-solid fa-phone"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="services.php" class="nav-link">من نحن <i class="fa-solid fa-circle-question"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="doctor.php" class="nav-link">أطبائنا <i class="fa-solid fa-user-doctor"></i></a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['adminInfo']) && !isset($_SESSION['userInfo'])){
                            ?>
                            <a href="dashboard/index.php" class="nav-link" style="color: var(--main-color)">تسجيل-دخول <i class="fa-solid fa-right-to-bracket"></i></a>


                            <?php
                        }
                        ?>

                    </li>


                    <?php
                    if (isset($_SESSION['adminInfo'])) {
                    ?>
                        <a href="dashboard/dashboard.php" target="_blank" class="dashboard-btn">لوحة التحكم <i class="fa-solid fa-desktop"></i></a>
                    <?php
                    }
                    ?>



                    <?php
                    if (isset($_SESSION['userInfo'])) {

                    ?>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <a href="dashboard/order.php" target="_blank" class="dashboard-btn">حجز موعد <i class="fa-solid fa-calendar-circle-plus"></i></a>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <!-- Show user Name  -->
                                        <?php
                                        echo $_SESSION['userInfo'];
                                        ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="dashboard/logout.php">تسجيل الخروج <i class="fa-solid fa-right-from-bracket"></i></a>
                                    </div>



                                </li>


                            </ul>
                        </div>

                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--    End navbar    -->
    <!--    NEWS   -->
    <div class="hwrap">
      <div class="news">
        أخبار  <i class="fa-solid fa-newspaper"></i>
      </div>
      <div class="news2">
      <div class="news1">
      <div class="hmove">
        <?php
        $query = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
        $res = mysqli_query($con, $query);
        $sNo = 0;
        while ($row = mysqli_fetch_assoc($res)) {
          $sNo++;
          ?>
          <div class="hitem"><?php echo $row['message']; ?></div>
        <?php } ?>
</div>
</div>
</div>
</div>
