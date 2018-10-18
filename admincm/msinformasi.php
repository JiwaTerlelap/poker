<?php
$modulid = "Informasi";
require_once "../includes/validuser.php";
$titlepage = "Master Informasi";
if (isset($_POST['saveproses']))
{
    $informasi = antiinjection($_POST['informasi']);
        
    if (empty($informasi)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "INSERT INTO mspengumuman (pengumumaninfo, pengumumanby, pengumumantm) VALUES ('$informasi', '$fix_username', now())");
        ?>
        <script>
            alert("Success ::: Add Informasi");
            location.href = "";
        </script>
        <?php
    }
}


if (isset($_GET['proses']) && $_GET['proses'] == "delete" && isset($_GET['informasi']))
{
    $informasi = $_GET['informasi'];
    if (mysqli_query(fOpenConn(), "UPDATE mspengumuman SET pengumumanstatus = 'x' WHERE pengumumanid = '$informasi'"))
    {
        ?>
        <script>
            alert("Success ::: Delete Informasi");
            location.href = "msinformasi.php";
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
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Informasi</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="informasi">Informasi</label>
                        <textarea class="form-control wajibinput" maxlength="250" id="Informasi" name="informasi"><?php if (isset($informasi)) echo $informasi; ?></textarea>
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                    <p class="help-block">Informasi akan otomatis dihapus 3 hari setelah Informasi dibuat</p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT pengumumanid FROM mspengumuman WHERE pengumumanstatus = 'a' || pengumumanstatus = 'e'");
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
                    <h2><i class="glyphicon glyphicon-list"></i> List Informasi</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Info</th>
                            <th>Created</th>
                            <th width="65px">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ke = $start + 1;
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM mspengumuman WHERE pengumumanstatus = 'a' || pengumumanstatus = 'e' ORDER BY pengumumanstatus, pengumumantm LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $anndate = date("Y-m-d H:i", strtotime($rs1->pengumumantm));
                            echo "<tr><td>$ke.</td>";
                            echo "<td>".nl2br($rs1->pengumumaninfo)."</td>";
                            echo "<td>$rs1->pengumumanby [ $anndate ]</td>";
                            if ($rs1->pengumumanstatus == 'e')
                                echo "<td>Expired</td>";
                            else
                                echo "<td><a class='deletebutton' href='?proses=delete&informasi=$rs1->pengumumanid' info='Informasi'><span class='label-default label label-danger'>Delete</span></a></td></tr>";
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