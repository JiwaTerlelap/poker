<?php
$modulid = "Games";
require_once "../includes/validuser.php";

if (!isset($_GET['id']))
    header("location:index.php");
else
    $id = antiinjection($_GET['id']);


$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM msgames WHERE gm_id = '$id'");

if (mysqli_num_rows($qr1) == 0)
{
    header("location:index.php");
    exit();
}
else
{
    $rs1 = mysqli_fetch_object($qr1);
}

$titlepage = "Games Update";

if (isset($_POST['saveproses']))
{
    $games = antiinjection($_POST['games']);
    $linkmain = antiinjection($_POST['linkmain']);
    $status = antiinjection($_POST['status']);
    $cek = mysqli_query(fOpenConn(), "SELECT gm_id FROM msgames WHERE gm_nama = '$games' AND gm_id != '$id'");
        
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
        mysqli_query(fOpenConn(), "UPDATE msgames SET gm_nama = '$games', gm_link = '$linkmain', gm_active = '$status' WHERE gm_id = '$id'");
        mysqli_query(fOpenConn(), "UPDATE mscontent SET cnt_id = '$games' WHERE cnt_id = '$rs1->gm_nama'");
        ?>
        <script>
            alert("Success ::: Update Games");
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

<?php
$games = $rs1->gm_nama;
$linkmain = $rs1->gm_link;
$status = $rs1->gm_active;
?>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update Games</h2>
              
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
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control wajibinput" id="status" name="status">
                            <option <?php if ($status == 'a') echo "selected"; ?> value='a'>Active</option>
                            <option <?php if ($status != 'a') echo "selected"; ?> value='n'>Non-Active</option>
                        </select>
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