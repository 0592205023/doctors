<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
    exit;
} else {


    ?>
  <link rel="stylesheet" href="./css/bootstrap2.min.css">
    <script src="./js/jquery-3.4.1.min.js"></script>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <!-- Start Delete category -->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM orders WHERE id = '$id'";
        $delete = mysqli_query($con, $query);
    }

    ?>
    <!-- End Delete category -->



    <div class="container-fluid">
      <div><div id="errors" class="toast-container position-fixed bottom-0 end-0 p-3"></div></div>
        <!-- Start categories section -->
        <div class="categories">
            <div class="show-cat">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">الرقم</th>
                        <th scope="col">الاسم الكامل</th>
                        <th scope="col">رقم الجوال</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">العيادة</th>
                        <th scope="col">الدكتور</th>
                        <th scope="col">تاريخ الحجز /الوقت</th>
                        <th scope="col">الاجراء</th>

                    </tr>

                    <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                              <select class="custom-select" id="HOSPITALNAME">
                                <option>اختار العياده </option>
                                <?php
                                $query = "SELECT * FROM categories";
                                $res = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($res)) {

                                 ?>
                                 <option value="<?php echo $row['categoryName']; ?>"><?php echo $row['categoryName']; ?></option>
                               <?php } ?>
                              </select>
                            </td>
                            <td>
                              <select  class="custom-select" id="DoctorNAME">
                                <option>اختار الدكتور</option>
                                <?php
                                $query = "SELECT * FROM doctors";
                                $res = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($res)) {

                                 ?>
                                 <option value="<?php echo $row['doctorName']; ?>"><?php echo $row['doctorName']; ?></option>
                               <?php } ?>
                              </select>
                            </td>
                            <td><input type="date" id="checkdate" value=""></td>
                            <td>-</td>
                        </tr>
                    </thead>
                    <tbody id="additem">
                    <!-- Fetch categories from database -->
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 8;
                    $start = ($page - 1) * $limit;
                    $query = "SELECT * FROM orders ORDER BY id LIMIT $start, $limit";

                    $res = mysqli_query($con, $query);
                    $sNo = 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        $sNo++;
                        ?>

                        <tr class="items">
                            <td><?php echo $sNo; ?></td>
                            <td><?php echo $row['fullName']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['postNum']; ?></td>
                            <td><?php echo $row['doctorname']; ?></td>
                            <td><?php echo $row['orderDate']; ?></td>
                            <td>

                                <a href="order1.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">حذف الطلب</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- Start pagination -->
                <?php
                $query = "SELECT * FROM orders";
                $result = mysqli_query($con, $query);
                $total_cat = mysqli_num_rows($result);
                $total_pages = ceil($total_cat / $limit);
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination remove1">
                        <li class="page-item"><a class="page-link" href="order1.php?page=<?php if (($page - 1) > 0) {
                                echo  $page - 1;
                            } else {
                                echo 1;
                            }

                            ?>">السابق</a></li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            ?>
                            <li class="page-item"><a class="page-link" href="order1.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="order1.php?page=<?php
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
    <script src="./js/orders.js"></script>
    <script src="./js/bootstrap.5.js"></script>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>

    <?php
}
?>
