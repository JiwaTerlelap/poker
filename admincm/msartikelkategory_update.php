<?php
$modulid = "ArtikelKategory";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msartikelkategory WHERE artkat_id = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}

$titlepage = "Kategory Artikel Update";

if (isset($_POST['saveproses']))
{
    $kategory = antiinjection($_POST['kategory']);
    $cek = mysqli_query(fOpenConn(), "SELECT artkat_id FROM msartikelkategory WHERE artkat_nama = '$kategory' AND artkat_id != '$id'");
        
    if (empty($kategory)) 
    {
        header("location:");
    }
    else if (mysqli_num_rows($cek) > 0)
    {
        ?>
        <script>
            alert("Nama Kategory Sudah Ada");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msartikelkategory SET artkat_nama = '$kategory' WHERE artkat_id = '$id'");
        ?>
        <script>
            alert("Success ::: Update Kategory Artikel");
            location.href = "msartikelkategory.php";
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
$kategory = $rs1->artkat_nama;
?>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update Kategory Artikel</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="kategory">Kategory</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="kategory" name="kategory" placeholder="Kategory" value="<?php if (isset($kategory)) echo $kategory; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>