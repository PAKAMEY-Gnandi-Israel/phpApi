<?php 

class Access
{// Connexion a la base de donnee Mysql
  public function connection(){
   try{
    //Au cas ou tout se passe bien
     $bdd = new pdo('mysql:host=localhost:3308; dbname=test','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "";
    }catch(PDOException $e){
    //S'il ya une erreur  
    echo "Une erreur est survenue".$e->getMessage();
  }
  return $bdd;
 } 
}


 $ac = new Access();
 $test=$ac->connection();

?>