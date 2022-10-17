<?php
    session_start();
    include 'include/connection.php';
    // check if session isset
    if(isset($_SESSION['adminInfo'])){
        header('Location:dashboard.php');
    }
    else{
      if(isset($_SESSION['userInfo'])){
          header('Location:../index.php');
      }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>تسجيل الدخول</title>
<link rel="icon" type="image/png" href="../layout/images/logo1.png">
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="./css/all.min.css">
    <!-- MDB -->
    <link href="./css/mdb.rtl.min.css"  rel="stylesheet"/>
    <link rel="stylesheet" href="./css/custom.css">
</head>

<body>

<!-- Log to dashboard  -->
   <?php
    $error="";
        if(isset($_POST['login']))  {

            $adminInfo = $_POST['adminInfo'];
            $adminPass = $_POST['password'];
            $userInfo  = $_POST['adminInfo'];
            $userPass  = $_POST['password'];

            //check if inputs are not empty
            if(empty($adminInfo) || empty($adminPass)){
              $error = "الرجاء مل الحقول أدناه";
            }
            // check if values are match
            else{
                $query = "SELECT * FROM admin WHERE (adminName='$adminInfo' OR adminEmail='$adminInfo') AND adminPass='$adminPass'";
                $result = mysqli_query($con,$query);
                $row = mysqli_num_rows($result);

                if($row > 0){
                    $_SESSION['adminInfo'] = $adminInfo;
                    header('Location:dashboard.php');
                }
                else{
                    if(isset($_POST['login'])){
                        $query = "SELECT * FROM users WHERE (userName='$userInfo' OR userEmail='$userInfo') AND userPass='$userPass'";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_num_rows($result);
                        if($row > 0){
                            $_SESSION['userInfo'] = $userInfo;
                            header('Location:../index.php');
                        }
                    }
                    else{
                      $error = "البيانات غير متطابقة الرجاء المحاولة مرة أخرى";
                    }

                }
            }
        }
        if (isset($_POST['signup'])) {

          $userName = $_POST['userName'];
          $userNum  = $_POST['userNum'];
          $userEmail = $_POST['userEmail'];
          $userPass = $_POST['userPass'];

          if (empty($userName) || empty($userEmail)  || empty($userPass)) {
              $error = "الرجاء ملء الحقول أدناه";
          }
          else {


              $query = "INSERT INTO users(userName,userNum,userEmail,userPass)
                VALUES('$userName','$userNum','$userEmail','$userPass')";
              $res = mysqli_query($con, $query);
              if (isset($res)) {
                $_SESSION['userInfo'] = $userName;
                header('Location:../index.php');

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
  <section class="vh-100">
  <div class="container-fluid h-custom ">
    <div class="row d-flex justify-content-center align-items-center h-100 ok">
      <div class="col-md-9 col-lg-6 col-xl-5">

        <img src="../layout/images/draw2.png" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

          <!-- Pills navs -->
          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true">تسجيل دخول</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false">تسجيل</a>
            </li>
          </ul>
          <!-- Pills navs -->

          <!-- Pills content -->
          <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
              <!--LOGIN-->
              <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="text"  id="mail" name="adminInfo" class="form-control" />
                  <label class="form-label" for="loginName">اسم المستخدم <i class="fa-solid fa-user"></i></label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="pass" name="password" class="form-control" />
                  <label class="form-label" for="loginPassword">كلمه المرور <i class="fa-solid fa-key"></i></label>
                </div>
                <!-- Submit button -->
                <input type="submit" name="login" class="btn btn-primary btn-block mb-4" value="تسجيل دخول">

              </form>
            </div>
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
              <!--register-->
              <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                <!-- Name input -->
                <div class="form-outline mb-4">
                  <input type="text" id="registerName" class="form-control" name="userName" value="<?php if (isset($userName)) {echo $userName;} ?>">
                  <label class="form-label" for="registerName">الاسم الكامل <i class="fa-solid fa-user"></i></label>
                </div>

                <!-- Usernumber input -->
                <div class="form-outline mb-4">
                  <input type="number" id="registernumber" class="form-control"  name="userNum" value="<?php if (isset($userNum)) { echo $userNum; } ?>">
                  <label class="form-label" for="registernumber">رقم الجوال <i class="fa-solid fa-phone"></i></label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="registerEmail" class="form-control" name="userEmail" value="<?php if (isset($userEmail)) {echo $userEmail;} ?>">
                  <label class="form-label" for="registerEmail">الايميل <i class="fa-solid fa-envelope"></i></label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="registerPassword" class="form-control" name="userPass" value="<?php if (isset($userPass)) {echo $userPass;} ?>">
                  <label class="form-label" for="registerPassword">كلمه المرور <i class="fa-solid fa-key"></i></label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3" name="signup">تسجيل <i class="fa-solid fa-circle-plus"></i></button>
              </form>
            </div>
            <div class="col-12">
                    <a href="../index.php"  class="btn btn-link">الرجوع للصفحه الرئيسيه <i class="fa-solid fa-arrow-left-long"></i></a>

            </div>

          </div>
      </div>
    </div>
  </div>
</section>
<script>
  var btn = document.getElementById("btn-close");
    if(btn){
      btn.onclick = function(){
        document.getElementById("Erorr").style.display = "none";
        document.getElementById("toast").style.display = "none";
      };
    }
  var btn1 = document.getElementById("btn-close1");
      if(btn1){
        btn1.onclick = function(){
          document.getElementById("toast1").style.display = "none";
        };
      }

</script>
  <script type="text/javascript"  src="./js/mdb.min.js"></script>
  <?php
    include 'include/footer.php';
 if(isset($_POST['signup'])){
   header('Location:../index.php');
  }
?>

<?php
    }
?>
