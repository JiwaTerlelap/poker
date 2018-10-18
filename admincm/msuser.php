<?php
$modulid = "MsUser";
require_once "../includes/validuser.php";
$titlepage = "Master User";
if (isset($_POST['saveproses']))
{
    $userid = antiinjection($_POST['userid']);
    $namauser = antiinjection($_POST['namauser']);

    $cek = mysqli_query(fOpenConn(), "SELECT userid FROM msuser WHERE usernama = '$userid'");
        
    if (empty($userid) || empty($namauser)) 
    {
        header("location:");
    }
    else if (mysqli_num_rows($cek) > 0)
    {
        ?>
        <script>
            alert("UserID Already Exist");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "INSERT INTO msuser (usernama, userpassword, usercreateddate, useractive, usernickname)  VALUES ('$userid', 'bolabola', now(), 'a', '$namauser')");
        ?>
        <script>
            alert("Success ::: Add New User");
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

<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Master User</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="userid">User ID</label>
                        <input type="text" maxlength="30" class="form-control wajibinput" id="userid" name="userid" placeholder="User ID" value="<?php if (isset($userid)) echo $userid; ?>">
                    </div>
                    <div class="form-group">
                        <label for="namauser">Nama User</label>
                        <input type="text" maxlength="30" class="form-control wajibinput" id="namauser" name="namauser" placeholder="Nama User" value="<?php if (isset($namauser)) echo $namauser; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                    <p class="help-block">Password user yang baru ditambahkan otomatis akan di set default (bolabola) dan Jabatan akan di set Operator</p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT userid FROM msuser");
$jumlahlist = mysqli_num_rows($qr0); 
$per_hal = 50;
$jml_hal = ceil($jumlahlist/$per_hal);

if(!isset($_GET['start']))
    $start=0;
else
    $start = antiinjection($_GET['start']);
    
if (empty($start)) $start = 0;

if (!is_numeric($start))
    $start = 0;
    
if ($start > $jumlahlist) $start=0;
?>
<div class="row">
    <div class="box col-md-9">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-list"></i> List Master User</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama User</th>
                            <th>UserID</th>
                            <th>Posisi</th>
                            <th>Created</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ke = $start + 1;
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msuser ORDER BY usernickname LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $created = date("d M Y", strtotime($rs1->usercreateddate));
                            $status = "Aktif";
                            if ($rs1->useractive != 'a') $status = "Non-Aktif";
                            echo "<tr><td>$ke.</td>";
                            echo "<td><a href='msuser_detail.php?id=$rs1->userid'>$rs1->usernickname</a></td>";
                            echo "<td>$rs1->usernama</td>";
                            echo "<td>$rs1->userjabatan</td>";
                            echo "<td>$created</td>";
                            echo "<td>$status</td></tr>";
                            $ke++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    $hal_ini = $start/$per_hal;
                    $hal_ini++;
                    $start = 0;
                    ?>
                    <ul class="pagination pagination-centered">
                        <?php
                        if ($jml_hal > 1)
                        {   
                            for ($j = 1; $j <= $jml_hal; $j++) 
                            {
                                if ($j == $hal_ini) {
                                    echo "<li class='active'><a href='#'>$j</a></li>";
                                    $start+=$per_hal;
                                }
                                else
                                {
                                    echo "<li><a href='?start=$start'>$j</a></li>";
                                    $start+=$per_hal;
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <!--/span-->

</div><!--/row-->

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>