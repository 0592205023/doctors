<?php
include 'layout/include/header.php';
?>

<section class="home" id="home" style="margin-top: -210px;">

<div class="container">

    <div class="row min-vh-100 align-items-center text-center text-md-left">

        <div class="col-md-6 pl-md-5 content" data-aos="fade-left">
         <h2 style="font-family: 'Cairo', sans-serif;text-align: right;margin-top: 10px;font-size: 30px;color: rgb(64 123 255);padding-right: 20px;margin-right: -30px;width: 580px;">مواعـيد العيادات التخصصية الدوام المســائي </h2>

        </div>

    </div>

</div>

</section>

<div class="container" style="margin-top: -230px;">

<table class="table" style="font-family: 'Cairo', sans-serif;">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">العيادة</th>
          <th scope="col">السبت</th>
          <th scope="col">الاحد</th>
          <th scope="col">الاثنين</th>
          <th scope="col">الثلاثاء</th>
          <th scope="col">الاربعاء</th>
          <th scope="col">الخميس</th>
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
          </tr>
          <?php
      }
      ?>
      </tbody>

</table>
</div>
<!--  footer -->
