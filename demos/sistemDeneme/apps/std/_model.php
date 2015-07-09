<?php
	class Model extends model{
		public function __construct(){
			parent::__construct();
		}
		public function veriler($q){
			$data=array();
			include "config.php";
			$data["yazilar"]=$this->select("yazilar","","baslik","","yazilar","30");
			return $data;
		}
		public function __destruct(){
			$db=null;
		}
	}
?>