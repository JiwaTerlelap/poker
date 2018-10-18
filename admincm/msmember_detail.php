<?php
$modulid = "MsMember";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msgames WHERE mbr_games = gm_id AND mbr_id = '$id' AND mbr_status = 'Baru'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Member Baru Detail";
if (isset($_POST['saveproses']))
{
    $idgames = antiinjection($_POST['idgames']);
    $passgames = antiinjection($_POST['passgames']);
    if (empty($passgames) || empty($passgames)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msmember SET mbr_gameid = '$idgames', mbr_gamepass = '$passgames', mbr_status = 'Setuju', mbr_updatetm = now(), mbr_handleby = '$fix_username', mbr_updateby = '$fix_username' WHERE mbr_id = '$id'");

        $email_message = "Yth " .$rs1->mbr_namarek;
        $email_message .= "<br><br>Terima kasih telah mendaftar di BandarBola855";
        $email_message .= "<br>Berikut kami informasi UserID dan Password Anda untuk permainan ( <b>".$rs1->gm_nama."</b> ) : ";
        $email_message .= "<br> - Link Login : <a href='".$rs1->gm_link."'>".$rs1->gm_link."</a>";
        $email_message .= "<br> - User ID : <b>".$idgames."</b>";
        $email_message .= "<br> - Password : <b>".$passgames."</b>";
        $email_message .= "<br><br>Selamat Bermain.";

        $toaddress = $rs1->mbr_email;
        $subject = "Pendaftaran BandarBola855";
        $mailcontentmessage = $email_message;

        mail_email($toaddress, $subject, $mailcontentmessage);
        ?>
        <script>
            alert("Success ::: Confirm Member Baru");
            location.href = "msmember_update.php?id=<?php echo $id; ?>";
        </script>
        <?php
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == "tolak")
{
  mysqli_query(fOpenConn(), "UPDATE msmember SET mbr_status = 'Tolak', mbr_updatetm = now(), mbr_handleby = '$fix_username', mbr_updateby = '$fix_username' WHERE mbr_id = '$id'");
  ?>
        <script>
            alert("Success ::: Tolak Member Baru");
            location.href = "msmember.php";
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
                <h2><i class="glyphicon glyphicon-edit"></i> Detail Member Baru</h2>
              
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
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="idgames">ID Permainan :</label>
                      <div class="control-label1 col-sm-9">
                        <input type="text" maxlength="120" class="form-control wajibinput" id="idgames" name="idgames" placeholder="ID Permainan" value="<?php if (isset($idgames)) echo $idgames; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="passgames">Pass Permainan :</label>
                      <div class="control-label1 col-sm-9">
                        <input type="text" maxlength="120" class="form-control wajibinput" id="passgames" name="passgames" placeholder="Password Permainan" value="<?php if (isset($passgames)) echo $passgames; ?>">
                      </div>
                    </div>
                    <div class="form-group">        
                      <div class="control-label1 col-sm-offset-3 col-sm-9">
                        <button type="submit" name="saveproses" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                    <div class="form-group">        
                      <div class="control-label col-sm-offset-3 col-sm-9">
                        <a onclick="if(!confirm('Apakah Anda Yakin Tolak Member Baru ?')) { return false; }" href="msmember_detail.php?id=<?php echo $id; ?>&proses=tolak"><button type="button" name="saveproses" class="btn btn-warning">Tolak</button></a>
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