
  
<?php 


	class User {
		private $id;
		private $Nom;
		private $Prenom;
		private $Email;
		private $num_tel;
		private $adresse;
		private $date_naiss;
		private $uidFirebase;
		private $Mdp;
	    private $tableName ='users';
		private $con;
		private $updatedOn;
		private $createdOn;

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setNom($nom) { $this->Nom = $nom; }
		function getNom() { return $this->Nom; }
		function setPrenom($prenom) { $this->Prenom = $prenom; }
		function getPrenom() { return $this->Prenom; }
		function setEmail($email) { $this->Email = $email; }
		function getEmail() { return $this->Email; }
		function setNumero($num_tel) { $this->num_tel = $num_tel; }
		function getNumero() { return $this->num_tel; }
		function setAdresse($adresse) { $this->adresse = $adresse; }
		function getAdresse() { return $this->adresse; }
		function setDate($date_naiss) { $this->date_naiss = $date_naiss; }
		function getDate() { return $this->date_naiss; }
		function setFirebase($uidFirebase) { $this->uidFirebase = $uidFirebase; }
		function getFirebase() { return $this->uidFirebase; }
		function setMdp($Mdp) { $this->Mdp = $Mdp; }
		function getMdp() { return $this->Mdp; }
		function setUpdatedOn($updatedOn) { $this->updatedOn = $updatedOn; }
		function getUpdatedOn() { return $this->updatedOn; }
		function setCreatedOn($createdOn) { $this->createdOn = $createdOn; }
		function getCreatedOn() { return $this->createdOn; }

		public function __construct() {

             $ac = new Access();
            $this->con= $ac->connection();
		
		}
		  public function readAll() {
    
	$stmt = $this->con->prepare("SELECT * FROM users" );
			$stmt->execute();
			$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $customers;
    }

  public function getUser(){
    $sql = "SELECT *
						FROM users  WHERE 
						users.id= :userId";

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':userId', $this->id);
			$stmt->execute();
			$customer = $stmt->fetch(PDO::FETCH_ASSOC);
			return $customer;

      }
      	public function insert() {
			
			$sql = 'INSERT INTO ' . $this->tableName . '( id,Nom, Prenom, Email, num_tel, adresse, date_naiss ,uidFirebase,Mdp , created_on) VALUES(null,:Nom, :Prenom, :Email, :num_tel, :adresse, :date_naiss , :uidFirebase , :Mdp ,:createdOn)';

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':Nom', $this->Nom);
			$stmt->bindParam(':Prenom', $this->Prenom);
			$stmt->bindParam(':Email', $this->Email);
			$stmt->bindParam(':num_tel', $this->num_tel);
			$stmt->bindParam(':adresse', $this->adresse);
			$stmt->bindParam(':date_naiss', $this->date_naiss);
			$stmt->bindParam(':uidFirebase', $this->uidFirebase);
			$stmt->bindParam(':Mdp', $this->Mdp);
			$stmt->bindParam(':createdOn', $this->createdOn);
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateUser() {
			
			$sql = "UPDATE users  SET";
			if( '' != $this->getNom()) {
				$sql .=	"Nom = '" . $this->getNom() . "',";
			}
			if( '' != $this->getPrenom()) {
				$sql .=	" Prenom = '" . $this->getPrenom() . "',";
			}
		
			if( '' != $this->getNumero()) {
				$sql .=	" num_tel = '" . $this->getNumero() . "',";
			}
			if( '' != $this->getAdresse()) {
				$sql .=	" adresse = '" . $this->getAdresse() . "',";
			}

			if( '' != $this->getMdp()) {
				$sql .=	" Mdp = " . $this->getMdp() . ",";
			}

			$sql .=	" updated_on = :updatedOn
					WHERE 
						id = :Id";

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':Id', $this->id);
			$stmt->bindParam(':updatedOn', $this->updatedOn);
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function delete() {
			$stmt = $this->con->prepare('DELETE FROM ' . $this->tableName . ' WHERE id = :userId');
			$stmt->bindParam(':userId', $this->id);
			
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}
  

 ?>