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
  <div class="content">
    <?php 
    $qr0 = mysqli_query(fOpenConn(), "SELECT cnt_isi FROM mscontent WHERE cnt_id = '$gamesid' LIMIT 1");
    if (mysqli_num_rows($qr0) > 0)
    {
   		$rs0 = mysqli_fetch_object($qr0);
    	echo $rs0->cnt_isi;
    }
    else
    {
      echo "<h2>Games</h2>";
      $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msgames WHERE gm_active = 'a' ORDER BY gm_nama");
      if (mysqli_num_rows($qr0) > 0)
      {
        echo "<ul class='jenisgames'>";
        while ($rs0 = mysqli_fetch_object($qr0))
        {
          echo "<li><a href='".$domainname."mobile/games/$rs0->gm_nama'>$rs0->gm_nama</a></li>";
        }
        echo "</ul>";
      }
    }
    ?>
  </div>
<?php
require_once '_footer.php';
?>