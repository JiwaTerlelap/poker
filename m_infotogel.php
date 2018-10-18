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
    $datajeniskeluaran = array();
    $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM mstogelpasaran WHERE tglpr_active = 'a' ORDER BY tglpr_nama");
    if (mysqli_num_rows($qr0) > 0)
    {
        while ($rs0 = mysqli_fetch_object($qr0))
        {
            $temp = array($rs0->tglpr_id,$rs0->tglpr_nama);
            array_push($datajeniskeluaran,$temp);
        }
    }
    ?>
    <table class="table-list">
         <thead>
             <tr>
                 <th>Tanggal</th>
                 <?php
                 for ($x = 0; $x < sizeof($datajeniskeluaran); $x++)
                     echo "<th>".$datajeniskeluaran[$x][1]."</th>";
                 ?>
             </tr>
         </thead>
         <tbody>
         <?php
         $qr1 = mysqli_query(fOpenConn(), "SELECT tgl_date FROM mstogel WHERE tgl_pasaran IN (SELECT tglpr_id FROM mstogelpasaran WHERE tglpr_active = 'a') GROUP BY tgl_date ORDER BY tgl_date DESC LIMIT 20");
         while ($rs1 = mysqli_fetch_object($qr1))
         {
             $hari = date("D", strtotime($rs1->tgl_date));;
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
             $tgl = $hari.", ".date("d M Y", strtotime($rs1->tgl_date));
             echo "<tr><td>$tgl</td>";
             for ($x = 0; $x < sizeof($datajeniskeluaran); $x++)
             {
                 $jeniskeluaran = $datajeniskeluaran[$x][0];
                 $qr0 = mysqli_query(fOpenConn(), "SELECT tgl_angka FROM mstogel WHERE tgl_date = '$rs1->tgl_date' AND tgl_pasaran = '$jeniskeluaran'");
                     if (mysqli_num_rows($qr0) > 0)
                     {
                         $rs0 = mysqli_fetch_object($qr0);
                         echo "<td>".$rs0->tgl_angka."</td>";
                     }
                     else
                         echo "<td>-</td>";
             }
             echo "</tr>";
         }
         ?>
         </tbody>
     </table>
</div>
<?php
require_once '_footer.php';
?>