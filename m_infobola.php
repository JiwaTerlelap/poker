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
  	<table class="table-list">
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
  		$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msjadwalbola ORDER BY jdwl_datetime DESC LIMIT 15");
  		while ($rs0 = mysqli_fetch_object($qr0))
  		{
             $hari = date("D", strtotime($rs0->jdwl_datetime));;
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
             $tgl = $hari.", ".date("d M Y H:i", strtotime($rs0->jdwl_datetime));
             echo "<tr><td>$tgl</td>";
             echo "<td>$rs0->jdwl_home</td>";
             echo "<td>$rs0->jdwl_away</td>";
             echo "<td>$rs0->jdwl_livetv</td></tr>";
         }
         ?>
         </tbody>
     </table>
  	<?php

    $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msartikel, msartikelkategory WHERE artkat_id = art_kategory AND art_tgl <= now()");
    $jumlahlist = mysqli_num_rows($qr0); 
    $per_hal = 10;
    $jml_hal = ceil($jumlahlist/$per_hal);

    if(!isset($pecah['2']))
      $start=0;
    else
      $start = antiinjectionmain($pecah['2']);
        
    if (empty($start)) $start = 0;

    if (!is_numeric($start))
        $start = 0;
        
    if ($start > $jumlahlist) $start=0;

    $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msartikel, msartikelkategory WHERE artkat_id = art_kategory AND art_tgl <= now() ORDER BY art_tgl DESC limit $start, $per_hal"); ?>
    <ul class="artikel_list_kategori">
    	<?php
    	if (mysqli_num_rows($qr0) > 0)
    	{
            while ($rs0 = mysqli_fetch_object($qr0)) 
            {
                echo '<li>';
                echo '<div class="relatedthumb"><img class="img_artikel" src="'.$domainname.'artikel/'.$rs0->art_id.'-'.$rs0->art_gambar.'" /><a href="'.$domainname.'berita/'.$rs0->art_id.'/'.$rs0->art_judul.'"><h3>'.substr($rs0->art_judul,0,150).'</h3></a><p>'.substr(addslashes($rs0->art_isi),0,400).' . . . . . </p></div></li>';
            }

        }
    ?>
    </ul>
    <?php
    $hal_ini = $start/$per_hal;
    $hal_ini++;
    $start = 0;
    ?>
</a></b></div></li></ul>
    <ul class="paginationberita">
    <?php
    if ($jml_hal > 1)
    {   
      for ($j = 1; $j <= $jml_hal; $j++) 
      {
        if ($j == $hal_ini) {
          echo '<li class="active"><a href="'.$domainname.'info-bola/#">'.$j.'</a></li>';
          $start+=$per_hal;
        }
        else
        {
          echo '<li><a href="'.$domainname.'info-bola/'.$start.'">'.$j.'</a></li>';
          $start+=$per_hal;
        }
      }
    }
    ?>
    </ul>
  </div>
</div>
<?php
require_once '_footer.php';
?>