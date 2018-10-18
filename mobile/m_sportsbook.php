<?php
require_once '_htmltop.php';
?>
</head>

<body>
<!-- topbar starts -->
<?php
require_once '_topbar.php';
?>
<!--Konten-->
<div class="container">
  <div class="content">
    <?php 
    $qr0 = mysqli_query(fOpenConn(), "SELECT cnt_isi FROM mscontent WHERE cnt_id = 'Sportsbook' LIMIT 1");
    $rs0 = mysqli_fetch_object($qr0);
    echo $rs0->cnt_isi;
    ?>
  </div>
</div>
<?php
require_once '_footer.php';
?>