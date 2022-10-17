<?php
$done = array();
$query= '';
if(isset($_POST['Date'])){
    if($_POST['datenew'] != ""){
        $DATENEW=$_POST['datenew'];
        $query = "SELECT * FROM orders WHERE orderDate = '$DATENEW'";
    }else{
        echo  json_encode($done['error'] ='ينقص تاريخ');
    }
}
if(isset($_POST['Hospital'])){
    if($_POST['Hospitalname'] != ""){
        $HOSPITALNAME=$_POST['Hospitalname'];
        $query = "SELECT * FROM orders WHERE postNum = '$HOSPITALNAME'";
    }else{
        echo  json_encode($done['error'] ='ينقص العياده');
    }
}
if(isset($_POST['Doctor'])){
    if($_POST['Doctorname'] != ""){
        $Doctorname=$_POST['Doctorname'];
        $query = "SELECT * FROM orders WHERE doctorname = '$Doctorname'";
    }else{
        echo  json_encode($done['error'] ='الدكتور');
    }
}


if ( $query !="") {
    include 'include/connection.php';
    $res = mysqli_query($con, $query);
    $index=0;
    if(mysqli_num_rows($res)>0){
        while ($row = mysqli_fetch_assoc($res)) {
            $done["data"][$index]['id'] = $row['id'];
            $done["data"][$index]['fullName'] = $row['fullName'];
            $done["data"][$index]['mobile'] = $row['mobile'];
            $done["data"][$index]['address'] = $row['address'];
            $done["data"][$index]['postNum'] = $row['postNum'];
            $done["data"][$index]['doctorname'] = $row['doctorname'];
            $done["data"][$index]['orderDate'] = $row['orderDate'];
            $index++;
        }
        $done['error'] ='';
    }else{
      if (isset($_POST['Hospital'])) {
        $done['error'] ='لا يوجد طلبات للعياده';
      }elseif (isset($_POST['Date'])) {
        $done['error'] ='لا يوجد مواعيد في هذا التاريخ';
      }elseif (isset($_POST['Doctor'])) {
        $done['error'] ='لا يوجد طلبات لهذا الطبيب';
      }else {
        $done['error'] ='لا يوجد مواعيد';
      }

    }
    echo json_encode($done);
}
if (isset($_POST['doctors2'])) {
    include 'include/connection.php';
  $name= $_POST['doctors2'];
  $query = "SELECT * FROM doctors WHERE categories = '$name'";
  $result = mysqli_query($con, $query);
  $index=0;
  if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)):
      $done["data"][$index]['id'] = $row['id'];
      $done["data"][$index]['doctorName'] = $row['doctorName'];
      $done["data"][$index]['categories'] = $row['categories'];
      $index++;
  endwhile;
}else{
    $done["error"]= '1';
}
  echo json_encode($done);
}
