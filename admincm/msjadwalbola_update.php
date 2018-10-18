<?php
$modulid = "JadwalBola";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msjadwalbola WHERE jdwl_id = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Jadwal Bola Update";
if (isset($_POST['saveproses']))
{
    $tanggal = antiinjection($_POST['tanggal']);
    $home = antiinjection($_POST['home']);
    $away = antiinjection($_POST['away']);
    $livetv = antiinjection($_POST['livetv']);
    if (empty($tanggal) || empty($home) || empty($away) || empty($livetv)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msjadwalbola SET jdwl_datetime = '$tanggal', jdwl_home = '$home', jdwl_away ='$away', jdwl_livetv = '$livetv' WHERE jdwl_id = '$id'");
        ?>
        <script>
            alert("Success ::: Update Jadwal Bola");
            location.href = "";
        </script>
        <?php
    }
}

require_once '../includes/htmltop.php';
?>
<link type="text/css" href="../plugin/DateTime/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="../plugin/DateTime/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../plugin/DateTime/bootstrap-datetimepicker.id.js"></script>
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
$tanggal = date("Y-m-d H:i", strtotime($rs1->jdwl_datetime));
$home = $rs1->jdwl_home;
$away = $rs1->jdwl_away;
$livetv = $rs1->jdwl_livetv;
?>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update | Hapus - Keluaran Togel</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control inputsendiri wajibinput" id="tanggal" name="tanggal" placeholder="Tanggal" value="<?php if (isset($tanggal)) echo $tanggal; ?>">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $("#tanggal").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
                        });
                    </script>
                    <div class="form-group">
                        <label for="home">Home</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="home" name="home" placeholder="Home" value="<?php if (isset($home)) echo $home; ?>">
                    </div>
                    <div class="form-group">
                        <label for="away">Away</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="away" name="away" placeholder="Away" value="<?php if (isset($away)) echo $away; ?>">
                    </div>
                    <div class="form-group">
                        <label for="livetv">Live TV</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="livetv" name="livetv" placeholder="Live TV" value="<?php if (isset($livetv)) echo $livetv; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>