<?php
$modulid = "MemberTolak";
require_once "../includes/validuser.php";
$titlepage = "Member Tolak";

$addquery = "";
$keyword = "";
$addurl = "";
if (isset($_GET['keyword']))
{
    $keyword = antiinjection($_GET['keyword']);
    if ($keyword != "")
    {
        $addquery = "AND (mbr_email LIKE '%$keyword%' OR mbr_hp LIKE '%$keyword%' OR mbr_namarek LIKE '%$keyword%' OR mbr_norek LIKE '%$keyword%' OR mbr_gameid LIKE '%$keyword%')";
        $addurl = "keyword=$keyword";
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
$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msgames WHERE mbr_games = gm_id AND mbr_status = 'Tolak'  $addquery");
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
                    <h2><i class="glyphicon glyphicon-list"></i> List Member Tolak</h2>
                </div>
                <div class="box-content">
                    <div class="box row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <form class="pull-right" method="get" action="">
                                <input placeholder="Cari" name="keyword"  class="form-control inputsendiri" value="<?php echo $keyword; ?>" type="text">
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Permainan</th>
                                <th>Bank</th>
                                <th>Nama & Rek</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msmember, msgames WHERE mbr_games = gm_id AND mbr_status = 'Tolak'  $addquery ORDER BY mbr_email LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            $createtm = date("d-m-y H:i", strtotime($rs1->mbr_createtm));
                            echo "<tr><td><a style='text-decoration: none;' href='msmembertolak_detail.php?id=$rs1->mbr_id'>$rs1->mbr_email</a></td>";
                            echo "<td>$rs1->mbr_hp</td>";
                            echo "<td>$rs1->gm_nama</td>";
                            echo "<td>$rs1->mbr_namabank</td>";
                            echo "<td>$rs1->mbr_namarek ( $rs1->mbr_norek )</td>";
                            echo "<td>$createtm</td></tr>";
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
                                    echo "<li><a href='?start=$start&$addurl'>$j</a></li>";
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