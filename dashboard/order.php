<?php
session_start();
include 'include/connection.php';
if (!isset($_SESSION['userInfo'])) {
  header('Location:index.php');
  exit;
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title>حجز موعد </title>
        <link href="./css/all.min.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="../layout/images/logo1.png">
        <!-- MDB -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/custom.css?ver=4">
        <link rel="stylesheet" href="./css/b.rtl.css?ver=22">

      </head>
      <body>
        <!-- Log to dashboard  -->
        <?php

          if(isset($_POST['log'])){
            $fullName = $_POST['fullName'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $doctorname = $_POST['doctorname'];
            $orderDate= $_POST['orderDate'];
            $specialtyCat = $_POST['specialtyCat'];
            if (empty($fullName) || empty($mobile)  || empty($address) || empty($doctorname) || empty($orderDate)) {
                $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
            } else {
                $query = "INSERT INTO orders(fullName,mobile,address,postNum ,doctorname , orderDate)
                    VALUES('$fullName','$mobile','$address','$specialtyCat' ,'$doctorname' , '$orderDate' )";


                $res = mysqli_query($con, $query);
                if (isset($res)) {

                      header("Location:final.php");
                }
            }
        }

        ?>
        <?php if(!empty($error)){?>
          <div class="backgraund_error" id="Erorr"></div>
        <div aria-live="polite" aria-atomic="true" class="erorr_login d-flex justify-content-center align-items-center w-100">
          <!-- Then put toasts within -->
          <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000" style="display:block;" >
            <div class="toast-header">
               <strong class="me-auto">تحذير</strong>
               <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
             </div>
              <div class="toast-body">
              <?php echo $error;?>
            </div>
          </div>
        </div>
        <?php }?>
        <!-- Section: Design Block -->
    <section class="text-center">
      <!-- Background image -->
      <div class="p-5 bg-image" style="
            background-image: url('images/44.jpg');
            height: 350px;
            background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            "></div>
      <!-- Background image -->

      <div class="card mx-4 mx-md-5 shadow-5-strong" style="
            margin-top: -100px;
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);
            ">
        <div class="card-body py-5 px-md-5">

          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <h2 class="fw-bold mb-5">  <i class="fa-solid fa-calendar-plus" style="margin-right: 8px;"></i>  حجز موعد <i class="fa-solid fa-calendar-plus"></i></h2>
                <form class="form-floating" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <!-- Name input -->
                <div class="form-floating mb-4">
                  <input type="text"  pattern="[a-zA-Zء-ي'-'\s]*"  id="floatingInput" class="form-control" name="fullName" value="<?php if (isset($fullName)) {echo $fullName;} ?>" placeholder="s" required>
                  <label for="floatingInput">الاسم الكامل <i class="fa-solid fa-user"></i></label>
                </div>
                <!-- address input -->
                <div class="form-floating mb-4">
                  <input type="text" id="form3Example3" class="form-control" name="address" value="<?php if (isset($address)) {echo $address;} ?>" placeholder="العنوان" required>
                  <label for="form3Example3">العنوان <i class="fa-solid fa-location-dot"></i></label>
                </div>
                <!-- phone input -->
                <div class="form-floating mb-4">
                  <input type="number" id="title" class="form-control" name="mobile" value="<?php if (isset($mobile)) {echo $mobile;} ?>" placeholder="رقم الجوال" required style="direction: rtl;">
                  <label for="title">رقم الجوال <i class="fa-solid fa-phone"></i></label>
                </div>
                <!-- Date input -->
                <div class="form-outline mb-4">
                  <input type='date' id="form3Example4" class="form-control" name="orderDate"  min="<?= date("Y-m-d");?>" placeholder="تاريخ الحجز المراد" required>
                </div>
                <!-- HOSPITAL input -->
                <div class="form-floating mb-4">
                  <select class="form-select col" aria-label="Floating label select example" id="framework" name="specialtyCat" required>
                    <option disabled selected>افتح قائمه العيادات</option>
                    <?php
                    $query = "SELECT categoryName FROM categories";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)):
                    ?>
                        <option><?php echo $row['categoryName']; ?></option>
                    <?php
                    endwhile;

                    ?>
                  </select>
                  <label for="floatingSelect">العيادة المراد الحجز بها <i class="fa-solid fa-hospital"></i></label>
                </div>
                <!-- Doctor input -->
                <div class="form-floating mb-4" id="DOCTOR" >
                  <select  class="form-select col" name="doctorname" aria-label="Default select example"   required>
                    <option disabled selected>افتح قائمه الاطباء</option>
                    <?php
                    $query = "SELECT doctorName FROM doctors";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option><?php echo $row['doctorName']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                  <label for="floatingSelect">اختار الطبيب <i class="fa-solid fa-user-doctor"></i></label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" name="log">
                  ارسال <i class="fa-solid fa-paper-plane"></i>
                </button>
                <div class="">
                  <a  class="btn btn-primary" href="../index.php"> الرجوع للرئيسيه<i class="fa-solid fa-house" style="margin: 0;"></i></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Design Block -->

    <script src="./js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

      </body>
    </html>
    <?php
    include 'include/footer.php';
    }
    ?>
