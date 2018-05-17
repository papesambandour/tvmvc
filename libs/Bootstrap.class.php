<?php
    class Bootstrap
    {
        public function __construct()
        {
            new Model();
            if(isset($_GET['url']))
            {
                $url = explode('/',$_GET['url']);
                //echo $url{0};
                $controller = 'controller/'.$url[0].'Controller.class.php';
                if(file_exists($controller))
                {
                    require_once $controller;
                    $controller_obj = new $url[0]();
                    if(isset($url[2]))
                    {
                        if(method_exists($controller_obj,$url[1]))
                        {
                           $m =$url[1];
                            $controller_obj->$m($url[2]);
                        }else
                        {
                            echo "la methode ".$url[1]." n'existe pas";
                        }
                    }elseif(isset($url[1]))
                    {
                        if(method_exists($controller_obj,$url[1]))
                        {
                            $m =$url[1];
                            $r = new ReflectionMethod($url[0],$url[1]);
                            $params = $r->getParameters();
                            if(count($params)== 0)
                            {
                                $controller_obj->$m();
                            }else{
                                die("la methode<b> ".$url[1]."</b> a un parameter");
                            }
                        }else
                        {
                            if($url[1]==""){
                                $this->testIndex($controller_obj);
                            }else{
                                echo "la methode ".$url[1]." n'existe pas";
                            }
                        }
                    }else
                    {
                        $this->testIndex($controller_obj);
                    }
                  //  echo "le controller  ".$url[0]."  existe";
                }else{
                    echo "le controller<b>  ".$url[0]."</b>  n'existe pas";
                }
            }else
            {//GESTION DE LA PAGE D'ACCUEIL de l'application
               $welcome = DefaultControllerConfig::loadDefault()['controller_name'];
                $welcome_controller_file =  'controller/'.$welcome.'Controller.class.php';
                if(file_exists($welcome_controller_file))
                {
                    require_once $welcome_controller_file;
                    $controller = new $welcome();
                    $this->testIndex($controller);
                }else{
                    die("the configuration of your default controller isn't good");
                }
            }
        }
        /**
         * @param $controller_obj
         */
        public function testIndex($controller_obj)
        {
            if (method_exists($controller_obj, "index")) {
                $controller_obj->{"index"}();
            } else {
                echo "le controller index n'existe pas";
            }
        }
    }
?>