<?php
	if($giris){
?>
	<?php
		@include "system/mysql.php";
		@include "system/site.php";
		@include "system/doc.php";
		@include "system/version.php";
	?>
	<h5 class="baslik">Colak MVC v <?php echo $version; ?></h5>
	Versiyon : <font class="sistemiyi"><?php echo $version; ?></font><br />
	Versiyon Hakkında :
	<?php
		if($currentVersion){
			if($version==$currentVersion){
			?> <font class="sistemiyi">Güncel.</font> <?php
			}else{
			?> <font class="sistemKotu">Güncel Değil. Çalıştır : (<a href="index.php?fonksiyon=system:update">system:update</a>)</font> <?php
			}
		}
		else{
		?>
		<font class="sistemKotu">Denetlenemiyor.</font>
		<?php
		}
	?>
	<br />
	Güncel Versiyon : <?php if($currentVersion){ echo $currentVersion; }else{ ?> <font class="sistemKotu">Denetlenemiyor.</font> <?php } ?>
	<br />
	<h6 class="baslik">Veritabanı</h6>
	Server : <font class="sistemiyi"><?php echo $mysql["site"]; ?></font><br />
	Veritabanı Kullanıcı Adı : <font class="sistemiyi"><?php echo $mysql["kadi"]; ?></font><br />
	Veritabanı Kullanıcı Şifre : <font class="sistemiyi"><?php if($mysql["sifre"]==""){?> "boş" <?php }else{ echo $mysql["sifre"]; } ?></font><br />
	Seçilen Veritabanı : <font class="sistemiyi"><?php echo $mysql["db"]; ?></font><br />
	<h6 class="baslik">Site Bilgi</h6>
	Site Linki : <font class="sistemiyi" style="font-size:13px;"><a href="<?php echo $data["site"]; ?>" target="_blank"><?php echo $data["site"]; ?></a></font><br />
	Döküman Linki : <font class="sistemiyi" style="font-size:13px;"><a href="<?php echo $data["doc"]; ?>" target="_blank"><?php echo $data["doc"]; ?></a></font><br />
	<h6 class="baslik">Yedekleme</h6>
	<?php
		$sonYedekleme=@file_get_contents("../backups/sonYedeklemeTarih.txt");
		if($sonYedekleme!=""){
		?>
		Son Yedekleme <font class="sistemiyi"><?php echo $sonYedekleme; ?> tarihinde yapılmış.</font>
		<?php
		}
		else{
		?>
		<font class="sistemKotu">Yedekleme Bulunamadı. Çalıştır <a href="index.php?fonksiyon=system:backup">system:backup</a></font>
		<?php
		}
	?>
	<?php
	}else{}
	?>
	