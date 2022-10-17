<?php

if(isset($_POST['btn-send']))
{
    $UserName = $_POST['UName'];
    $Email = $_POST['Email'];
    $Subject = $_POST['Subject'];
    $Msg = $_POST['msg'];

    if(empty($UserName) || empty($Email) || empty($Subject) || empty($Msg))
    {
        header('location:callus.php?error');
    }
    else
    {

            header("location:callus.php?success");

    }
}
else
{
    header("location:callus.php");
}
?>
