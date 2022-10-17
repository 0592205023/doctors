<?php
session_start();
include 'include/connection.php';
// check if session isset



    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>تسجيل الدخول</title>
        <!-- Bootstrap and Bootstrap Rtl -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-rtl.css">
        <!-- Custom css -->
        <link rel="stylesheet" href="css/dashboard.css">

        <style>

            body {
            background-image: url('images/tr.jpg');
            background-repeat: no-repeat;
            background-size: 100% 120%;
           
        
             }
            .login{
                width: 300px;
                margin: 80px auto;
                font-family: janna lt;
                color: #555;
                font-size: 20px;
                
            }
            .login h5{
                color: #555;
                margin-bottom: 30px;
                margin-top: 10px;
                text-align: center;
            }
            .login button{
                margin-right: 80px;
                padding: 5px;
                width: 140px;
                background: #00b593;
                border: 1px solid #00b593;
                color: #1F052E;
            }
        </style>

    </head>

<body>

        <!-- Log to dashboard  -->


        <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $userName = $_POST['userName'];
      $userNum  = $_POST['userNum'];
      $userEmail = $_POST['userEmail'];
      $userPass = $_POST['userPass'];

      if (empty($userName) || empty($userEmail)  || empty($userPass)) {
          $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
      }
      else {


          $query = "INSERT INTO users(userName,userNum,userEmail,userPass)
            VALUES('$userName','$userNum','$userEmail','$userPass')";
          $res = mysqli_query($con, $query);
          if (isset($res)) {
              $success = "<div class='alert alert-success'>" . "تم التسجيل بنجاح" . "</div>";
          }
      }
  }
  ?>

  <div class="container-fluid">
      <!-- Start new post -->
      <div class="new-book" ">
          <?php
          if (isset($error)) {
              echo $error;
          } elseif (isset($success)) {
              echo $success;
          }

          ?>
          <div class="login" >
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="title">الاســـم</label>
                  <input type="text" id="title" class="form-control" name="userName" value="<?php if (isset($userName)) {
                      echo $userName;
                  } ?>">
              </div>
              <div class="form-group">
              <label for="title">الــهاتف</label>
              <input type="text" id="title" class="form-control" name="userNum" value="<?php if (isset($userNum)) {
                  echo $userNum;
              } ?>">
              </div>
              <div class="form-group">
                  <label for="title">الايــميل</label>
                  <input type="email" id="title" class="form-control" name="userEmail" value="<?php if (isset($userEmail)) {
                      echo $userEmail;
                  } ?>">
              </div>
              <div class="form-group">
                  <label for="title">كـلمة الــسر</label>
                  <input type="password" id="title" class="form-control" name="userPass" value="<?php if (isset($userPass)) {
                      echo $userPass;
                  } ?>">
              </div>


              <button class="custom-btn" name="log">تسجيل مستخدم جديد</button>
          </form>
      </div>
      <!-- End new pots -->
  </div>
  <!-- /#page-content-wrapper -->
    <?php  if(isset($_POST['log'])){

      header('Location:../index.php');
      }
      ?>
    <!-- /#wrapper -->
  <?php
  include 'include/footer.php';
  ?>
