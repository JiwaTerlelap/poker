<?php
$modulid = "MsDeposit";
require_once "../includes/validuser.php";
$titlepage = "Master Deposit";

$addquery = "";
$keyword = "";
$addurl = "";
if (isset($_GET['keyword']))
{
    $keyword = antiinjection($_GET['keyword']);
    if ($keyword != "")
    {
        $addquery = "AND (mbr_hp LIKE '%$keyword%' OR mbr_namarek LIKE '%$keyword%' OR mbr_norek LIKE '%$keyword%' OR mbr_gameid LIKE '%$keyword%')";
        $addurl = "keyword=$keyword";
    }
}

if (isset($_POST['saveproses']))
{
    $email = antiinjection($_POST['email']);
    $hp = antiinjection($_POST['hp']);
    $bank = antiinjection($_POST['bank']);
    $namabank = antiinjection($_POST['namabank']);
    $nomorrek = antiinjection($_POST['nomorrek']);
    $permainan = antiinjection($_POST['permainan']);
    $idgames = antiinjection($_POST['idgames']);
    $passgames = antiinjection($_POST['passgames']);
    
    $cek = mysqli_query(fOpenConn(), "SELECT mbr_id FROM msmember WHERE mbr_games = '$permainan' AND mbr_norek = '$nomorrek' AND (mbr_status = 'Baru' OR  mbr_status = 'Setuju')");
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
        mysqli_query(fOpenConn(), "INSERT INTO msmember (mbr_nama, mbr_email, mbr_hp, mbr_games, mbr_namabank, mbr_namarek, mbr_norek, mbr_status, mbr_ip, mbr_gameid, mbr_gamepass, mbr_createtm, mbr_handleby) VALUES ('$namabank', '$email', '$hp', '$permainan', '$bank', '$namabank', '$nomorrek', 'Setuju', 'Admin', '$idgames', '$passgames', now(), '$fix_username')");
        ?>
        <script>
            alert("Success ::: Add Member");
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
    <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-list"></i> List Deposit Baru</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Games</th>
                                <th>HP</th>
                                <th>Nama & Rek</th>
                                <th>Waktu</th>
                                <th>Jumlah Depo</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msdepo, msgames WHERE mbr_games = gm_id AND dpo_status = 'Baru' AND dpo_member = mbr_id ORDER BY dpo_createtm");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $createtm = date("d-m-y H:i", strtotime($rs1->mbr_createtm));
                            echo "<tr><td><a style='text-decoration: none;' href='msdeposit_detail.php?id=$rs1->mbr_id'>$rs1->mbr_gameid ( $rs1->gm_nama )</a></td>";
                            echo "<td>$rs1->mbr_hp</td>";
                            echo "<td>$rs1->mbr_namabank - $rs1->mbr_namarek ( $rs1->mbr_norek )</td>";
                            echo "<td>$createtm</td>";
                            echo "<td>$rs1->dpo_jumlah</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!--/span-->

</div><!--/row-->

<!--
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Member</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" maxlength="120" class="form-control wajibinput" id="email" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="hp" name="hp" placeholder="Handphone" value="<?php if (isset($hp)) echo $hp; ?>">
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
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
-->
<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msdepo, msgames WHERE mbr_games = gm_id AND dpo_status = 'Setuju' AND dpo_member = mbr_id  $addquery");
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
    <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-list"></i> List Deposit</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Games</th>
                                <th>HP</th>
                                <th>Nama & Rek</th>
                                <th>Waktu</th>
                                <th>Jumlah Depo</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msdepo, msgames WHERE mbr_games = gm_id AND dpo_status = 'Setuju' AND dpo_member = mbr_id ORDER BY dpo_createtm");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $createtm = date("d-m-y H:i", strtotime($rs1->mbr_createtm));
                            echo "<tr><td>$rs1->mbr_gameid ( $rs1->gm_nama )</td>";
                            echo "<td>$rs1->mbr_hp</td>";
                            echo "<td>$rs1->mbr_namabank - $rs1->mbr_namarek ( $rs1->mbr_norek )</td>";
                            echo "<td>$createtm</td>";
                            echo "<td>$rs1->dpo_jumlah</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div><!--/row-->

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>