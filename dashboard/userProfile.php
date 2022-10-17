<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if(!isset($_SESSION['userInfo'])){
    header('Location:index.php');
}
else{


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM users WHERE id = '$id'";
        $delete = mysqli_query($con, $query);
    }

    ?>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <div class="container-fluid">
        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

        if(isset($_POST['edit']))  {
            $userName = $_POST['userName'];
            $userEmail = $_POST['userEmail'];
            $userPass = $_POST['userPass'];

            $query = "UPDATE users SET
                    userName = '$userName',
                    userEmail = '$userEmail',
                    userPass = '$userPass'
                WHERE id = '1' ";
            $res = mysqli_query($con,$query);
            header("REFRESH:0");
            exit();
        }
        ?>
        <div class="profile">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" id="name" value="<?php  echo $row['userName']; ?>" name="userName">
                </div>
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="text" class="form-control" id="email"  value="<?php  echo $row['userEmail']; ?>" name="userEmail">
                </div>
                <div class="form-group">
                    <label for="pass">كلمة السر</label>
                    <input type="text" class="form-control" id="pass"  value="<?php  echo $row['userPass']; ?>" name="userPass">
                </div>
                <button class="custom-btn" name="edit">تعديل البيانات</button>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>


    <?php
}
?>