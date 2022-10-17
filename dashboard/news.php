<?php
session_start();
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
    exit;
} else {
  include 'include/connection.php';
  include 'include/header.php';
  if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "DELETE FROM news WHERE id = '$id'";
      $delete = mysqli_query($con, $query);
  }

  if (isset($_POST['add'])) {
    $newstext = $_POST['newstext'];
    $newsdate = $_POST['newsdate'];
    $query = "INSERT INTO `news`(`message`, `date`) VALUES ('$newstext','$newsdate')";
    $res = mysqli_query($con, $query);
  }
  if (isset($_POST['update'])) {
    $newstext = $_POST['newstext1'];
    $newsdate = $_POST['newsdate2'];
    $id = $_POST['idnews'];
    $query = "UPDATE `news` SET `message`='$newstext',`date`='$newsdate' WHERE id = $id";
    $res = mysqli_query($con, $query);
  }
    ?>
    <link rel="stylesheet" href="./css/b.rtl.css?ver=22">
    <div class="container-fluid">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">add news</button>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">اضافه خبر</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="form-floating mb-4">
                  <textarea name="newstext" class="form-control" rows="8" cols="80"required></textarea>
                  <label for="form3Example3">الخبر</label>
                </div>
                <div class="form-floating mb-4">
                  <input type="date" class="form-control" name="newsdate" value="" min="<?= date("Y-m-d");?>" required>
                  <label for="form3Example3">التاريخ</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4" name="add">
                  ارسال <i class="fa-solid fa-paper-plane"></i>
                </button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateleabel">تعديل على خبر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                  <input type="hidden" id="idnews" name="idnews" value="">
                  <div class="form-floating mb-4">
                    <textarea name="newstext1" class="form-control" id="textnews" rows="8" cols="80"required></textarea>
                    <label for="form3Example3">الخبر</label>
                  </div>
                  <div class="form-floating mb-4">
                    <input type="date" class="form-control" name="newsdate2" id="datenews" value="" min="<?= date("Y-m-d");?>" required>
                    <label for="form3Example3">التاريخ</label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block mb-4" name="update">
                    ارسال <i class="fa-solid fa-paper-plane"></i>
                  </button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
      <div class="categories">
          <div class="show-cat">
              <table class="table">
                  <thead class="thead-dark">
                  <tr>
                      <th scope="col">الرقم</th>
                      <th scope="col">الخبر</th>
                      <th scope="col">تاريخ</th>
                      <th scope="col">حذف</th>
                      <th scope="col">تعديل</th>
                  </tr>
                  </thead>
                  <tbody id="additem">
                  <?php
                  if (isset($_GET['page'])) {$page = $_GET['page'];} else {$page = 1;}
                  $limit = 8;
                  $start = ($page - 1) * $limit;
                  $query = "SELECT * FROM news ORDER BY id LIMIT $start, $limit";

                  $res = mysqli_query($con, $query);
                  $sNo = 0;

                  while ($row = mysqli_fetch_assoc($res)) {
                      $sNo++;
                      ?>

                      <tr class="items">
                          <td><?php echo $sNo; ?></td>
                          <td id="s<?php echo $row['id']; ?>"><?php echo $row['message']; ?></td>
                          <td><?php echo $row['date']; ?></td>
                          <td>
                            <a href="./news.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">حذف الطلب</a>

                          </td>
                          <td>
                            <button type="button" name="button" class="btn btn-primary" onclick="update('<?php echo $row['id']; ?>','<?php echo $row['date']; ?>')">تعديل</button>
                          </td>
                      </tr>
                      <?php
                  }
                  ?>
                  </tbody>
              </table>
              <!-- Start pagination -->
              <?php
              $query = "SELECT * FROM news";
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
    </div>
    <script type="text/javascript">
    function update(id,date) {
      var s =  $("#s"+id).text();

      $("#idnews").val(id);
      $("#datenews").val(date);
      $("#textnews").val(s);
     $('#update').modal('show');
    }
    </script>
    <?php
    include 'include/footer.php';
  }

  ?>
