<?php
$modulid = "Togel";
require_once "../includes/validuser.php";

if (!isset($_GET['tgl']))
    header("location:index.php");
else
    $tgl = antiinjection($_GET['tgl']);

if (!isset($_GET['jenis']))
    header("location:index.php");
else
    $jenis = antiinjection($_GET['jenis']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM mstogel, mstogelpasaran WHERE tgl_pasaran = tglpr_id AND tgl_date = '$tgl' AND tgl_pasaran = '$jenis'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}


$titlepage = "Togel Update | Hapus";
if (isset($_POST['saveproses']))
{
    $angka = antiinjection($_POST['angka']);
    if (empty($angka) || $angka == " ") 
    {
        mysqli_query(fOpenConn(), "DELETE FROM mstogel WHERE tgl_date = '$tgl' AND tgl_pasaran = '$jenis'");
        ?>
        <script>
            alert("Success ::: Hapus Keluaran Togel");
            location.href = "mstogel.php";
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "UPDATE mstogel SET tgl_angka = '$angka' WHERE tgl_date = '$tgl' AND tgl_pasaran = '$jenis'");
        ?>
        <script>
            alert("Success ::: Update Keluaran Togel");
            location.href = "";
        </script>
        <?php
    }
}

require_once '../includes/htmltop.php';
?>    
<script type="text/javascript">
    function validate(evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode( key );
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
</script>
<link type="text/css" href="../plugin/Datepicker/datepicker.css" rel="stylesheet">
<script type="text/javascript" src="../plugin/Datepicker/datepicker.js"></script>
<script type="text/javascript" src="../plugin/Datepicker/jquery-ui.min.js"></script>
<script language="javascript" type="text/javascript" src="../plugin/Datepicker/datetimepicker.js"></script>
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
$hari = date("D", strtotime($tgl));;
if ($hari = "Mon")
    $hari = "Senin";
else if ($hari = "Tue")
    $hari = "Selasa";
else if ($hari = "Wed")
    $hari = "Rabu";
else if ($hari = "Thu")
    $hari = "Kamis";
else if ($hari = "Fri")
    $hari = "Jumat";
else if ($hari = "Sat")
    $hari = "Sabtu";
else if ($hari = "Sun")
    $hari = "Minggu";
$tgl = $hari.", ".date("d M Y", strtotime($tgl));
$angka = $rs1->tgl_angka;
$pasaran = $rs1->tglpr_nama;
?>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update | Hapus - Keluaran Togel</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <?php if (!isset($tanggal)) $tanggal = date("Y-m-d"); ?>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php if (isset($tgl)) echo $tgl; ?>">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $("#tanggal").datepicker({
                                dateFormat: 'yy-mm-dd',
                            });
                        });
                    </script>
                    <?php if (!isset($pasaran)) $pasaran = ""; ?>
                    <div class="form-group">
                        <label for="pasaran">Pasaran</label>
                        <input type="text" class="form-control" disabled="disabled" value="<?php if (isset($pasaran)) echo $pasaran; ?>">
                    </div>
                    <div class="form-group">
                        <label for="angka">Angka</label>
                        <input type="text" maxlength="6" class="form-control" id="angka" name="angka" placeholder="Angka" value="<?php if (isset($angka)) echo $angka; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    $datajeniskeluaran = array();
    $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM mstogelpasaran WHERE tglpr_active = 'a' ORDER BY tglpr_nama");
    if (mysqli_num_rows($qr0) > 0)
    {
        while ($rs0 = mysqli_fetch_object($qr0))
        {
            $temp = array($rs0->tglpr_id,$rs0->tglpr_nama);
            array_push($datajeniskeluaran,$temp);
        }
    }


$qr0 = mysqli_query(fOpenConn(), "SELECT tgl_date FROM mstogel WHERE tgl_pasaran IN (SELECT tglpr_id FROM mstogelpasaran WHERE tglpr_active = 'a') GROUP BY tgl_date");
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
    <div class="box col-md-8">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-list"></i> List Keluaran Togel</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <?php
                                for ($x = 0; $x < sizeof($datajeniskeluaran); $x++)
                                    echo "<th>".$datajeniskeluaran[$x][1]."</th>";
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qr1 = mysqli_query(fOpenConn(), "SELECT tgl_date FROM mstogel WHERE tgl_pasaran IN (SELECT tglpr_id FROM mstogelpasaran WHERE tglpr_active = 'a') GROUP BY tgl_date ORDER BY tgl_date DESC LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $hari = date("D", strtotime($rs1->tgl_date));;
                            if ($hari = "Mon")
                                $hari = "Senin";
                            else if ($hari = "Tue")
                                $hari = "Selasa";
                            else if ($hari = "Wed")
                                $hari = "Rabu";
                            else if ($hari = "Thu")
                                $hari = "Kamis";
                            else if ($hari = "Fri")
                                $hari = "Jumat";
                            else if ($hari = "Sat")
                                $hari = "Sabtu";
                            else if ($hari = "Sun")
                                $hari = "Minggu";
                            $tgl = $hari.", ".date("d M Y", strtotime($rs1->tgl_date));
                            echo "<tr><td>$tgl</td>";
                            for ($x = 0; $x < sizeof($datajeniskeluaran); $x++)
                            {
                                $jeniskeluaran = $datajeniskeluaran[$x][0];
                                $qr0 = mysqli_query(fOpenConn(), "SELECT tgl_angka FROM mstogel WHERE tgl_date = '$rs1->tgl_date' AND tgl_pasaran = '$jeniskeluaran'");
                                    if (mysqli_num_rows($qr0) > 0)
                                    {
                                        $rs0 = mysqli_fetch_object($qr0);
                                        echo "<td><a style='text-decoration: none;' href='mstogel_update.php?jenis=$jeniskeluaran&tgl=$rs1->tgl_date'>".$rs0->tgl_angka."</a></td>";
                                    }
                                    else
                                        echo "<td>-</td>";
                            }
                            echo "</tr>";
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