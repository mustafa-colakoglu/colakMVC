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
			$className=$dosya."Model";
			return new $className();
		}
		public function view($dosya,$data=false){
			if($data){
				extract($data);
			}
			include "apps/view/".$dosya."_view.php";
		}
		public function controller($q){
			$q=explode("/",$q);
			if($q[0]==""){
				include "apps/controller/anasayfa.php";
				$controller=new anasayfa(array("anasayfa"));
			}
			else{
				if(is_file("apps/controller/".$q[0].".php")){
					include "apps/controller/".$q[0].".php";
					$controller=new $q[0]($q);
				}
				else{
					include "apps/controller/hata.php";
					$controller=new hata();
				}
			}
		}
		public function plugin($plugin){
			if(file_exists("plugins/".$plugin."_plugin.php")){
				include "plugins/".$plugin."_plugin.php";
				return new $plugin();
			}else{}
		}
	}
?>