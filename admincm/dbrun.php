<?php
function dblama() {
	if ($conn = mysqli_connect("localhost","root","")) {
		if (mysqli_select_db($conn,"bandarb_bandar855")) {
			return $conn;
		}
	}
	else
	{
		echo "error fOpenConn<BR>";
		echo mysqli_error() . "<br>";
		return NULL;
	}
}

function dbbaru() {
	if ($conn = mysqli_connect("localhost","root","")) {
		if (mysqli_select_db($conn,"bandarb_bb855")) {
			return $conn;
		}
	}
	else
	{
		echo "error fOpenConn<BR>";
		echo mysqli_error() . "<br>";
		return NULL;
	}
}


$qr1 = mysqli_query(dblama(), "SELECT fulname FROM tb_member GROUP BY fulname");
while ($rs1 = mysqli_fetch_object($qr1)) {
	mysqli_query(dbbaru(), "INSERT INTO msgames (gm_nama, gm_active) VALUES ('$rs1->fulname', 'a')");
mysqli_query(dbbaru(), "INSERT INTO mscontent (cnt_id) VALUES ('$rs1->fulname')");
}

$qr1 = mysqli_query(dblama(), "SELECT * FROM tb_member");
while ($rs1 = mysqli_fetch_object($qr1)) {
	$status = "Tolak";
	if ($rs1->contact_number == "disetujui")
		$status = "Setuju";

	$qr0 = mysqli_query(dbbaru(), "SELECT gm_id FROM msgames WHERE gm_nama = '$rs1->fulname'");
	$rs0 = mysqli_fetch_object($qr0);
	mysqli_query(dbbaru(), "INSERT INTO msmember (mbr_nama, mbr_email, mbr_hp, mbr_games, mbr_namabank, mbr_namarek, mbr_norek, mbr_status, mbr_ip, mbr_createtm, mbr_gameid, mbr_gamepass, mbr_updatetm, mbr_handleby, mbr_updateby) VALUES ('$rs1->account_name', '$rs1->email', '$rs1->phone_number', '$rs0->gm_id', '$rs1->bank_name', '$rs1->account_name', '$rs1->account_number', '$status', '$rs1->address', '$rs1->register_date', '$rs1->idgameuser', '$rs1->passgameuser', '$rs1->last_update', 'System', 'System')");
}

/*
$qr1 = mysqli_query(dblama(), "SELECT * FROM tblartikel");
while ($rs1 = mysqli_fetch_object($qr1)) {
	mysqli_query(dbbaru(), "INSERT INTO msartikel (art_tgl, art_judul, art_isi, art_kategory, art_deskripsi, art_keyword, art_gambar) VALUES ('$rs1->tgl_artikel', '$rs1->judul_artikel', '$rs1->isi_artikel', '$rs1->id_kategori', '$rs1->deskripsi', '$rs1->keyword', 'no-image.jpg')");
	$qr0 = mysqli_query(dbbaru(), "SELECT art_id FROM msartikel ORDER BY art_id DESC LIMIT 1");
        $rs0 = mysqli_fetch_object($qr0);
        $justinsertid = $rs0->art_id;
        $uploadgambar = "../artikel/".$justinsertid."-no-image.jpg";
        copy ("../images/no-image.jpg", $uploadgambar) or die ("Could not copy");
}*/
?>