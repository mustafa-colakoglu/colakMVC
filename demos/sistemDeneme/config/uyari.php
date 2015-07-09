<?php
	if($giris){
		$sayac=0;
		@include "system/mysql.php";
		$baglanDene=@mysql_connect($mysql["site"],$mysql["kadi"],$mysql["sifre"]);
		$dbSec=@mysql_select_db($mysql["db"]);
		if($baglanDene){}
		else{$sayac++;echo $sayac;?>-) Veri tabanına bağlanılamıyor. <br /><?php }
		if($dbSec){}
		else{$sayac++;echo $sayac;?>-) Seçilen veritabanı bulunamıyor. <br /><?php }
		@include "system/site.php";
		if(@file_get_contents(@$data["site"])){}
		else{$sayac++;echo $sayac;?>-) Site dizini bulunamıyor. <br /><div class="uyariDetay"><?php echo "'".@$data["site"]."'"; ?> bulunamıyor</div><?php }
		@include "system/doc.php";
		if(@file_get_contents(@$data["doc"])){}
		else{$sayac++;echo $sayac;?>-) Döküman (doc) dizini bulunamıyor. <br /><div class="uyariDetay"><?php echo "'".@$data["doc"]."'"; ?> bulunamıyor</div><?php }
		if($sayac==0){
		?>
		Sistemde herhangi bir problem bulunmuyor.
		<?php
		}
		else{
		?>
		Sistemde toplam <font color="red" style="float:none;display:inline-block;"><?php echo $sayac; ?></font> tane problem var.
		<?php
		}
	}
	else{}
?>