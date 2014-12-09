<?php
	class yonlendir extends controller{
		public function __construct(){
			include "config.php";
			echo '<a href="'.$data["doc"].'anasayfa">Devam etmek icin tiklayin</a>';
		}
		public function yonlendir($q){}
	}
?>