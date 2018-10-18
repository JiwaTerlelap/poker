<?php
require_once '../includes/headpage.php';
if (isset($_POST['login']))
{
    $userid = antiinjectionmain($_POST['userid']);
    $password = antiinjectionmain($_POST['password']);
    $qr1 =  mysqli_query(fOpenConn(),"SELECT * FROM msuser WHERE usernama = '$userid' AND userpassword = '$password' AND useractive = 'a'");
    if (mysqli_num_rows($qr1) == 1)
    {
        session_start();
        $rs1 = mysqli_fetch_object($qr1);
        $_SESSION['primaryiduser_bandar855'] = $rs1->userid;
        $_SESSION['useriduser_bandar855'] = $rs1->usernama;
        $_SESSION['passworduser_bandar855'] = $rs1->userpassword;
        $_SESSION['namauser_bandar855'] = $rs1->usernickname;
        
        header("location:index.php");       
    }
    else
    {
        header("location:login.php");
    }
}

$titlepage = "Login";
require_once '../includes/htmltop.php';
?>    
</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2><img src="../images/logo.png" /></h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                <b>User Panel</b> - Please login with your Username and Password.
            </div>
            <form class="form-horizontal" action="" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="userid" placeholder="Username">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->

</body>
</html>