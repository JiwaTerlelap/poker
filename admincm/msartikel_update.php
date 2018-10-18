<?php
$modulid = "Artikel";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msartikel WHERE art_id = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}

$titlepage = "Artikel Update";

if (isset($_POST['saveproses']))
{
    $judul = antiinjection($_POST['judul']);
    $isi = antiinjection($_POST['isi']);
    $kategory = antiinjection($_POST['kategory']);
    $deskripsi = antiinjection($_POST['deskripsi']);
    $keyword = antiinjection($_POST['keyword']);
    $tag = antiinjection($_POST['tag']);
    $tanggal = antiinjection($_POST['tanggal']);
    $typegambar = $_FILES["gambar"]["type"];
    $namagambar = $_FILES['gambar']['name'];
    $cek = mysqli_query(fOpenConn(), "SELECT art_id FROM msartikel WHERE art_judul = '$judul' AND art_id != '$id'");
        
    if (empty($judul) || empty($isi) || empty($kategory) || empty($tanggal)) 
    {
        header("location:");

    }
    else if (mysqli_num_rows($cek) > 0)
    {
        ?>
        <script>
            alert("Judul Artikel Sudah Ada");
        </script>
        <?php
    }
    else if ($namagambar != "" && $typegambar != "image/gif" && $typegambar != "image/jpeg" && $typegambar != "image/pjpeg")
    {
        ?>
        <script>
            alert("Tipe File Gambar Harus Dalam Bentuk GIF atau JPG");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE msartikel SET art_tgl = '$tanggal', art_judul = '$judul', art_isi = '$isi', art_kategory = '$kategory', art_deskripsi = '$deskripsi', art_keyword = '$keyword', art_tag = '$tag' WHERE art_id = '$id'");
        if ($namagambar != "")
        {
            $uploadgambar = "../artikel/".$id."-".$namagambar;
            unlink("../artikel/".$id."-".$rs1->art_gambar);
            copy ($_FILES['gambar']['tmp_name'], $uploadgambar) or die ("Could not copy");
            $image_to_resize = $uploadgambar;
            
            $jalan = true;
            if ($jalan)
            {
                include '../includes/resize.image.class.php';
                $image = new Resize_Image;
                $image->new_width = 950;
                $image->new_height = 420;
                $image->image_to_resize = $uploadgambar;
                $image->ratio = true;
                $image->new_image_name = $id."-".preg_replace('/(.*)\\.[^\\.]*/', '$1', $namagambar);
                $image->save_folder = "../artikel/";
                $process = $image->resize();
                if($process['result'] && $image->save_folder)
                { 
                }
            }
            mysqli_query(fOpenConn(), "UPDATE msartikel SET art_gambar = '$namagambar' WHERE art_id = '$id'");
        }
        ?>
        <script>
            alert("Success ::: Update Artikel");
            location.href = "";
        </script>
        <?php
    }
}

require_once '../includes/htmltop.php';
?>
<link type="text/css" rel="stylesheet" href="../plugin/Editor/jquery-te-1.4.0.css">
<script type="text/javascript" src="../plugin/Editor/jquery-te-1.4.0.js" charset="utf-8"></script>
<style type="text/css">
.jqte {
    margin: 0px;
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
$judul = $rs1->art_isi;
$isi = $rs1->art_judul;
$kategory = $rs1->art_kategory;
$deskripsi = $rs1->art_deskripsi;
$keyword = $rs1->art_keyword;
$tag = $rs1->art_tag;
$tanggal = $rs1->art_tgl;
$gambar = "../artikel/".$id."-".$rs1->art_gambar;
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update Artikel</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul Artikel</label>
                        <input type="text" maxlength="1000" class="form-control wajibinput" id="judul" name="judul" placeholder="Judul Artikel" value="<?php if (isset($judul)) echo $judul; ?>">
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Artikel</label>
                        <textarea class="jqte-test form-control wajibinput" id="isi" name="isi" ><?php if (isset($isi)) echo $isi; ?></textarea>
                    </div>
                    <script>
                        $('.jqte-test').jqte();
                    </script>
                    <?php if (!isset($kategory)) $kategory = ""; ?>
                    <div class="form-group">
                        <label for="kategory">Kategory</label>
                        <select class="form-control wajibinput" id="kategory" name="kategory">
                            <option value=""> - ? - </option>
                            <?php
                            $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msartikelkategory ORDER BY artkat_nama");
                            while ($rs0 = mysqli_fetch_object($qr0))
                            {
                                if ($rs0->artkat_id == $kategory)
                                    echo "<option selected value='$rs0->artkat_id'>$rs0->artkat_nama</option>";
                                else
                                    echo "<option value='$rs0->artkat_id'>$rs0->artkat_nama</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control wajibinput" id="deskripsi" name="deskripsi" placeholder="Deskripsi" value="<?php if (isset($deskripsi)) echo $deskripsi; ?>">
                    </div>
                    <div class="form-group">
                        <label for="keyword">Keyword</label>
                        <input type="text" class="form-control wajibinput" id="keyword" name="keyword" placeholder="Keyword" value="<?php if (isset($keyword)) echo $keyword; ?>">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" placeholder="Gambar" value="<?php if (isset($gambar)) echo $gambar; ?>">
                        
                    </div>
                    <div class="form-group">
                        <img src="<?php echo $gambar; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag (Pisahkan dengan tanda koma)</label>
                        <input type="text" class="form-control wajibinput" id="tag" name="tag" placeholder="Tag" value="<?php if (isset($tag)) echo $tag; ?>">
                    </div>
                    <link type="text/css" href="../plugin/Datepicker/datepicker.css" rel="stylesheet">
                    <script type="text/javascript" src="../plugin/Datepicker/datepicker.js"></script>
                    <script type="text/javascript" src="../plugin/Datepicker/jquery-ui.min.js"></script>
                    <script language="javascript" type="text/javascript" src="../plugin/Datepicker/datetimepicker.js"></script>
                    <?php if (!isset($tanggal)) $tanggal = date("Y-m-d"); ?>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Publish</label>
                        <input type="text" class="form-control inputsendiri wajibinput" id="tanggal" name="tanggal" placeholder="Tanggal Publish" value="<?php if (isset($tanggal)) echo $tanggal; ?>">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $("#tanggal").datepicker({
                                dateFormat: 'yy-mm-dd',
                            });
                        });
                    </script>
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