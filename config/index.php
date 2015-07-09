<?php include "key.php"; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Developer Interface</title>
	<style type="text/css">@import url("reset.css");</style>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<div class="uyari">
		<?php
			function bulDegistir($bul,$degistir,$yazi){
				$yeni="";
				for($i=0;$i<strlen($yazi);$i++){
					if($bul==substr($yazi,$i,strlen($bul))){
						$i+=strlen($bul)-1;
						$yeni=$yeni.$degistir;
					}
					else{
						$yeni=$yeni.$yazi[$i];
					}
				}
				return $yeni;
			}
			$giris=@$_SESSION["giris"];
			if($giris){
				if($_REQUEST){
					$gelen=@$_REQUEST["fonksiyon"];
					$gelen=explode(":",$gelen);
					$fonksiyon=@$gelen[0];
					$deger=@$gelen[1];
					if($fonksiyon=="islem"){
						if($deger=="goster"){
						?>
						<table class="islemler">
							<tr><td><b>Fonksiyon</b></td><td><b>Kullanım Şekli</b></td><td><b>Açıklama</b></td></tr>
							<tr>
								<td>islem</td>
								<td>islem:goster</td>
								<td>İşlemleri listelemek için kullanılır.</td>
							</tr>
							<tr>
								<td>mysql</td>
								<td>mysql:localhost,root,root,db</td>
								<td>Mysql veritabanı bilgilerini kaydetmek için kullanılır.localhost yerine kendi mysql serverınızı,root,root yerine kullanıcı adınızı ve şifrenizi,db yazan yere de seçilecek veritabanınızı yazabilirsiniz.</td>
							</tr>
							<tr>
								<td>doc</td>
								<td>doc:documents link</td>
								<td>Sitede kullanılan dökümanların (css,js vs) kaydolunduğu dizini kaydeder</td>
							</tr>
							<tr>
								<td>site</td>
								<td>site:site link</td>
								<td>Sitede link verme, yönlendirme gibi kullanılan temel linki kaydeder</td>
							</tr>
							<tr>
								<td>system</td>
								<td>system:update</td>
								<td>
								<b>system:update</b> komutuyla sistem güncellenir. <br />
								<b>system:backup</b> ile sistem in yedeği alınır. <br />
								<b>system:loadLastBackup</b> ile sistemin son yedeği geri yüklenir.
								loadLastBackup yerine load-backupDosya (Örn:<b>load-abc.zip</b>) yazılırsa o backup geri yüklenir.
								</td>
							</tr>
							<tr>
								<td>cikis</td>
								<td>cikis:key</td>
								<td>Çıkış yapmak için kullanılır. <b>cikis:key</b> şeklinde çıkış yapabilirsiniz</td>
							</tr>
							<tr>
								<td>key</td>
								<td>key:newkey</td>
								<td>Giriş Keyini değiştirmek için kullanılır.</td>
							</tr>
						</table>
						<?php
						}
					}
					else if($fonksiyon=="cikis"){
						if($deger==$key){
							$_SESSION["giris"]=false;
							$giris=false;
							?>
							<div class="mavi">Çıkış Başarılı</div>
							<?php
						}
						else{
							?>
							<div class="kirmizi">Çıkış Başarısız.</div>
							<?php
						}
					}
					else if($fonksiyon=="mysql"){
						$deger=explode(",",$deger);
						$mysqlSite=@$deger[0];
						$mysqlKadi=@$deger[1];
						$mysqlSifre=@$deger[2];
						$mysqlDb=@$deger[3];
						$dosya=fopen("system/mysql.php","w");
						fputs($dosya,'<?php
	$mysql["site"]="'.$mysqlSite.'";
	$mysql["kadi"]="'.$mysqlKadi.'";
	$mysql["sifre"]="'.$mysqlSifre.'";
	$mysql["db"]="'.$mysqlDb.'";
?>');
						fclose($dosya);
						?>
						<div class="mavi">Mysql Bilgileri Kaydedildi.</div>
						<?php
					}
					else if($fonksiyon=="key"){
						$dosya=fopen("key.php","w");
						fputs($dosya,'<?php
	$key="'.bulDegistir('"',"",$deger).'";
?>');
					$_SESSION["giris"]=false;
					?>
					<div class="mavi">Key değiştirildi. Çıkış yapıldı.</div>
					<?php
					}
					else if($fonksiyon=="doc"){
						$dosya=fopen("system/doc.php","w");
						fputs($dosya,'<?php
	$data["doc"]="'.rtrim(ltrim($_REQUEST["fonksiyon"],"doc:"),"/").'/";
?>');
					fclose($dosya);
					?>
					<div class="mavi">doc değişkeni kaydedildi.</div>
					<?php
					}
					else if($fonksiyon=="site"){
						$dosya=fopen("system/site.php","w");
						fputs($dosya,'<?php
	$data["site"]="'.rtrim(ltrim($_REQUEST["fonksiyon"],"site:"),"/").'";
?>');
					fclose($dosya);
					?>
					<div class="mavi">site değişkeni kaydedildi.</div>
					<?php
					}
					else if($fonksiyon=="system"){
						if($deger=="update"){
							if(@file_get_contents("http://mcolak.net/colakMVC/guncel.zip")){
								$al=copy("http://mcolak.net/colakMVC/guncel.zip","update.zip");
								if($al)
								{
									$zip=new ZipArchive();
									$zip->open("update.zip");
									@$zip->extractTo("../");
									@$zip->close("update.zip");
									unlink("./update.zip");
									?>
									<div class="mavi">Güncelleme Başarılı.</div>
									<?php
								}
								else{
								?>
									<div class="kirmizi">Güncelleme dosyası çekilemedi.</div>
								<?php
								}
							}
							else{
							?>
							<div class="kirmizi">Güncel versiyon çekilemiyor.</div>
							<?php
							}
						}
						else if($deger=="backup"){
							$zip = new ZipArchive();
							$zipSayac=0;
							function zipAdi($zipAdi){
								if(file_exists($zipAdi)){
									global $zipSayac;
									$zipSayac++;
									return zipAdi($zipAdi.$zipSayac);
								}
								else{
									return $zipAdi;
								}
							}
							$zipAdi="../backups/".date("d.m.Y").".".date("h.i.s");
							$zipAdi=zipAdi($zipAdi).".zip";
							$zip->open($zipAdi,ZipArchive::CREATE);
							@include "dirList.php";
							for($i=0;$i<count($dirList);$i++){
								$zip->addEmptyDir($dirList[$i]);
								$dizin="../".$dirList[$i]."/";
								$oku=opendir($dizin);
								while($dosya=readdir($oku)){
									if($dosya==".." || $dosya=="."){}
									else{
										if(is_file($dizin.$dosya)){
											$zip->addFile($dizin.$dosya,$dirList[$i].$dosya);
										}
										else{}
									}
								}
							}
							$zip->close();
							$dosya=fopen("../backups/sonYedekleme.txt","w");
							fputs($dosya,$zipAdi);
							fclose($dosya);
							$dosya=fopen("../backups/sonYedeklemeTarih.txt","w");
							fputs($dosya,date("d.m.Y")." - ".date("h.i.s"));
							fclose($dosya);
							?>
							<div class="mavi"><?php echo $zipAdi; ?> backup dosyası oluşturuldu.</div>
							<?php
						}
						else if($deger=="loadLastBackup"){
							$last=@file_get_contents("../backups/sonYedekleme.txt","r");
							$zip=new zipArchive();
							$zip->open($last);
							$zip->extractTo("../");
							?>
							<div class="mavi"><?php echo $last; ?> başarıyla geri yüklendi.</div>
							<?php
						}
						else{
							if(file_exists("../backups/".ltrim($deger,"load-"))){
								$zip=new zipArchive();
								$zip->open("../backups/".ltrim($deger,"load-"));
								$zip->extractTo("../");
								?>
								<div class="mavi"><?php echo ltrim($deger,"load-"); ?> başarıyla geri yüklendi.</div>
								<?php
							}
							else{
								?>
								<div class="kirmizi">Backup dosyası bulunamadı.</div>
								<?php
							}
						}
					}
					else{
					?>
					<div class="kirmizi">Böyle bir fonksiyon yok.</div>
					<?php
					}
				}
				else{
				?>
					<div class="sari">İşlemleri Görmek İçin (islem:goster) yazın</div>
				<?php
				}
			}
			else{
				if($_REQUEST){
					$gelen=@$_REQUEST["fonksiyon"];
					$gelen=explode(":",$gelen);
					$fonksiyon=@$gelen[0];
					$deger=@$gelen[1];
					if($fonksiyon=="giris"){
						if($deger==$key){
						$_SESSION["giris"]=1234;
						$giris=true;
						?>
							<div class="mavi">Giriş Yapıldı...</div>
						<?php
						}
						else{
						?>
							<div class="kirmizi">Key Yanlış!</div>
						<?php
						}
					}
					else{
					?>
						<div class="kirmizi">Geçersiz Fonksiyon. Öncelikle Giriş Yapın:(giris:key)</div>
					<?php
					}
				}
				else{
				?>
				<div class="kirmizi">Giriş Yapın!</div>
				<?php
				}
			}
		?>
	</div>
	<form action="index.php" method="post" class="form">
		<div class="fonksiyonKutu">
			Fonksiyon : <input type="text" name="fonksiyon" autofocus="autofocus" />
		</div>
	</form>
	<div class="uyarilar">
	<?php
		include "uyari.php";
	?>
	</div>
	<div class="sistemBilgileri">
		<?php
			@include "detay.php";
		?>
	</div>
<?php
	/*
		Kullanıcı Dosyaya yazmak yerine bu kısımdan halledicek
	*/
?>
</body>
</html>