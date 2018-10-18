<?php
require_once "../includes/validuser.php";
$titlepage = "Master Content";
$modulid = "Content";

$contentid = "";
if (isset($_GET['contentid']))
    $contentid = antiinjection($_GET['contentid']);


if (isset($_POST['saveproses']))
{
    $isi = antiinjection($_POST['isi']);
    mysqli_query(fOpenConn(), "UPDATE mscontent SET cnt_isi = '$isi' WHERE cnt_id = '$contentid'");
    ?>
    <script>
        alert("Success ::: Update Content");
        location.href = "";
    </script>
    <?php
}


require_once '../includes/htmltop.php';
?>    
<link type="text/css" rel="stylesheet" href="../plugin/Editor/jquery-te-1.4.0.css">
<script type="text/javascript" src="../plugin/Editor/jquery-te-1.4.0.js" charset="utf-8"></script>
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
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-book"></i> Content</h2>
            </div>
            <div class="box-content">
                <div class="form-group">
                    <label for="contentid">Nama Content : </label>
                    <select class="form-control wajibinput" id="contentid" name="contentid" style="width: 250px; display: inline-block;" onchange="location.href = '?contentid='+this.value;">
                        <option value=""> - ? - </option>
                        <?php
                        $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM mscontent ORDER BY cnt_id");
                        while ($rs0 = mysqli_fetch_object($qr0))
                        {
                            if ($rs0->cnt_id == $contentid)
                                echo "<option selected value='$rs0->cnt_id'>$rs0->cnt_id</option>";
                            else
                                echo "<option value='$rs0->cnt_id'>$rs0->cnt_id</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php 
                if (!empty($contentid))
                {
                    echo "<h3 align='center'>$contentid</h3>";
                    $isi = "";
                    $qr0 = mysqli_query(fOpenConn(), "SELECT cnt_isi FROM mscontent WHERE cnt_id = '$contentid'");
                    if (mysqli_num_rows($qr0) > 0)
                    {
                        $rs0 = mysqli_fetch_object($qr0);
                        $isi = $rs0->cnt_isi;
                    }
                ?>
                <form method="post">
                        <textarea class="jqte-test" id="isi" name="isi" ><?php if (isset($isi)) echo $isi; ?></textarea>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
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

<script>
                    $('.jqte-test').jqte();
                </script>