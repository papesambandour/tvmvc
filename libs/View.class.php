<?php
     class View
     {
         public function load()
         {
             $num = func_num_args();
             $args = func_get_args();
             switch($num){
                 case  1:
                     $this->charger($args[0]);
                     break;
                 case 2:
                     $this->charger($args[0],$args[1]);
                     break;
             }
         }
         private function charger($page, $data = array())
         {
            // $data = $data;
             extract($data);
             $page = 'view/'.$page.'.php';
             if(file_exists($page))
          return  require_once $page;
             else
                 echo "la view ".$page." n'existe pas!!!!";
         }
     }