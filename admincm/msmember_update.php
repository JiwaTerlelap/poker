<?php
$modulid = "MsMember";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember WHERE mbr_id = '$id' AND mbr_status = 'Setuju'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Member Detail | Update";
if (isset($_POST['saveproses']))
{
    if ($fix_userjabatan == "Master")
    {
        $email = antiinjection($_POST['email']);
        $hp = antiinjection($_POST['hp']);
    }
    else
    {
        $email = $rs1->mbr_email;
        $hp = $rs1->mbr_hp;
    }

    $bank = antiinjection($_POST['bank']);
    $namabank = antiinjection($_POST['namabank']);
    $nomorrek = antiinjection($_POST['nomorrek']);
    $permainan = antiinjection($_POST['permainan']);
    $idgames = antiinjection($_POST['idgames']);
    $passgames = antiinjection($_POST['passgames']);
    $catatan = antiinjection($_POST['catatan']);

    $cek = mysqli_query(fOpenConn(), "SELECT mbr_id FROM msmember WHERE mbr_games = '$permainan' AND mbr_norek = '$nomorrek' AND (mbr_status = 'Baru' OR  mbr_status = 'Setuju') AND mbr_id != '$id'");
    if (empty($email) || empty($hp) || empty($bank) || empty($namabank) || empty($nomorrek) || empty($permainan) || empty($idgames) || empty($passgames)) 
    {
        header("location:");
    }
    else if (mysqli_num_rows($cek) > 0)
    {
        ?>
        <script>
            alert("Nomor Rekening Sudah Terdaftar Dengan Jenis Permaninan Yang Dipilih..");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msmember SET mbr_nama = '$namabank', mbr_email = '$email', mbr_hp = '$hp', mbr_games = '$permainan', mbr_namabank = '$bank', mbr_namarek = '$namabank', mbr_norek = '$nomorrek', mbr_gameid = '$idgames', mbr_gamepass = '$passgames', mbr_catatan = '$catatan', mbr_updatetm = now(), mbr_updateby = '$fix_username' WHERE mbr_id = '$id'");
        ?>
        <script>
            alert("Success ::: Update Member");
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
if ($fix_userjabatan == "Master")
{
    $email = $rs1->mbr_email;
    $hp = $rs1->mbr_hp;
}
else
{
    $email = substr($rs1->mbr_email,0,7)."*****";
    $hp = "********".substr($rs1->mbr_hp,-4);
}
$bank = $rs1->mbr_namabank;
$namabank = $rs1->mbr_namarek;
$nomorrek = $rs1->mbr_norek;
$permainan = $rs1->mbr_games;
$idgames = $rs1->mbr_gameid;
$passgames = $rs1->mbr_gamepass;
$ip = $rs1->mbr_ip;
$catatan = $rs1->mbr_catatan;
$createtm = date("Y-m-d H:i", strtotime($rs1->mbr_createtm));
$updatetm = date("Y-m-d H:i", strtotime($rs1->mbr_updatetm));
$handleby = $rs1->mbr_handleby;
$updateby = $rs1->mbr_updateby;
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
                        <label for="email">Email</label>
                        <input type="email" maxlength="120" <?php if ($fix_userjabatan != "Master") echo "disabled"; ?> class="form-control wajibinput" id="email" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" maxlength="60"  <?php if ($fix_userjabatan != "Master") echo "disabled"; ?>  class="form-control wajibinput" id="hp" name="hp" placeholder="Handphone" value="<?php if (isset($hp)) echo $hp; ?>">
                    </div>
                    <?php
                        $banklist = array("BCA", "Mandiri", "BNI", "BRI", "Danamon");
                    ?>
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <?php if (!isset($bank)) $bank = ""; ?>
                        <select class="form-control wajibinput" id="bank" placeholder="Bank" name="bank">
                            <option value="">-- Pilih Bank --</option>
                            <?php
                            foreach ($banklist as $bankid)
                            {
                                if ($bankid == $bank)
                                    echo '<option selected value="'.$bankid.'">'.$bankid.'</option>';
                                else
                                    echo '<option value="'.$bankid.'">'.$bankid.'</option>';

                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namabank">Nama Bank</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="namabank" name="namabank" placeholder="Nama Bank" value="<?php if (isset($namabank)) echo $namabank; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nomorrek">Nomor Rek</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="nomorrek" name="nomorrek" placeholder="Nomor Rek" value="<?php if (isset($nomorrek)) echo $nomorrek; ?>">
                    </div>
                    <div class="form-group">
                        <label for="permainan">Permainan</label>
                        <?php if (!isset($permainan)) $permainan = ""; ?>
                        <select class="form-control wajibinput" id="permainan" placeholder="Permainan" name="permainan">
                            <option value="">-- Pilih Permainan --</option>
                            <?php
                            $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msgames WHERE gm_active = 'a' ORDER BY gm_nama");
                            while ($rs0 = mysqli_fetch_object($qr0))
                            {
                                if ($rs0->gm_id == $permainan)
                                    echo '<option selected value="'.$rs0->gm_id.'">'.$rs0->gm_nama.'</option>';
                                else
                                    echo '<option value="'.$rs0->gm_id.'">'.$rs0->gm_nama.'</option>';

                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idgames">ID Permainan</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="idgames" name="idgames" placeholder="ID Permainan" value="<?php if (isset($idgames)) echo $idgames; ?>">
                    </div>
                    <div class="form-group">
                        <label for="passgames">Password Permainan</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="passgames" name="passgames" placeholder="Password Permainan" value="<?php if (isset($passgames)) echo $passgames; ?>">
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan"><?php if (isset($catatan)) echo $catatan; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ip">IP</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="ip" name="ip" placeholder="IP" disabled value="<?php if (isset($ip)) echo $ip; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Disetujui">Disetujui</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="Disetujui" name="Disetujui" disabled placeholder="Disetujui" value="<?php echo $handleby." ( ".$createtm." )"; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastupdate">Last Update</label>
                        <input type="text" maxlength="120" class="form-control wajibinput" id="lastupdate" name="lastupdate" disabled placeholder="Last Update" value="<?php echo $updateby." ( ".$updatetm.")"; ?>">
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