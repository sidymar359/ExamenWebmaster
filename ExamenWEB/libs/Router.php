<?php
class Router{


  public function getRoute(){
      
      try{
        //Scenerio Nominal ou Alternatif
        //1)autoloading => changement automatique des classes
          spl_autoload_register(function ($class) {
            $pathLibs = "./libs/".$class.".php";
            $pathModels = "./models/".$class.".php";
            $pathControlers = "./controllers/".$class.".php";

            if (file_exists($pathLibs)) {
                require  $pathLibs; 
            }elseif(file_exists( $pathControlers)){
              require  $pathControlers; 
            }elseif(file_exists($pathModels )){
              require  $pathModels; 
            } 
        });
     //2-Selectionner le Controller et executé une methode de ce controller
     //en se basant sur l'url =>controller/action/parametre1/parametre1/ ..../parametren
    
        if(isset($_GET['url'])){
          
          //transforme url en tableau
           $url=explode("/", $_GET['url']);
           
           //Convertir Premeire lettre du Controller en Majuscule
          $controller=ucfirst($url[0]);
          $pathControlers = "./controllers/".$controller.".php";
          //Controller Existe
          if(file_exists($pathControlers)){
            $cont=new $controller($url);
            //Action  Existe
            if(isset($url[1])){
              //Methode Existe dans le Controller
               if(method_exists($cont,$url[1])){
               // var_dump( $cont);
                $action=$url[1];
                unset($url[0]);
                unset($url[1]);
                $cont->{$action}();
             
             
               }else{
                   //Methode  n'Existe pas dans le Controller
                   $ctrl=new Commentaire();
                   
               }

               
            }
         
          }
         
        }
     
      }catch(Exception $ex){

         //Scenario Exception
          die("Error");
      }
  }
}