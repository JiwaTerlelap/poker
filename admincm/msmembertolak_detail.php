<?php
$modulid = "MemberTolak";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msgames WHERE mbr_games = gm_id AND mbr_id = '$id' AND mbr_status = 'Tolak'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Member Tolak Detail";

require_once '../includes/htmltop.php';
?>
<style type="text/css">
.control-label {
    text-align: right;
    margin-bottom: 0;
    padding-top: 9px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.control-label1 {
    margin-bottom: 0;
    padding-top: 9px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
</style>
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
$createtm = date("Y-m-d H:i", strtotime($rs1->mbr_createtm));
$email = $rs1->mbr_email;
$hp = $rs1->mbr_hp;
$games = $rs1->gm_nama;
$bank = $rs1->mbr_namabank;
$namarek = $rs1->mbr_namarek;
$norek = $rs1->mbr_norek;
$ip = $rs1->mbr_ip;
?>
<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detail Member Tolak</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post" style="overflow: hidden;">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Email :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $email; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Handphone :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $hp; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Bank :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $bank; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Nama Rekening :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $namarek; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Nomor Rekening :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $norek; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">IP Address :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $ip; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Waktu :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $createtm; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="idgames">Permainan :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $games; ?>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>