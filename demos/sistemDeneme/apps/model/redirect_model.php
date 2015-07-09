<?php
	class redirectModel extends model{
		public function __construct(){
			parent::__construct();
		}
		public function veriler($q){
			$data=array();
			include "config.php";
			return $data;
		}
		public function __destruct(){
			$db=null;
		}
	}
?>