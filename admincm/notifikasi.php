<?php
require_once "../includes/validuser.php";
    $playnotif = false;
    $qrnotif = mysqli_query(fOpenConn(), "SELECT COUNT(mbr_id) AS newnotif FROM msmember WHERE mbr_status = 'Baru'");
    if (mysqli_num_rows($qrnotif) > 0)
    {
        $rsnotif = mysqli_fetch_object($qrnotif);
        if ($rsnotif->newnotif > 0)
        {
            echo '<div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="tooltip" title="'.$rsnotif->newnotif.' New Order" class="well top-block" href="msmember.php">
                <i class="glyphicon glyphicon-user blue"></i>
                <div>New Member</div>
                <span class="notification">'.$rsnotif->newnotif.'</span>
            </a>
            </div>';
            $playnotif = true;
        }
    }

    $qrnotif = mysqli_query(fOpenConn(), "SELECT COUNT(dpo_id) AS newnotif FROM msdepo WHERE dpo_status = 'Baru'");
    if (mysqli_num_rows($qrnotif) > 0)
    {
        $rsnotif = mysqli_fetch_object($qrnotif);
        if ($rsnotif->newnotif > 0)
        {
            echo '<div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="tooltip" title="'.$rsnotif->newnotif.' New Deposit" class="well top-block" href="msdeposit.php">
                <i class="glyphicon glyphicon-plus blue"></i>
                <div>New Deposit</div>
                <span class="notification">'.$rsnotif->newnotif.'</span>
            </a>
            </div>';
            $playnotif = true;
        }
    }


    $qrnotif = mysqli_query(fOpenConn(), "SELECT COUNT(wed_id) AS newnotif FROM mswithdraw WHERE wed_status = 'Baru'");
    if (mysqli_num_rows($qrnotif) > 0)
    {
        $rsnotif = mysqli_fetch_object($qrnotif);
        if ($rsnotif->newnotif > 0)
        {
            echo '<div class="col-md-3 col-sm-3 col-xs-6">
            <a data-toggle="tooltip" title="'.$rsnotif->newnotif.' New Withdraw" class="well top-block" href="mswithdraw.php">
                <i class="glyphicon glyphicon-minus blue"></i>
                <div>New Withdraw</div>
                <span class="notification">'.$rsnotif->newnotif.'</span>
            </a>
            </div>';
            $playnotif = true;
        }
    }


    if ($playnotif)
    {
        ?>
        <script type="text/javascript">
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', '../images/notify.mp3');
        audioElement.loop = false;
        audioElement.play();
        </script>
        <?php
    }
    ?>


