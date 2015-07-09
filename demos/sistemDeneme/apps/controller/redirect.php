<?php
	class redirect extends controller{
		public function __construct($q){
			parent::__construct();
			$this->$q[0]($q);
		}
		public function redirect($q){
			$a=$this->load->model($q[0]);/* model dosyalarýmýzý include ettik */
			$data=$a->veriler($q);/*Verimizi aldýk */
			$this->load->view($q[0],$data);/* view dosyamýzý include ettik $data deðiþkenimizi de gönderdik */
		}
	}
?>