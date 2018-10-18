<?php
$modulid = "MsUser";
require_once "../includes/validuser.php";
if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msuser WHERE userid = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Master User | Detail - Update";

if (isset($_POST['saveproses']))
{
    $namauser = antiinjection($_POST['namauser']);
    $status = antiinjection($_POST['status']);

    if ($fix_userjabatan == "Master")
        $posisi = antiinjection($_POST['posisi']);
    else
        $posisi = $rs1->userjabatan;
        
    if (empty($namauser) || empty($status) || empty($posisi)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msuser SET usernickname = '$namauser', userjabatan = '$posisi', useractive = '$status' WHERE userid = '$id'");
        ?>
        <script>
            alert("Success ::: Update User");
            location.href = "";
        </script>
        <?php
    }
}

if (isset($_POST['updatepass']) && $fix_userjabatan == "Master")
{
    $newpass = antiinjection($_POST['newpass']);
    $confirmpass = antiinjection($_POST['confirmpass']);

    if (empty($newpass) || empty($confirmpass)) 
    {
        header("location:");
    }
    else if ($newpass != $confirmpass) 
    {
        ?>
        <script>
            alert("Gagal ::: New Password dan Confirm Password Tidak Sama");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msuser SET userpassword = '$newpass' WHERE userid = '$id'");
        ?>
        <script>
            alert("Success ::: Update Password User");
            location.href = "";
        </script>
        <?php
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
<?php
$userid = $rs1->usernama;
$namauser = $rs1->usernickname;
$useractive = $rs1->useractive;
$posisi = $rs1->userjabatan;
?>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detail - Update User</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="userid">User ID</label>
                        <input type="text" maxlength="30" class="form-control wajibinput" id="userid" disabled name="userid" placeholder="User ID" value="<?php if (isset($userid)) echo $userid; ?>">
                    </div>
                    <div class="form-group">
                        <label for="namauser">Nama User</label>
                        <input type="text" maxlength="30" class="form-control wajibinput" id="namauser" name="namauser" placeholder="Nama User" value="<?php if (isset($namauser)) echo $namauser; ?>">
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <select class="form-control wajibinput" id="posisi" name="posisi" <?php if ($fix_userjabatan != "Master") echo "disabled"; ?> >
                            <option <?php if ($posisi == 'Master') echo "selected"; ?> value='Master'>Master</option>
                            <option <?php if ($posisi != 'Master') echo "selected"; ?> value='Operator'>Operator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control wajibinput" id="status" name="status">
                            <option <?php if ($useractive == 'a') echo "selected"; ?> value='a'>Active</option>
                            <option <?php if ($useractive != 'a') echo "selected"; ?> value='n'>Non-Active</option>
                        </select>
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($fix_userjabatan == "Master")
    {
    ?>
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-lock"></i> Update Password User</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="newpass">New Password</label>
                        <input type="password" maxlength="30" class="form-control wajibinput" id="newpass" name="newpass" placeholder="New Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="confirmpass">Confirm New Password</label>
                        <input type="password" maxlength="30" class="form-control wajibinput" id="confirmpass" name="confirmpass" placeholder="Confirm New Password" value="">
                    </div>
                    <button type="submit" name="updatepass" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>