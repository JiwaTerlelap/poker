<?php
require_once "../includes/validuser.php";
$titlepage = "Home";
$modulid = "home";
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
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-volume-up"></i> Announcement</h2>
            </div>
            <div class="box-content">
            <?php
            mysqli_query(fOpenConn(), "UPDATE mspengumuman SET pengumumanstatus = 'e' WHERE DATEDIFF(now(), pengumumantm) > 3  ");
            $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM mspengumuman WHERE pengumumanstatus = 'a' ORDER BY pengumumantm ASC");
            if (mysqli_num_rows($qr0) == 0)
            {
                echo "-";
            }
            while ($rs0 = mysqli_fetch_object($qr0))
            {
                $anndate = date("Y-m-d H:i", strtotime($rs0->pengumumantm));
                echo "<blockquote><small>$rs0->pengumumanby &nbsp; &nbsp; $anndate</small><p class='isikomen'>".nl2br($rs0->pengumumaninfo)."</p>";
                    echo "</blockquote>";
            }
            ?>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../includes/footer.php';
?>