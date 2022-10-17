<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
    exit;
} else {
  $arrayName = array();
  $arrayName['categoriesid'][1] = 's';

if (isset($_POST['update_doctors'])) {
    $data = array();
    $catG =$_POST['categories'];
    $day =$_POST['day'];
    
    $doctorName = $_POST['doctorName1'];
    $query = "SELECT * FROM `doctors_date` WHERE categories ='$catG' AND day ='$day'";
    $result1 = mysqli_query($con, $query);
    if(mysqli_num_rows($result1) > 0){
      $query = "UPDATE `doctors_date` SET `doctorname`='$doctorName' WHERE  categories ='$catG' AND day ='$day'";
      $result = mysqli_query($con, $query);
      if ($result) {
        ?>
        <script type="text/javascript">
          update_doctors('<?php echo $catG; ?>');
        </script>
        
                <?php
      }
    }else {
      $query = "INSERT INTO `doctors_date`(`categories`, `doctorname`, `day`) VALUES ('$catG','$doctorName','$day')";
      $result = mysqli_query($con, $query);
      if ($result) {
        ?>
        <script type="text/javascript">
            update_doctors('<?php echo $catG; ?>');
        </script>
        <?php
      }
    }

}


    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">اضافه موعد</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <input type="hidden" name="categories" value="" id="catG">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="1" required>
                  <label class="form-check-label" for="flexRadioDefault1">الاحد</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="2"required>
                  <label class="form-check-label" for="flexRadioDefault1">الاثنين</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="3"required>
                  <label class="form-check-label" for="flexRadioDefault1">الثلاثاء</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="4"required>
                  <label class="form-check-label" for="flexRadioDefault1">الاربعاء</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="5"required>
                  <label class="form-check-label" for="flexRadioDefault1">الخميس</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="day" id="flexRadioDefault1" value="7"required>
                  <label class="form-check-label" for="flexRadioDefault1">السبت</label>
                </div>
              <div class="form-floating mb-4">
                <select class="form-select col" aria-label="Floating label select example" id="framework2" name="doctorName1" required>
                  <option disabled selected>اختار طيبب</option>
                  <option value="">لا احد</option>
                </select>
                <label for="floatingSelect">العيادة المراد الحجز بها <i class="fa-solid fa-hospital"></i></label>
              </div>
              <button type="submit" class="btn btn-primary btn-block mb-4" name="update_doctors">
                ارسال <i class="fa-solid fa-paper-plane"></i>
              </button>
            </form>
          </div>
          </div>
        </div>
      </div>
    <div class="container-fluid">
        <!-- Start categories section -->
        <div class="categories">
            <div class="show-cat">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">العيادة</th>
                        <th scope="col">السبت</th>
                        <th scope="col">الاحد</th>
                        <th scope="col">الاثنين</th>
                        <th scope="col">الثلاثاء</th>
                        <th scope="col">الاربعاء</th>
                        <th scope="col">الخميس</th>
                        <th scope="col">تعديل</th>
                      </tr>
                    </thead>
                    <tbody id="additem">
                    <!-- Fetch categories from database -->
                    <?php
                      $data = array();
                    $query1 = "SELECT * FROM `categories`";
                    $query = "SELECT * FROM doctors_date ORDER BY `doctors_date`.`categories` ASC";
                    $res1 = mysqli_query($con, $query1);
                    while ($row1 = mysqli_fetch_assoc($res1)) {

                    $data[$row1['categoryName']][0]='1';
                    }
                    $res = mysqli_query($con, $query);
                    $sNo = 0;


                    while ($row = mysqli_fetch_assoc($res)) {

                        $data[$row['categories']][$row['day']]=$row['doctorname'];
                      }
                      foreach ($data as $key => $value) {
                        // code...

                        $sNo++;
                        ?>

                        <tr class="items">
                            <td><?php echo $sNo; ?></td>
                            <td><?php echo $key; ?></td>
                            <td><?php if (isset($value[7]) && !empty($value[7])){echo $value[7];}else{echo 'لايوجد' ;} ?></td>
                            <td><?php if (isset($value[1]) && !empty($value[1])){echo $value[1];}else{echo 'لايوجد' ;}?></td>
                            <td><?php if (isset($value[2]) && !empty($value[2])){echo $value[2];}else{echo 'لايوجد' ;} ?></td>
                            <td><?php if (isset($value[3]) && !empty($value[3])){echo $value[3];}else{echo 'لايوجد' ;} ?></td>
                            <td><?php if (isset($value[4]) && !empty($value[4])){echo $value[4];}else{echo 'لايوجد' ;} ?></td>
                            <td><?php if (isset($value[5]) && !empty($value[5])){echo $value[5];}else{echo 'لايوجد' ;} ?></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="update_doctors('<?php echo $key; ?>')">تعديل</button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- End categories section -->
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <script type="text/javascript">
      function update_doctors(id) {
        $("#catG").val(id);
        $.ajax({
          url: "check.php",
          type: "post",
          data: {doctors2:id} ,
          success: function (data) {
            response = JSON.parse(data);

            if(response['data']){
                for (let a = 0;  a < response['data'].length; a++) {
                  $("#framework2").append('<option class="items" value ="'+response['data'][a].doctorName+'">'+response['data'][a].doctorName+'</option>');
                }
              $('#exampleModalLabel').empty();
              $('#exampleModalLabel').append('اضافه موعد ' + id);
               $('#update').modal('show');
            }else{
              $('#exampleModalLabel').empty();
              $('#exampleModalLabel').append('اضافه موعد ' + id);
               $('#update').modal('show');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          alert("contact admin");
          }
        });


      }

    </script>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>

    <?php
}
?>
