<?php
require_once 'includes/headpage.php';
$url   = $_SERVER["REQUEST_URI"];
$pecah = explode('/',$url);
$page  = $pecah[1];
switch($page) {
	case 'promo':
		include 'm_promo.php';
		break;

	case 'livescore':
		include 'm_livescore.php';
		break;

	case 'daftar':
		include 'm_daftar.php';
		break;

	case 'sportsbook':
		include 'm_sportsbook.php';
		break;

	case 'casino':
		include 'm_casino.php';
		break;

	case 'info-bola':
		include 'm_infobola.php';
                break;

	case 'berita':
		if (isset($pecah[2]))
		{
			$artikelid = antiinjectionmain($pecah[2]);
			$qr0 = mysqli_query(fOpenConn(), "SELECT art_id FROM msartikel WHERE art_id = '$artikelid' AND art_tgl <= now() LIMIT 1");
		    if (mysqli_num_rows($qr0) > 0)
			    include 'm_infobola_detail.php';
			else
				include 'm_infobola.php';
		}
		else
			include 'm_infobola.php';
		break;

	case 'games':
		if (isset($pecah[2]))
		{
			$gamesid = urldecode(antiinjectionmain($pecah[2]));
			$qr0 = mysqli_query(fOpenConn(), "SELECT gm_id FROM msgames WHERE gm_nama = '$gamesid' AND gm_active = 'a' LIMIT 1");
		    if (mysqli_num_rows($qr0) > 0)
			    include 'm_games.php';
			else
				include 'm_home.php';
		}
		else
			include 'm_home.php';
		break;
		break;
	

	default:
		require_once "m_home.php";
		break;
}
?>
