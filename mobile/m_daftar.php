<?php
require_once '_htmltop.php';

if (isset($_POST['daftar']))
{
	$permainan = antiinjectionmain($_POST['permainan']);
	$email = antiinjectionmain($_POST['email']);
	$hp = antiinjectionmain($_POST['hp']);
	$bank = antiinjectionmain($_POST['bank']);
	$namabank = antiinjectionmain($_POST['namabank']);
	$nomorrek = antiinjectionmain($_POST['nomorrek']);
	$validasi = antiinjectionmain($_POST['validasi']);
	$ip = $_SERVER['REMOTE_ADDR'];
	if (!empty($permainan) && !empty($email) && !empty($hp) && !empty($bank) && !empty($namabank) && !empty($nomorrek))
	{
		$cek = mysqli_query(fOpenConn(), "SELECT mbr_id FROM msmember WHERE mbr_games = '$permainan' AND mbr_norek = '$nomorrek' AND (mbr_status = 'Baru' OR  mbr_status = 'Setuju')");
		if ($validasi != $_COOKIE['validasicode'])
		{
			?>
	        <script>
	            alert("Kode Validasi Salah");
	        </script>
	        <?php
		}
		else if (mysqli_num_rows($cek) > 0)
		{
			?>
	        <script>
	            alert("Nomor Rekening Sudah Terdaftar Dengan Jenis Permaninan Yang Dipilih..");
	        </script>
	        <?php
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			?>
	        <script>
	            alert("Email Yang Digunakan Tidak Valid...");
	        </script>
	        <?php
		}
		else
		{
			mysqli_query(fOpenConn(), "INSERT INTO msmember (mbr_nama, mbr_email, mbr_hp, mbr_games, mbr_namabank, mbr_namarek, mbr_norek, mbr_status, mbr_ip, mbr_createtm) VALUES ('$namabank', '$email', '$hp', '$permainan', '$bank', '$namabank', '$nomorrek', 'Baru', '$ip', now())");
			?>
	        <script>
	            alert("Terima Kasih., UserID dan Password Permainan Akan Dikirimkan Melalui Email..");
	            location.href = "";
	        </script>
	        <?php
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
<div class="content">
    <h2>Daftar</h2>
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
      <label class="control-label col-sm-2" for="email">Email :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control wajibinput" id="email" placeholder="Enter email" name="email" value="<?php if (isset($email)) echo $email; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="hp">Handphone :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="hp" placeholder="Handphone" name="hp" value="<?php if (isset($hp)) echo $hp; ?>">
      </div>
    </div>
    <?php
    $banklist = array("BCA", "Mandiri", "BNI", "BRI", "Danamon");
    ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="bank">Bank :</label>
      <div class="col-sm-10">
      	<?php if (!isset($bank)) $bank = ""; ?>
        <select class="form-control wajibinput" id="bank" placeholder="Bank" name="bank">
        	<option value="">-- Pilih Bank --</option>
        	<?php
        	foreach ($banklist as $bankid)
        	{
        		if ($bankid == $bank)
  					echo '<option selected value="'.$bankid.'">'.$bankid.'</option>';
  				else
  					echo '<option value="'.$bankid.'">'.$bankid.'</option>';

  			}
  			?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="namabank">Nama Bank :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="namabank" placeholder="Nama Bank" name="namabank" value="<?php if (isset($namabank)) echo $namabank; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="nomorrek">Nomor Rekening :</label>
      <div class="col-sm-10">
        <input class="form-control wajibinput" id="nomorrek" placeholder="Nomor Rekening" onkeypress='validate(event)' name="nomorrek" value="<?php if (isset($nomorrek)) echo $nomorrek; ?>">
      </div>
    </div>
    
	<div class="form-group">
      <label class="control-label col-sm-2" for="validasi">Validasi : </label>
      <div class="col-sm-10">
        <input class="form-control validasiinput wajibinput" maxlength="5" id="validasi" placeholder="Validasi" name="validasi"> <img class="validasiimage" src="_validasiimage.php" width="115" height="30" alt="Acak" />
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-10">
        <button type="submit" name="daftar" class="btn-primary"><img width="100px" src="<?php echo $domainname; ?>mobile/images/btn-daftar.png"></button>
      </div>
    </div>
  </form>
</div>
<?php
require_once '_footer.php';
?>