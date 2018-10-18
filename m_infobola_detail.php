<?php
$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msartikel WHERE art_id = '$artikelid' LIMIT 1");
$rs0 = mysqli_fetch_object($qr0);
$title = $rs0->art_judul;
$deskripsi = $rs0->art_deskripsi;
$keywords = $rs0->art_keyword;
$gambar = $artikelid."-".$rs0->art_gambar;
$isi = $rs0->art_isi;
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
    <h3 class="judulartikel"><?php echo $title; ?></h3>
    <img style="display: block; margin: 10px 0x 8px 0px;" src="<?php echo $domainname."artikel/".$gambar; ?>" alt="<?php echo $title; ?>">
    <?php echo $isi; ?>
  </div>
</div>
<?php
require_once '_footer.php';
?>