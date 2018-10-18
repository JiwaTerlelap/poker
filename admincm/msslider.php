<?php
$modulid = "MsSlider";
require_once "../includes/validuser.php";
$titlepage = "Master Slider";

$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msslider");
$rs1 = mysqli_fetch_object($qr1);


$imageslider1 = $rs1->slider_1;
$imageslider2 = $rs1->slider_2;
$imageslider3 = $rs1->slider_3;
$imageslider4 = $rs1->slider_4;
$imagepopup = $rs1->slider_popup;

if (isset($_POST['saveproses']))
{
    $typegambar1 = $_FILES["slider1"]["type"];
    $namagambar1 = $_FILES['slider1']['name'];

    $typegambar2 = $_FILES["slider2"]["type"];
    $namagambar2 = $_FILES['slider2']['name'];

    $typegambar3 = $_FILES["slider3"]["type"];
    $namagambar3 = $_FILES['slider3']['name'];

    $typegambar4 = $_FILES["slider4"]["type"];
    $namagambar4 = $_FILES['slider4']['name'];

    $typegambar5 = $_FILES["popup"]["type"];
    $namagambar5 = $_FILES['popup']['name'];
    
    if ($namagambar1 != "" && $typegambar1 != "image/png" && $typegambar1 != "image/jpeg" && $typegambar1 != "image/pjpeg")
    {
        ?>
        <script>
            alert("Tipe File Slider 1 Harus Dalam Bentuk JPG/PNG");
        </script>
        <?php
    }
    else if ($namagambar2 != "" && $typegambar2 != "image/png" && $typegambar2 != "image/jpeg" && $typegambar2 != "image/pjpeg")
    {
        ?>
        <script>
            alert("Tipe File Slider 2 Harus Dalam Bentuk JPG/PNG");
        </script>
        <?php
    }
    else if ($namagambar3 != "" && $typegambar3 != "image/png" && $typegambar3 != "image/jpeg" && $typegambar3 != "image/pjpeg")
    {
        ?>
        <script>
            alert("Tipe File Slider 3 Harus Dalam Bentuk JPG/PNG");
        </script>
        <?php
    }
    else if ($namagambar4 != "" && $typegambar4 != "image/png" && $typegambar4 != "image/jpeg" && $typegambar4 != "image/pjpeg")
    {
        ?>
        <script>
            alert("Tipe File Slider 4 Harus Dalam Bentuk JPG/PNG");
        </script>
        <?php
    }
    else if ($namagambar5 != "" && $typegambar5 != "image/jpeg" && $typegambar5 != "image/pjpeg" && $typegambar5 != "" && $typegambar5 != "image/png" && $typegambar5 != "image/gif")
    {
        ?>
        <script>
            alert("Tipe File Pop Up Harus Dalam Bentuk JPG/PNG/GIF");
        </script>
        <?php
    }
    else
    {
        $recomwidth = 1200;
        $recomheight = 450;
        include '../includes/resize.image.class.php';
        if ($namagambar1 != "")
        {
            
            $ext = pathinfo($namagambar1, PATHINFO_EXTENSION);
            $namaimage = "slider_1.".$ext;
            $uploadgambar = "../images/slider/".$namaimage;
            copy ($_FILES['slider1']['tmp_name'], $uploadgambar) or die ("Could not copy");
            
            $image = new Resize_Image;
            $image->new_width = $recomwidth;
            $image->new_height = $recomheight;
            $image->image_to_resize = $uploadgambar;
            $image->ratio = false;
            $image->new_image_name = "slide_1";
            $image->save_folder = "../images/slider/";
            $process = $image->resize();
            if($process['result'] && $image->save_folder)
            { 
            }
            mysqli_query(fOpenConn(), "UPDATE msslider SET slider_1 = '$namaimage'");
        }

        if ($namagambar2 != "")
        {
            $ext = pathinfo($namagambar2, PATHINFO_EXTENSION);
            $namaimage = "slider_2.".$ext;
            $uploadgambar = "../images/slider/".$namaimage;
            copy ($_FILES['slider2']['tmp_name'], $uploadgambar) or die ("Could not copy");
            $image = new Resize_Image;
            $image->new_width = $recomwidth;
            $image->new_height = $recomheight;
            $image->image_to_resize = $uploadgambar;
            $image->ratio = false;
            $image->new_image_name = "slide_2";
            $image->save_folder = "../images/slider/";
            $process = $image->resize();
            if($process['result'] && $image->save_folder)
            { 
            }

            mysqli_query(fOpenConn(), "UPDATE msslider SET slider_2 = '$namaimage'");
        }

        if ($namagambar3 != "")
        {
            $ext = pathinfo($namagambar3, PATHINFO_EXTENSION);
            $namaimage = "slider_3.".$ext;
            $uploadgambar = "../images/slider/".$namaimage;
            copy ($_FILES['slider3']['tmp_name'], $uploadgambar) or die ("Could not copy");
            $image = new Resize_Image;
            $image->new_width = $recomwidth;
            $image->new_height = $recomheight;
            $image->image_to_resize = $uploadgambar;
            $image->ratio = false;
            $image->new_image_name = "slide_3";
            $image->save_folder = "../images/slider/";
            $process = $image->resize();
            if($process['result'] && $image->save_folder)
            { 
            }

            mysqli_query(fOpenConn(), "UPDATE msslider SET slider_3 = '$namaimage'");
        }

        if ($namagambar4 != "")
        {
            $ext = pathinfo($namagambar4, PATHINFO_EXTENSION);
            $namaimage = "slider_4.".$ext;
            $uploadgambar = "../images/slider/".$namaimage;
            copy ($_FILES['slider4']['tmp_name'], $uploadgambar) or die ("Could not copy");
            $image = new Resize_Image;
            $image->new_width = $recomwidth;
            $image->new_height = $recomheight;
            $image->image_to_resize = $uploadgambar;
            $image->ratio = false;
            $image->new_image_name = "slide_4";
            $image->save_folder = "../images/slider/";
            $process = $image->resize();
            if($process['result'] && $image->save_folder)
            { 
            }

            mysqli_query(fOpenConn(), "UPDATE msslider SET slider_4 = '$namaimage'");
        }

        if ($namagambar5 != "")
        {
            $ext = pathinfo($namagambar5, PATHINFO_EXTENSION);
            $namaimage = "popup.".$ext;
            $uploadgambar = "../images/slider/".$namaimage;
            copy ($_FILES['popup']['tmp_name'], $uploadgambar) or die ("Could not copy");
            mysqli_query(fOpenConn(), "UPDATE msslider SET slider_popup = '$namaimage'");
        }
        ?>
        <script>
            alert("Success ::: Update Gambar");
            location.href = "msslider.php";
        </script>
        <?php
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == "hapus")
{
    if ($_GET['id'] == "slide_1")
    {

        mysqli_query(fOpenConn(), "UPDATE msslider SET slider_1 = ''");
        unlink("../images/slider/".$imageslider1);
    }
    else if ($_GET['id'] == "slide_2")
    {

        mysqli_query(fOpenConn(), "UPDATE msslider SET slider_2 = ''");
        unlink("../images/slider/".$imageslider2);
    }
    else if ($_GET['id'] == "slide_3")
    {

        mysqli_query(fOpenConn(), "UPDATE msslider SET slider_3 = ''");
        unlink("../images/slider/".$imageslider3);
    }
    else if ($_GET['id'] == "slide_4")
    {

        mysqli_query(fOpenConn(), "UPDATE msslider SET slider_4 = ''");
        unlink("../images/slider/".$imageslider4);
    }
    else if ($_GET['id'] == "popup")
    {

        mysqli_query(fOpenConn(), "UPDATE msslider SET slider_popup = ''");
        unlink("../images/slider/".$imagepopup);
    }
    
    ?>
    <script>
        alert("Success ::: Hapus Gambar");
        location.href = "msslider.php";
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

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-film"></i> Master Slider</h2>
            </div>
            <div class="box-content">
                <form role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="slider1">Slider 1 (Recommended Size : 1200 x 450)</label>
                        <input type="file" class="form-control" id="slider1" name="slider1" placeholder="Slider 1" value="<?php if (isset($slider1)) echo $slider1; ?>">
                    </div>
                    <?php if (file_exists("../images/slider/".$imageslider1) && $imageslider1 != "")
                    {
                        echo '<div class="form-group">
                            <img src="../images/slider/'.$imageslider1.'" />
                        </div>';
                        echo '<p align="right"><a info="Slider 1" href="?proses=hapus&id=slide_1" class="btn btn-warning deletebutton">Hapus Slider 1</a></p>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="slider2">Slider 2 (Recommended Size : 1200 x 450)</label>
                        <input type="file" class="form-control" id="slider2" name="slider2" placeholder="Slider 2" value="<?php if (isset($slider2)) echo $slider2; ?>">
                    </div>
                    <?php if (file_exists("../images/slider/".$imageslider2) && $imageslider2 != "")
                    {
                        echo '<div class="form-group">
                            <img src="../images/slider/'.$imageslider2.'" />
                        </div>';
                        echo '<p align="right"><a info="Slider 2" href="?proses=hapus&id=slide_2" class="btn btn-warning deletebutton">Hapus Slider 2</a></p>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="slider3">Slider 3 (Recommended Size : 1200 x 450)</label>
                        <input type="file" class="form-control" id="slider3" name="slider3" placeholder="Slider 3" value="<?php if (isset($slider3)) echo $slider3; ?>">
                    </div>
                    <?php if (file_exists("../images/slider/".$imageslider3) && $imageslider3 != "")
                    {
                        echo '<div class="form-group">
                            <img src="../images/slider/'.$imageslider3.'" />
                        </div>';
                        echo '<p align="right"><a info="Slider 3" href="?proses=hapus&id=slide_3" class="btn btn-warning deletebutton">Hapus Slider 3</a></p>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="slider4">Slider 4 (Recommended Size : 1200 x 450)</label>
                        <input type="file" class="form-control" id="slider4" name="slider4" placeholder="Slider 4" value="<?php if (isset($slider4)) echo $slider4; ?>">
                    </div>
                    <?php if (file_exists("../images/slider/".$imageslider4) && $imageslider4 != "")
                    {
                        echo '<div class="form-group">
                            <img src="../images/slider/'.$imageslider4.'" />
                        </div>';
                        echo '<p align="right"><a info="Slider 4" href="?proses=hapus&id=slide_4" class="btn btn-warning deletebutton">Hapus Slider 4</a></p>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="popup">Pop Up</label>
                        <input type="file" class="form-control" id="popup" name="popup" placeholder="Pop Up" value="<?php if (isset($popup)) echo $popup; ?>">
                    </div>
                    <?php if (file_exists("../images/slider/".$imagepopup) && $imagepopup != "")
                    {
                        echo '<div class="form-group">
                            <img src="../images/slider/'.$imagepopup.'" />
                        </div>';
                        echo '<p align="right"><a info="Pop Up" href="?proses=hapus&id=popup" class="btn btn-warning deletebutton">Hapus Pop Up</a></p>';
                    }
                    ?>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../includes/footer.php';
?>