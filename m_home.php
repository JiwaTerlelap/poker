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
<script type="text/javascript" src="<?php echo $domainname; ?>plugin/slider/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $domainname; ?>plugin/slider/jssor.slider-23.1.3.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
	var _SlideshowTransitions = [
       {$Duration:1e3,$Delay:80,$Cols:10,$Rows:4,$Clip:15,$SlideOut:!0,$Easing:$JssorEasing$.$EaseOutQuad},{$Duration:1200,y:.3,$Cols:2,$During:{$Top:[.3,.7]},$ChessMode:{$Column:12},$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Outside:!0},{$Duration:1e3,x:-1,y:2,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:!0,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$JssorEasing$.$EaseInExpo,$Top:$JssorEasing$.$EaseInExpo,$Zoom:$JssorEasing$.$EaseInExpo,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInExpo},$Opacity:2,$Round:{$Rotate:.85}},{$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:!0,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$JssorEasing$.$EaseInExpo,$Zoom:$JssorEasing$.$EaseInExpo,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2},{$Duration:1200,x:4,y:-4,$Zoom:11,$Rotate:1,$SlideOut:!0,$Easing:{$Left:$JssorEasing$.$EaseInExpo,$Top:$JssorEasing$.$EaseInExpo,$Zoom:$JssorEasing$.$EaseInExpo,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInExpo},$Opacity:2,$Round:{$Rotate:.8}},{$Duration:1500,x:.3,y:-.3,$Delay:80,$Cols:10,$Rows:4,$Clip:15,$During:{$Left:[.3,.7],$Top:[.3,.7]},$Easing:{$Left:$JssorEasing$.$EaseInJump,$Top:$JssorEasing$.$EaseInJump,$Clip:$JssorEasing$.$EaseOutQuad},$Round:{$Left:.8,$Top:2.5}},{$Duration:1200,x:-3,y:1,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:!0,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$JssorEasing$.$EaseInExpo,$Top:$JssorEasing$.$EaseInExpo,$Zoom:$JssorEasing$.$EaseInExpo,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInExpo},$Opacity:2,$Round:{$Rotate:.7}},{$Duration:1200,y:-1,$Cols:10,$Rows:4,$Clip:15,$During:{$Top:[.5,.5],$Clip:[0,.5]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$ScaleClip:.5},{$Duration:1200,x:.5,y:.5,$Zoom:1,$Rotate:1,$SlideOut:!0,$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseInCubic},$Opacity:2,$Round:{$Rotate:.5}},{$Duration:1200,x:-.6,y:-.6,$Zoom:1,$Rotate:1,$During:{$Left:[.2,.8],$Top:[.2,.8],$Zoom:[.2,.8],$Rotate:[.2,.8]},$Easing:{$Zoom:$JssorEasing$.$EaseSwing,$Opacity:$JssorEasing$.$EaseLinear,$Rotate:$JssorEasing$.$EaseSwing},$Opacity:2,$Round:{$Rotate:.5}},{$Duration:1500,y:-.5,$Delay:60,$Cols:24,$SlideOut:!0,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:$JssorEasing$.$EaseInWave,$Round:{$Top:1.5}},{$Duration:1e3,$Delay:30,$Cols:10,$Rows:4,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:$JssorEasing$.$EaseInQuad},{$Duration:1200,$Delay:20,$Clip:3,$SlideOut:!0,$Assembly:260,$Easing:{$Clip:$JssorEasing$.$EaseOutCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2}
        ];

        var options = {
              $AutoPlay: 1,
              $DragOrientation: 1,
              $PlayOrientation: 1,
			  $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: _SlideshowTransitions,
                $TransitionsOrder: 0,    //The way to choose transition to play slideshow, 1: Sequence, 0: Random 
                $ShowLink: true
            },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              }
            };

        var jssor_slider = new $JssorSlider$("slidermain", options);
    });
</script>
</head>

<body>
<!-- topbar starts -->
<?php
require_once '_topbar.php';
?>
<!--Konten-->
<?php 
$qr01 = mysqli_query(fOpenConn(), "SELECT * FROM msslider");
$rs01 = mysqli_fetch_object($qr01);


$imageslider1 = $rs01->slider_1;
$imageslider2 = $rs01->slider_2;
$imageslider3 = $rs01->slider_3;
$imageslider4 = $rs01->slider_4;
$imagepopup = $rs01->slider_popup;
?>
<div class="slider">
  <div id="slidermain" style="position:relative;margin:0 auto;top:0px;left:0px;width:1200px;height:450px;overflow:hidden;visibility:hidden;" class="slider">
          <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
              <div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
          </div>
          <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1200px;height:450px;overflow:hidden;">
              <?php
              if (file_exists($documentroot."images/slider/".$imageslider1) && $imageslider1 != "")
              {
              ?>
              <div>
                <img src="<?php echo $domainname; ?>images/slider/<?php echo $imageslider1; ?>" />
              </div>
              <?php 
              }
              if (file_exists($documentroot."images/slider/".$imageslider2) && $imageslider2 != "")
              {
              ?>
              <div>
                  <img src="<?php echo $domainname; ?>images/slider/<?php echo $imageslider2; ?>" />
              </div>
              <?php 
              }
              if (file_exists($documentroot."images/slider/".$imageslider3) && $imageslider3 != "")
              {
              ?>
              <div>
                <img src="<?php echo $domainname; ?>images/slider/<?php echo $imageslider3; ?>" />
              </div>
              <?php
              }
              if (file_exists($documentroot."images/slider/".$imageslider4) && $imageslider4 != "")
              {
              ?>
              <div>
                <img src="<?php echo $domainname; ?>images/slider/<?php echo $imageslider4; ?>" />
              </div>
              <?php
              }
              ?>
          </div>
          <span data-u="arrowleft" class="slider1left" style="top:0px;left:10px;width:40px;height:58px;" data-autocenter="2"></span>
          <span data-u="arrowright" class="slider1right" style="top:0px;right:10px;width:40px;height:58px;" data-autocenter="2"></span>
        </div>
</div>
<img style="display: table; margin: auto;" src="<?php echo $domainname; ?>images/banner-home.png" alt="Cara Main WinLiga" />
<div class="container">
    <div>
      <!--  <a class="ads-home-mid" href="#"><img src="#"></a> -->
    <!--    <a class="ads-home-mid" href="#"><img src="#" /></a> -->
    </div>
  
  <img src="<?php echo $domainname; ?>images/jadwal-bank.png" alt="Jadwal Bank WinLiga" />
  <div class="daftar-home">
    <p class="daftar-title">Daftar</p>
    <form action="" method="post">
    <table>
      <tr>
        <td>
          <div class="form-group1 form-group">
            <select class="form-control1 wajibinput form-control" name="permainan" info="Permainan">
              <?php if (!isset($permainan)) $permainan = ""; ?>
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
        </td>
        <td>
          <?php
          $banklist = array("BCA", "Mandiri", "BNI", "BRI", "Danamon");
          ?>
          <div class="form-group1 form-group">
            <?php if (!isset($bank)) $bank = ""; ?>
            <select class="form-control1  form-control wajibinput" id="bank" placeholder="Bank" name="bank">
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
        </td>
      </tr>
      <tr>
        <td>
          <div class="form-group1 form-group">
            <input type="text" class="form-control1 form-control wajibinput" id="email" placeholder="Email" name="email" value="<?php if (isset($email)) echo $email; ?>">
          </div>
        </td>
        <td>
          <div class="form-group1 form-group">
            <input class="form-control1 form-control wajibinput" id="namabank" placeholder="Nama Rekening" name="namabank" value="<?php if (isset($namabank)) echo $namabank; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="form-group1 form-group">
            <input class="form-control1 form-control wajibinput" id="hp" placeholder="Handphone" name="hp" value="<?php if (isset($hp)) echo $hp; ?>">
          </div>
        </td>
        <td>
           <div class="form-group1 form-group">
            <input class="form-control1 form-control wajibinput" id="nomorrek" placeholder="Nomor Rekening" onkeypress='validate(event)' name="nomorrek" value="<?php if (isset($nomorrek)) echo $nomorrek; ?>">
      </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="form-group1 form-group">
            <input class="form-control1 form-control validasiinput wajibinput" maxlength="5" id="validasi" placeholder="Validasi" name="validasi" style="width: 90px;"> <img class="validasiimage" src="_validasiimage.php" width="95" height="27" alt="Acak" />
          </div>
        </td>
        <td>
          <div class="form-group1 form-group">
            <button type="submit" name="daftar" class="btn-primary" value="1" style="padding: 3px 27px;">DAFTAR</button>
          </div>
        </td>
      </tr>
    </table>
  </form>
  </div>
  <div class="about-us">
    <?php 
    $qr0 = mysqli_query(fOpenConn(), "SELECT cnt_isi FROM mscontent WHERE cnt_id = 'About Us' LIMIT 1");
    $rs0 = mysqli_fetch_object($qr0);
    echo $rs0->cnt_isi;
    ?>
  </div>
</div>
<?php
require_once '_footer.php';
?>