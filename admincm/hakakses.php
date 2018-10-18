<?php
require_once "../includes/validuser.php";
$titlepage = "Hak Akses";
$modulid = "HakAkses";

$userid = "";
if (isset($_GET['userid']))
    $userid = antiinjection($_GET['userid']);


if (isset($_POST['saveproses']))
{
    $qr0 = mysqli_query(fOpenConn(), "SELECT mdl_id FROM msmodul");
    while ($rs0 = mysqli_fetch_object($qr0))
    {
        $userhak_akses = 0;
        if (isset($_POST[$rs0->mdl_id.'access']))
        {
            $userhak_akses = 1;
        }
        
        $cekhak = mysqli_query(fOpenConn(), "SELECT hak_modul FROM mshak WHERE hak_modul = '$rs0->mdl_id' AND hak_user = '$userid'");
        if (mysqli_num_rows($cekhak) == 0)
            mysqli_query(fOpenConn(), "INSERT INTO mshak (hak_modul, hak_user, hak_akses) VALUES ('$rs0->mdl_id', '$userid', $userhak_akses)");
        else
            mysqli_query(fOpenConn(), "UPDATE mshak SET hak_akses = $userhak_akses WHERE hak_modul = '$rs0->mdl_id' AND hak_user = '$userid'");
    }
    ?>
    <script>
        alert("Success ::: Update Hak Akses");
        location.href = "";
    </script>
    <?php
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
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-globe"></i> Hak Akses</h2>
            </div>
            <div class="box-content">
                <div class="form-group">
                    <label for="userid">Nama User : </label>
                    <select class="form-control wajibinput" id="userid" name="userid" style="width: 250px; display: inline-block;" onchange="location.href = '?userid='+this.value;">
                        <option value=""> - ? - </option>
                        <?php
                        $qr0 = mysqli_query(fOpenConn(), "SELECT userid, usernickname FROM msuser WHERE useractive = 'a'");
                        while ($rs0 = mysqli_fetch_object($qr0))
                        {
                            if ($rs0->userid == $userid)
                                echo "<option selected value='$rs0->userid'>$rs0->usernickname</option>";
                            else
                                echo "<option value='$rs0->userid'>$rs0->usernickname</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php 
                if (!empty($userid))
                {
                $qr0 =  mysqli_query(fOpenConn(), "SELECT usernickname FROM  msuser WHERE userid = '$userid' LIMIT 1");
                $rs0 = mysqli_fetch_object($qr0);
                echo "<h3 align='center'>$rs0->usernickname</h3>";
                ?>
                <form method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Modul</th>
                                <th style="text-align: center;">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmodul ORDER BY mdl_group, mdl_urut");
                            while ($rs1 = mysqli_fetch_object($qr1))
                            {
                            ?>
                            <tr>
                                <td>&nbsp; <?php print $rs1->mdl_name; ?></td>
                                <td align="center">
                                                <?php
                                    $qr0 = mysqli_query(fOpenConn(), "SELECT hak_modul FROM mshak WHERE hak_modul = '$rs1->mdl_id' AND hak_user = '$userid' AND hak_akses  = 1");
                                    ?>
                                    <input type="checkbox" <?php if (mysqli_num_rows($qr0) == 1) print "checked"; ?>  name="<?php print $rs1->mdl_id."access"; ?>" />
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <p align="right"><button type="submit" name="saveproses" class="btn btn-primary">Submit</button></p>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../includes/footer.php';
?>