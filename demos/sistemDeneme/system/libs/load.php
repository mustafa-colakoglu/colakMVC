<?php
	class load{
		public function __construct(){
			/* $plugins=array();
			if(count($plugins)<1){}
			else{
				for($i=0;$i<count($plugins);$i++){
					$this->plugin($plugins[$i]);
				}
			}*/
		}
		public function model($dosya){
			include "apps/model/".$dosya."_model.php";
		}
		public function view($dosya,$data=false){
			if($data){
				extract($data);
			}
			include "apps/view/".$dosya."_view.php";
		}
		public function plugin($plugin){
			if(file_exists("plugins/".$plugin."_plugin.php")){
				include "plugins/".$plugin."_plugin.php";
				return new $plugin();
			}else{}
		}
	}
?>