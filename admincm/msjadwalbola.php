<?php
$modulid = "JadwalBola";
require_once "../includes/validuser.php";
$titlepage = "Jadwal Bola";
if (isset($_POST['saveproses']))
{
    $tanggal = antiinjection($_POST['tanggal']);
    $home = antiinjection($_POST['home']);
    $away = antiinjection($_POST['away']);
    $livetv = antiinjection($_POST['livetv']);
        
    if (empty($tanggal) || empty($home) || empty($away) || empty($livetv)) 
    {
        header("location:");
    }
    else
    {
        mysqli_query(fOpenConn(), "INSERT INTO msjadwalbola (jdwl_datetime, jdwl_home, jdwl_away, jdwl_livetv) VALUES ('$tanggal', '$home', '$away', '$livetv')");
        ?>
        <script>
            alert("Success ::: Add Jadwal Bola");
            location.href = "";
        </script>
        <?php
    }
}

require_once '../includes/htmltop.php';
?>    
<link type="text/css" href="../plugin/DateTime/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script type="text/javascript" src="../plugin/DateTime/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../plugin/DateTime/bootstrap-datetimepicker.id.js"></script>
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
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Jadwal Bola</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <?php if (!isset($tanggal)) $tanggal = date("Y-m-d"); ?>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control inputsendiri wajibinput" id="tanggal" name="tanggal" placeholder="Tanggal" value="<?php if (isset($tanggal)) echo $tanggal; ?>">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $("#tanggal").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
                        });
                    </script>
                    <div class="form-group">
                        <label for="home">Home</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="home" name="home" placeholder="Home" value="<?php if (isset($home)) echo $home; ?>">
                    </div>
                    <div class="form-group">
                        <label for="away">Away</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="away" name="away" placeholder="Away" value="<?php if (isset($away)) echo $away; ?>">
                    </div>
                    <div class="form-group">
                        <label for="livetv">Live TV</label>
                        <input type="text" maxlength="100" class="form-control wajibinput" id="livetv" name="livetv" placeholder="Live TV" value="<?php if (isset($livetv)) echo $livetv; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT jdwl_id FROM msjadwalbola");
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
                    <h2><i class="glyphicon glyphicon-list"></i> List Jadwal Bola</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Home</th>
                                <th>Away</th>
                                <th>Live TV</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msjadwalbola ORDER BY jdwl_datetime DESC LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $hari = date("D", strtotime($rs1->jdwl_datetime));;
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
                            $tgl = $hari.", ".date("d M Y H:i", strtotime($rs1->jdwl_datetime));
                            echo "<tr><td><a style='text-decoration: none;' href='msjadwalbola_update.php?id=$rs1->jdwl_id'>$tgl</a></td>";
                            echo "<td><a style='text-decoration: none;' href='msjadwalbola_update.php?id=$rs1->jdwl_id'>$rs1->jdwl_home</a></td>";
                            echo "<td><a style='text-decoration: none;' href='msjadwalbola_update.php?id=$rs1->jdwl_id'>$rs1->jdwl_away</a></td>";
                            echo "<td>$rs1->jdwl_livetv</td></tr>";
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