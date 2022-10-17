<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
  header('Location:index.php');
  exit;
} else {

?>

  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <!-- Start Delete doctor -->
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM doctors WHERE id = '$id'";
    $delete = mysqli_query($con, $query);
  }
  ?>
  <!-- End Delete doctor -->

  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor = $_POST['doctor'];
    $doctorsp = $_POST['specialtyCat'];
    if (empty($doctor) || empty($doctorsp)) {
      $catErro =  "<div class='alert alert-danger'>" . "الرجاء ملء الحقل أدناه" . "</div>";
    } else {
      $query = "INSERT INTO doctors(doctorName ,categories) VALUES('$doctor' , '$doctorsp')";
      $result = mysqli_query($con, $query);
      if (isset($result)) {
        $catSuccess =  "<div class='alert alert-success'>" . "تم إضافة التصنيف بنجاح" . "</div>";
      }
    }
  }

  ?>

  <div class="container-fluid">
    <!-- Start categories section -->
    <div class="categories">
      <?php
      if (isset($catErro)) {
        echo $catErro;
      }
      if (isset($catSuccess)) {
        echo $catSuccess;
      }
      ?>
      <div class="add-cat">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <label for="cat">إضافة طبيب :</label>
            <input type="text" id="cat" class="form-control" name="doctor">
          </div>
       <div class="form-group">
                    <label for="title">التخصص</label>
                    <select class="form-control" name="specialtyCat">
                        <option></option>
                        <?php
                        $query = "SELECT categoryName FROM categories";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option><?php echo $row['categoryName']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

          <button class="custom-btn">إضافة</button>
        </form>
      </div>
      <div class="show-cat">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">الرقم</th>
              <th scope="col">اسم الطبيب </th>
              <th scope="col">تخصص الطبيب</th>
              <th scope="col">الإجراء</th>
            </tr>
          </thead>
          <tbody>
            <!-- Fetch doctors from database -->
            <?php
            if (isset($_GET['page'])) {
              $page = $_GET['page'];
            } else {
              $page = 1;
            }
            $limit = 8;
            $start = ($page - 1) * $limit;
            $query = "SELECT * FROM doctors ORDER BY id DESC LIMIT $start, $limit";
            $res = mysqli_query($con, $query);
            $sNo = 0;

            while ($row = mysqli_fetch_assoc($res)) {
              $sNo++;
            ?>

              <tr>
                <td><?php echo $sNo; ?></td>
                <td><?php echo $row['doctorName']; ?></td>
                <td><?php echo $row['categories']; ?></td>
                <td>

                  <a href="doctor.php?id=<?php echo $row['id']; ?>" class="custom-btn confirm">حذف</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <!-- Start pagination -->
        <?php
        $query = "SELECT * FROM doctors";
        $result = mysqli_query($con, $query);
        $total_cat = mysqli_num_rows($result);
        $total_pages = ceil($total_cat / $limit);
        ?>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="doctor.php?page=<?php if (($page - 1) > 0) {
                                                                                    echo  $page - 1;
                                                                                  } else {
                                                                                    echo 1;
                                                                                  }

                                                                                  ?>">السابق</a></li>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
              <li class="page-item"><a class="page-link" href="doctor.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
            }
            ?>
            <li class="page-item"><a class="page-link" href="doctor.php?page=<?php
                                                                                  if (($page + 1) < $total_pages) {
                                                                                    echo $page + 1;
                                                                                  } elseif (($page + 1) >= $total_pages) {
                                                                                    echo $total_pages;
                                                                                  }
                                                                                  ?>">التالي</a></li>
          </ul>
        </nav>
        <!-- End pagination -->
      </div>
    </div>
    <!-- End categories section -->
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

