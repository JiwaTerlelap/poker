<?php
require_once '_htmltop.php';

if (isset($_POST['deposit']))
{
	$permainan = antiinjectionmain($_POST['permainan']);
	$idgames = antiinjectionmain($_POST['idgames']);
	$namabank = antiinjectionmain($_POST['namabank']);
	$nomorrek = antiinjectionmain($_POST['nomorrek']);
	$depo = antiinjectionmain($_POST['depo']);
  $validasi = antiinjectionmain($_POST['validasi']);
	$ip = $_SERVER['REMOTE_ADDR'];
	if (!empty($permainan) && !empty($idgames) && !empty($depo) && !empty($validasi) && !empty($namabank) && !empty($nomorrek))
	{
		$cek = mysqli_query(fOpenConn(), "SELECT mbr_id FROM msmember WHERE mbr_games = '$permainan' AND mbr_gameid = '$idgames' AND mbr_namarek = '$namabank' AND mbr_norek = '$nomorrek' AND mbr_status = 'Setuju'");

		if ($validasi != $_COOKIE['validasicode'])
		{
			?>
	        <script>
	            alert("Kode Validasi Salah");
	        </script>
	        <?php
		}
		else if (mysqli_num_rows($cek) == 0)
		{
			?>
	        <script>
	            alert("ID Games Tidak Terdaftar..");
	        </script>
	        <?php
		}
    else if ($depo < 20000)
    {
      ?>
          <script>
              alert("Minimal Deposit Rp 20.000");
          </script>
          <?php
    }
		else
		{
      $rscek = mysqli_fetch_object($cek);
      $cek1 = mysqli_query(fOpenConn(), "SELECT dpo_id FROM msdepo WHERE dpo_member = '$rscek->mbr_id' AND dpo_status = 'Baru'");
      if (mysqli_num_rows($cek1) > 0)
      {
        ?>
            <script>
                alert("Transaksi Gagal ::: Masih Ada Deposit Yang Sedang Diproses..");
            </script>
            <?php
      }
      else
      {
        mysqli_query(fOpenConn(), "INSERT INTO msdepo (dpo_member, dpo_jumlah, dpo_ip, dpo_createtm, dpo_status) VALUES ('$rscek->mbr_id', '$depo', '$ip',now(), 'Baru')");
          ?>
          <script>
              alert("Terima Kasih., Deposit Telah Dikirimkan");
              location.href = "";
          </script>
          <?php
      }
		}

	}
}

$len = 5; //Panjang karakter 
$chars = "12345abcdefg"; //Kombinasi huruf dan angka yang diacak 
$string = ''; 
for ($i = 0; $i < $len; $i++) { 
	$pos = rand(0, strlen($chars)-1); 
	$string .= $chars{$pos}; 
} 
setcookie("validasicode", $string,time()+3600);
?>
<style type="text/css">
.content {
	-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}
</style>

<script type="text/javascript">
    function validate(evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode( key );
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
</script>
</head>

<body>
<!-- topbar starts -->
<?php
require_once '_topbar.php';
?>
<!--Konten-->
<div class="container">
  <div class="content">
    <h2>Deposit</h2>
	<form class="form-horizontal" action="" method="post">
	<div class="form-group">
      <label class="control-label col-sm-2" for="permainan">Permainan :</label>
      <div class="col-sm-10">
      	<?php if (!isset($permainan)) $permainan = ""; ?>
        <select class="form-control wajibinput" id="permainan" placeholder="Permainan" name="permainan">
        	<option value="">-- Pilih Permainan --</option>
        	<?php
        	$qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msgames WHERE gm_active = 'a' ORDER BY gm_nama");
  			while ($rs0 = mysqli_fetch_object($qr0))
  			{
  				if ($rs0->gm_id == $permainan)
  					echo '<option selected value="'.$rs0->gm_id.'">'.$rs0->gm_nama.'</option>';
  				else
  					echo '<option value="'.$rs0->gm_id.'">'.$rs0->gm_nama.'</option>';

  			}
  			?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="idgames">ID Permainan :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control wajibinput" id="idgames" placeholder="ID Permainan" name="idgames" value="<?php if (isset($idgames)) echo $idgames; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="namabank">Nama Rekening :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="namabank" placeholder="Nama Rekening" name="namabank" value="<?php if (isset($namabank)) echo $namabank; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="nomorrek">Nomor Rekening :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="nomorrek" placeholder="Nomor Rekening"  onkeypress='validate(event)' name="nomorrek" value="<?php if (isset($nomorrek)) echo $nomorrek; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="depo">Jumlah Deposit :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="depo" placeholder="Jumlah Deposit" onkeypress='validate(event)' name="depo" value="<?php if (isset($depo)) echo $depo; ?>">
      </div>
    </div>
    
	   <div class="form-group">
      <label class="control-label col-sm-2" for="validasi">Validasi : </label>
      <div class="col-sm-10">
        <input class="form-control validasiinput wajibinput" maxlength="5" id="validasi" placeholder="Validasi" name="validasi"> <img class="validasiimage" src="_validasiimage.php" width="115" height="30" alt="Acak" />
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="deposit" class="btn-primary">Deposit</button>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        * Minimal Deposit Rp. 20.000,-
      </div>
    </div>
  </form>
  </div>
</div>
<?php
require_once '_footer.php';
?>