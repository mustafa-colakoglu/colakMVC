<?php
	class cont extends controller{
		public function __construct($q){
			parent::__construct();
			$this->$q[0]($q);
		}
		public function cont($q){
			$a=$this->load->model($q[0]);/* model dosyalar�m�z� include ettik */
			$data=$a->veriler($q);/*Verimizi ald�k */
			$this->load->view($q[0],$data);/* view dosyam�z� include ettik $data de�i�kenimizi de g�nderdik */
		}
	}
?>