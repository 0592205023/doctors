<?php
include 'layout/include/header.php';
?>
<script src="./layout/js/c.js" charset="utf-8"></script>
<div id="errors"style="position: fixed;bottom: 44px;width: 100%;z-index: 1;right: 16px;"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h2 class="text-center py-2"> تواصل معنا </h2>
                    <hr>
                    <?php
                    $Msg = "";
                    if(isset($_GET['error']))
                    {
                        $Msg = " الرجاء ملئ الحقول ادناه ";
                    }

                    if(isset($_GET['success']))
                    {
                        $Msg = " تم إرسال الرسالة بنجاح ";
                    }
                     if(!empty($Msg)){
                        echo '<script type="text/javascript">start("'.$Msg.'");</script>';
                 }
                 ?>
                </div>
                <div class="card-body">
                    <form action="process.php" method="post">
                        <input type="text" name="UName" placeholder="اسمك" class="form-control mb-2"required>
                        <input type="email" name="Email" placeholder="بريدك الإلكتروني" class="form-control mb-2"required>
                        <input type="text" name="Subject" placeholder="الموضوع" class="form-control mb-2"required>
                        <textarea name="msg" class="form-control mb-2" placeholder="الرسالة"required></textarea>
                        <button class="btn btn-success " name="btn-send"> إرسال </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'layout/include/footer.php';
?>
