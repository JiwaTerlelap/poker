<?php
require_once "../includes/validuser.php";
$titlepage = "Change Password";
if (isset($_POST['saveproses']))
{
    $currentpassword = antiinjection($_POST['currentpassword']);
    $newpassword = antiinjection($_POST['newpassword']);
    $retypepassword = antiinjection($_POST['retypepassword']);
        
    if (empty($currentpassword) || empty($newpassword) || empty($retypepassword)) 
    {
        header("location:");
    }
    else if ($currentpassword != $fix_userpw)
    {
        ?>
        <script>
            alert("Please Check Your Current Password");
        </script>
        <?php
    }
    else if ($newpassword != $retypepassword)
    {
        ?>
        <script>
            alert("Please Check Your New Password and Retype Password");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msuser SET userpassword = '$newpassword' WHERE userid = '$fix_primaryid'");
        header("location:");
    }
}

require_once '../includes/htmltop.php';
?>    
</head>

<body>
    <!-- topbar starts -->
    <?php
    require_once '../includes/topbar.php';
    require_once '../includes/menu.php';
    require_once '../includes/notif.php';
    ?>
    <!-- topbar ends -->



<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Change Password</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="currentpassword">Current Password</label>
                        <input type="text" class="form-control wajibinput" id="currentpassword" name="currentpassword" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <label for="newpassword">New Password</label>
                        <input type="text" class="form-control wajibinput" id="newpassword" name="newpassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="newpassword">Retype Password</label>
                        <input type="text" class="form-control wajibinput" id="retypepassword" name="retypepassword" placeholder="Retype Password">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>