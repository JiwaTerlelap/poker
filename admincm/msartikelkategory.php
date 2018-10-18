<?php
$modulid = "ArtikelKategory";
require_once "../includes/validuser.php";
$titlepage = "Kategory Artikel";
if (isset($_POST['saveproses']))
{
    $kategory = antiinjection($_POST['kategory']);
    $cek = mysqli_query(fOpenConn(), "SELECT artkat_id FROM msartikelkategory WHERE artkat_nama = '$kategory'");
        
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
        mysqli_query(fOpenConn(), "INSERT INTO msartikelkategory (artkat_nama) VALUES ('$kategory')");
        ?>
        <script>
            alert("Success ::: Add Kategory Artikel");
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
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Kategory Artikel</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="kategory">Kategory</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="kategory" name="kategory" placeholder="Kategory" value="<?php if (isset($kategory)) echo $kategory; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT artkat_id FROM msartikelkategory");
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
    <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-list"></i> List Kategory Artikel</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategory</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ke = $start + 1;
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msartikelkategory ORDER BY artkat_id DESC LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            echo "<tr><td>$ke.</td>";
                            echo "<td><a href='msartikelkategory_update.php?id=$rs1->artkat_id'>$rs1->artkat_nama</a></td></tr>";
                            $ke++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    $hal_ini = $start/$per_hal;
                    $hal_ini++;
                    $start = 0;
                    ?>
                    <ul class="pagination pagination-centered">
                        <?php
                        if ($jml_hal > 1)
                        {   
                            for ($j = 1; $j <= $jml_hal; $j++) 
                            {
                                if ($j == $hal_ini) {
                                    echo "<li class='active'><a href='#'>$j</a></li>";
                                    $start+=$per_hal;
                                }
                                else
                                {
                                    echo "<li><a href='?start=$start'>$j</a></li>";
                                    $start+=$per_hal;
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <!--/span-->

</div><!--/row-->

<!-- external javascript -->



<?php
require_once '../includes/footer.php';
?>