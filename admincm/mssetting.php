<?php
$modulid = "Setting";
require_once "../includes/validuser.php";
$titlepage = "Master Setting";

$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM mssetting");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}

if (isset($_POST['saveproses']))
{
    $namaweb = antiinjection($_POST['namaweb']);
    $sitetitle = antiinjection($_POST['sitetitle']);
    $deskripsi = antiinjection($_POST['deskripsi']);
    $keyword = antiinjection($_POST['keyword']);
    $runningtext = antiinjection($_POST['runningtext']);
    $livechat = antiinjection($_POST['livechat']);
    $bbm = antiinjection($_POST['bbm']);
    $yahoo = antiinjection($_POST['yahoo']);
    $line = antiinjection($_POST['line']);
    $whatsapp = antiinjection($_POST['whatsapp']);
    $instagram = antiinjection($_POST['instagram']);
    $facebook = antiinjection($_POST['facebook']);

   if (empty($namaweb) || empty($sitetitle) || empty($deskripsi) || empty($keyword) || empty($runningtext) || empty($livechat) || empty($bbm) || empty($yahoo) || empty($line) || empty($whatsapp) || empty($instagram) || empty($facebook)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE mssetting SET set_namaweb = '$namaweb', set_sitetitle = '$sitetitle', set_deskripsi = '$deskripsi', set_keyword = '$keyword', set_runningtext = '$runningtext', set_livechat = '$livechat', set_bbm = '$bbm', set_yahoo = '$yahoo', set_line = '$line', set_whatsapp = '$whatsapp', set_instagram = '$instagram', set_facebook = '$facebook'");
        ?>
        <script>
            alert("Success ::: Update Setting");
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
$namaweb = $rs1->set_namaweb;
$sitetitle = $rs1->set_sitetitle;
$deskripsi = $rs1->set_deskripsi;
$keyword = $rs1->set_keyword;
$runningtext = $rs1->set_runningtext;
$livechat = $rs1->set_livechat;
$bbm = $rs1->set_bbm;
$yahoo = $rs1->set_yahoo;
$line = $rs1->set_line;
$whatsapp = $rs1->set_whatsapp;
$instagram = $rs1->set_instagram;
$facebook = $rs1->set_facebook;
?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-cog"></i> Setting</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="namaweb">Nama Web</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="namaweb" name="namaweb" placeholder="Nama Web" value="<?php if (isset($namaweb)) echo $namaweb; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sitetitle">Site Title</label>
                        <input type="text" maxlength="200" class="form-control wajibinput" id="sitetitle" name="sitetitle" placeholder="Site Title" value="<?php if (isset($sitetitle)) echo $sitetitle; ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" maxlength="200" class="form-control wajibinput" id="deskripsi" name="deskripsi" placeholder="Deskripsi" value="<?php if (isset($deskripsi)) echo $deskripsi; ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyword">Key Word</label>
                        <input type="text" maxlength="200" class="form-control wajibinput" id="keyword" name="keyword" placeholder="Key Word" value="<?php if (isset($keyword)) echo $keyword; ?>">
                    </div>
                    <div class="form-group">
                        <label for="runningtext">Running Text</label>
                        <input type="text" maxlength="500" class="form-control wajibinput" id="runningtext" name="runningtext" placeholder="Running Text" value="<?php if (isset($runningtext)) echo $runningtext; ?>">
                    </div>
                    <div class="form-group">
                        <label for="livechat">Live Chat</label>
                        <textarea class="form-control wajibinput" id="livechat" name="livechat"><?php if (isset($livechat)) echo $livechat; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bbm">BBM</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="bbm" name="bbm" placeholder="BBM" value="<?php if (isset($bbm)) echo $bbm; ?>">
                    </div>
                    <div class="form-group">
                        <label for="yahoo">Phone</label>
                        <input type="text" maxlength="20" class="form-control wajibinput" id="yahoo" name="yahoo" placeholder="Phone" value="<?php if (isset($yahoo)) echo $yahoo; ?>">
                    </div>
                    <div class="form-group">
                        <label for="line">Line</label>
                        <input type="text" maxlength="20" class="form-control wajibinput" id="line" name="line" placeholder="Line" value="<?php if (isset($line)) echo $line; ?>">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="<?php if (isset($whatsapp)) echo $whatsapp; ?>">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="instagram" name="instagram" placeholder="Instagram" value="<?php if (isset($instagram)) echo $instagram; ?>">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="facebook" name="facebook" placeholder="Facebook" value="<?php if (isset($facebook)) echo $facebook; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../includes/footer.php';
?>