<?php
	if($_POST){
		$dizi=array();
		foreach($_POST as $key=>$value){
			if($key=="sayfa"){
				
			}else{
				$value=clk::bulDegistir("/","",$value);
				array_push($dizi,$value);
			}
		}
		header("Location:".$site."/".$_POST["sayfa"]."/".implode("/",$dizi));
	}
	else{
		header("Location:".$site."/anasayfa");
	}
?>