<?php
	class hataModel extends model{
		public function __construct(){
			parent::__construct();
		}
		public function modelSec(){
			$data=array();
			include "config.php";
			return $data;
		}
		public function __destruct(){
			$db=null;
		}
	}
	
?>