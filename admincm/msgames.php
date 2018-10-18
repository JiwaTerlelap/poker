<?php
$modulid = "Games";
require_once "../includes/validuser.php";
$titlepage = "Master Games";
if (isset($_POST['saveproses']))
{
    $games = antiinjection($_POST['games']);
    $linkmain = antiinjection($_POST['linkmain']);
    $cek = mysqli_query(fOpenConn(), "SELECT gm_id FROM msgames WHERE gm_nama = '$games'");
        
    if (empty($games)) 
    {
        header("location:");
    }
    else if (mysqli_num_rows($cek) > 0)
    {
        ?>
        <script>
            alert("Nama Games Sudah Ada");
        </script>
        <?php
    }
    else
    {
        mysqli_query(fOpenConn(), "INSERT INTO msgames (gm_nama, gm_link) VALUES ('$games', '$linkmain')");
        mysqli_query(fOpenConn(), "INSERT INTO mscontent (cnt_id) VALUES ('$games')");
        ?>
        <script>
            alert("Success ::: Add Master Games");
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
                <h2><i class="glyphicon glyphicon-plus"></i> Add New Master Games</h2>
              
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="games">Games</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="games" name="games" placeholder="Games" value="<?php if (isset($games)) echo $games; ?>">
                    </div>
                    <div class="form-group">
                        <label for="linkmain">Link</label>
                        <input type="text" maxlength="60" class="form-control wajibinput" id="linkmain" name="linkmain" placeholder="Link" value="<?php if (isset($linkmain)) echo $linkmain; ?>">
                    </div>
                    <button type="submit" name="saveproses" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT gm_id FROM msgames");
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
                    <h2><i class="glyphicon glyphicon-list"></i> List Master Games</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Games</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ke = $start + 1;
                        $qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msgames ORDER BY gm_id DESC LIMIT $start, $per_hal");
                        while ($rs1 = mysqli_fetch_object($qr1))
                        {
                            echo "<tr><td>$ke.</td>";
                            echo "<td><a href='msgames_update.php?id=$rs1->gm_id'>$rs1->gm_nama</a></td>";
                            echo "<td>$rs1->gm_link</td></tr>";
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