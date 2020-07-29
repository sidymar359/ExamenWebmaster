<?php
class CommentaireManager {
    private $pdo=null;
    protected $className;
    protected $tableName;

    private function getConnexion(){
      //Connexion est fermée
      if($this->pdo==null){
          try{
            $this->pdo = new PDO("mysql:host=localhost;dbname=webmaster","root","");
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
          }catch(PDOException $ex){
             die("Erreur de Connexion");
          }
        
      }
      
  }

 private function closeConnexion(){
      
    if($this->pdo!=null){
      $this->pdo=null;
    }
  }

  public function executeUpdate($sql){
    $this->getConnexion();
     $nbreLigne= $this->pdo->exec($sql);
    $this->closeConnexion();
    return $nbreLigne;
}

public function executeSelect($sql){

        $this->getConnexion();

        $result=$this->pdo->query($sql);
        $data=[];
        foreach( $result as $rowBD){
        $data[]=new $this->className($rowBD);     
        }
        $this->closeConnexion();
        return $data;

}

    public function Insert ($sql){
        $sql="insert into $this->tableName";
        $data=$this->executeSelect($sql);
    }

    public function findAll(){
        $sql="select * from $this->tableName";
        $data=$this->executeSelect($sql);
        var_dump($data);
    }
    

}