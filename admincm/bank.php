<?php
require_once "../includes/validuser.php";
$titlepage = "Bank";
$modulid = "Bank";

$userid = "";
if (isset($_GET['userid']))
    $userid = antiinjection($_GET['userid']);


if (isset($_POST['saveproses']))
{
    $namarekbca = antiinjection($_POST['namarekbca']);
    $namarekmandiri = antiinjection($_POST['namarekmandiri']);
    $namarekbni = antiinjection($_POST['namarekbni']);
    $namarekbri = antiinjection($_POST['namarekbri']);
    $namarekdanamon = antiinjection($_POST['namarekdanamon']);
    mysqli_query(fOpenConn(), "UPDATE msbank SET bank_bca = '$namarekbca', bank_mandiri = '$namarekmandiri', bank_bni = '$namarekbni', bank_bri = '$namarekbri', bank_danamon = '$namarekdanamon' WHERE bank_modul = 'nama'");

    $nomorrekbca = antiinjection($_POST['nomorrekbca']);
    $nomorrekmandiri = antiinjection($_POST['nomorrekmandiri']);
    $nomorrekbni = antiinjection($_POST['nomorrekbni']);
    $nomorrekbri = antiinjection($_POST['nomorrekbri']);
    $nomorrekdanamon = antiinjection($_POST['nomorrekdanamon']);
    mysqli_query(fOpenConn(), "UPDATE msbank SET bank_bca = '$nomorrekbca', bank_mandiri = '$nomorrekmandiri', bank_bni = '$nomorrekbni', bank_bri = '$nomorrekbri', bank_danamon = '$nomorrekdanamon' WHERE bank_modul = 'nomor'");

    $statusrekbca = antiinjection($_POST['statusrekbca']);
    $statusrekmandiri = antiinjection($_POST['statusrekmandiri']);
    $statusrekbni = antiinjection($_POST['statusrekbni']);
    $statusrekbri = antiinjection($_POST['statusrekbri']);
    $statusrekdanamon = antiinjection($_POST['statusrekdanamon']);
    mysqli_query(fOpenConn(), "UPDATE msbank SET bank_bca = '$statusrekbca', bank_mandiri = '$statusrekmandiri', bank_bni = '$statusrekbni', bank_bri = '$statusrekbri', bank_danamon = '$statusrekdanamon' WHERE bank_modul = 'status'");
    ?>
    <script>
        alert("Success ::: Update Bank");
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
<?php

$namarekbca = "";
$namarekmandiri = "";
$namarekbni = "";
$namarekbri = "";
$namarekdanamon = "";

$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msbank WHERE bank_modul = 'nama'");

if (mysqli_num_rows($qr0) > 0)
{
    $rs0 = mysqli_fetch_object($qr0);
    $namarekbca = $rs0->bank_bca;
    $namarekmandiri = $rs0->bank_mandiri;
    $namarekbni = $rs0->bank_bni;
    $namarekbri = $rs0->bank_bri;
    $namarekdanamon = $rs0->bank_danamon;
}


$nomorrekbca = "";
$nomorrekmandiri = "";
$nomorrekbni = "";
$nomorrekbri = "";
$nomorrekdanamon = "";

$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msbank WHERE bank_modul = 'nomor'");

if (mysqli_num_rows($qr0) > 0)
{
    $rs0 = mysqli_fetch_object($qr0);
    $nomorrekbca = $rs0->bank_bca;
    $nomorrekmandiri = $rs0->bank_mandiri;
    $nomorrekbni = $rs0->bank_bni;
    $nomorrekbri = $rs0->bank_bri;
    $nomorrekdanamon = $rs0->bank_danamon;
}


$statusrekbca = "";
$statusrekmandiri = "";
$statusrekbni = "";
$statusrekbri = "";
$statusrekdanamon = "";

$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msbank WHERE bank_modul = 'status'");

if (mysqli_num_rows($qr0) > 0)
{
    $rs0 = mysqli_fetch_object($qr0);
    $statusrekbca = $rs0->bank_bca;
    $statusrekmandiri = $rs0->bank_mandiri;
    $statusrekbni = $rs0->bank_bni;
    $statusrekbri = $rs0->bank_bri;
    $statusrekdanamon = $rs0->bank_danamon;
}
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-euro"></i> Hak Akses</h2>
            </div>
            <div class="box-content">
                <form method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bank</th>
                                <th>Nama Rekening</th>
                                <th>Nomor Rekening</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bank BCA</td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="namarekbca" name="namarekbca" placeholder="Nama Rek" value="<?php if (isset($namarekbca)) echo $namarekbca; ?>"></td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="nomorrekbca" name="nomorrekbca" placeholder="Nomor Rek" value="<?php if (isset($nomorrekbca)) echo $nomorrekbca; ?>"></td>
                                <td><input type="radio" <?php if ($statusrekbca == 1) print "checked"; ?>  name="statusrekbca" value="1" /> Aktif &nbsp; &nbsp; <input type="radio" <?php if ($statusrekbca == "x") print "checked"; ?>  name="statusrekbca" value="x" /> Non Aktif</td>
                            </tr>
                            <tr>
                                <td>Bank Mandiri</td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="namarekmandiri" name="namarekmandiri" placeholder="Nama Rek" value="<?php if (isset($namarekmandiri)) echo $namarekmandiri; ?>"></td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="nomorrekmandiri" name="nomorrekmandiri" placeholder="Nomor Rek" value="<?php if (isset($nomorrekmandiri)) echo $nomorrekmandiri; ?>"></td>
                                <td><input type="radio" <?php if ($statusrekmandiri == 1) print "checked"; ?>  name="statusrekmandiri" value="1" /> Aktif &nbsp; &nbsp; <input type="radio" <?php if ($statusrekmandiri == "x") print "checked"; ?>  name="statusrekmandiri" value="x" /> Non Aktif</td>
                            </tr>
                            <tr>
                                <td>Bank BNI</td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="namarekbni" name="namarekbni" placeholder="Nama Rek" value="<?php if (isset($namarekbni)) echo $namarekbni; ?>"></td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="nomorrekbni" name="nomorrekbni" placeholder="Nomor Rek" value="<?php if (isset($nomorrekbni)) echo $nomorrekbni; ?>"></td>
                                <td><input type="radio" <?php if ($statusrekbni == 1) print "checked"; ?>  name="statusrekbni" value="1" /> Aktif &nbsp; &nbsp; <input type="radio" <?php if ($statusrekbni == "x") print "checked"; ?>  name="statusrekbni" value="x" /> Non Aktif</td>
                            </tr>
                            <tr>
                                <td>Bank BRI</td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="namarekbri" name="namarekbri" placeholder="Nama Rek" value="<?php if (isset($namarekbri)) echo $namarekbri; ?>"></td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="nomorrekbri" name="nomorrekbri" placeholder="Nomor Rek" value="<?php if (isset($nomorrekbri)) echo $nomorrekbri; ?>"></td>
                                <td><input type="radio" <?php if ($statusrekbri == 1) print "checked"; ?>  name="statusrekbri" value="1" /> Aktif &nbsp; &nbsp; <input type="radio" <?php if ($statusrekbri == "x") print "checked"; ?>  name="statusrekbri" value="x" /> Non Aktif</td>
                            </tr>
                            <tr>
                                <td>Bank Danamon</td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="namarekdanamon" name="namarekdanamon" placeholder="Nama Rek" value="<?php if (isset($namarekdanamon)) echo $namarekdanamon; ?>"></td>
                                <td><input type="text" maxlength="60" class="form-control wajibinput" id="nomorrekdanamon" name="nomorrekdanamon" placeholder="Nomor Rek" value="<?php if (isset($nomorrekdanamon)) echo $nomorrekdanamon; ?>"></td>
                                <td><input type="radio" <?php if ($statusrekdanamon == 1) print "checked"; ?>  name="statusrekdanamon" value="1" /> Aktif &nbsp; &nbsp; <input type="radio" <?php if ($statusrekdanamon == "x") print "checked"; ?>  name="statusrekdanamon" value="x" /> Non Aktif</td>
                            </tr>
                        </tbody>
                    </table>
                    <p align="right"><button type="submit" name="saveproses" class="btn btn-primary">Submit</button></p>
                </form>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../includes/footer.php';
?>