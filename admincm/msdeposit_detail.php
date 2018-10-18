<?php
$modulid = "MsMember";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msdepo, msgames WHERE mbr_games = gm_id AND dpo_status = 'Baru' AND dpo_member = mbr_id AND dpo_id = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Deposit Baru Detail";
if (isset($_POST['saveproses']))
{
    
        mysqli_query(fOpenConn(), "UPDATE msdepo SET dpo_status = 'Setuju', dpo_handleby = '$fix_username' WHERE dpo_id = '$id'");
        ?>
        <script>
            alert("Success ::: Confirm Deposit Baru");
            location.href = "msdeposit.php";
        </script>
        <?php
    
}

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
$games = $rs1->mbr_games;
$bank = $rs1->mbr_namabank;
$namarek = $rs1->mbr_namarek;
$norek = $rs1->mbr_norek;
$ip = $rs1->mbr_ip;
$idgames = $rs1->mbr_gameid;
$deposit = $rs1->dpo_jumlah;
$ipdepo = $rs1->dpo_ip;
?>
<div class="row">
    <div class="box col-md-8">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Detail Deposit Baru</h2>
              
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
                      <label class="control-label col-sm-3" for="email">ID Permainan :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $idgames; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">Jumlah Deposit :</label>
                      <div class="control-label1 col-sm-9">
                        Rp. <?php echo $deposit; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="email">IP Deposit :</label>
                      <div class="control-label1 col-sm-9">
                        <?php echo $ipdepo; ?>
                      </div>
                    </div>
                    <div class="form-group">        
                      <div class="control-label1 col-sm-offset-3 col-sm-9">
                        <button type="submit" name="saveproses" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                    <div class="form-group">        
                      <div class="control-label col-sm-offset-3 col-sm-9">
                        <a href="" onclick="if(!confirm('Apakah Anda Yakin Tolak Member Baru ?')) { return false; }"><button type="button" name="saveproses" class="btn btn-warning">Tolak</button></a>
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