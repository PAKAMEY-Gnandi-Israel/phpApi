
  
<?php 


	class Articles {
		private $id;
		private $libelle_prod;
		private $prix_prod;
		private $contact_vend;
	    private $tableName ='articles';
		private $con;
		private $updatedOn;
		private $createdOn;

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setLibelle($libelle_prod) { $this->libelle_prod = $libelle_prod; }
		function getLibelle() { return $this->libelle_prod; }
		function setPrix($prix_prod) { $this->prix_prod= $prix_prod; }
		function getPrix() { return $this->prix_prod; }
		function setContact($contact_vend) { $this->contact_vend = $contact_vend; }
		function getContact() { return $this->contact_vend; }
		function setUpdatedOn($updatedOn) { $this->updatedOn = $updatedOn; }
		function getUpdatedOn() { return $this->updatedOn; }
		function setCreatedOn($createdOn) { $this->createdOn = $createdOn; }
		function getCreatedOn() { return $this->createdOn; }

		public function __construct() {

             $ac = new Access();
            $this->con= $ac->connection();
		
		}
		  public function readAllArticles() {
    
	$stmt = $this->con->prepare("SELECT * FROM articles" );
			$stmt->execute();
			$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $customers;
    }

  public function getArticles(){
    $sql = "SELECT *
						FROM articles  WHERE 
						articles.id_prod= :articleId";

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':articleId', $this->id);
			$stmt->execute();
			$customer = $stmt->fetch(PDO::FETCH_ASSOC);
			return $customer;

      }
      	public function insertArticle() {
			
			$sql = 'INSERT INTO ' . $this->tableName . '( id_prod,libelle_prod, prix_prod, contact_vend, created_on) VALUES(null,:libelle_prod, :prix_prod, :contact_vend,:createdOn)';

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':libelle_prod', $this->libelle_prod);
			$stmt->bindParam(':prix_prod', $this->prix_prod);
			$stmt->bindParam(':contact_vend', $this->contact_vend);
			$stmt->bindParam(':createdOn', $this->createdOn);
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateArticles() {
			
			$sql = "UPDATE articles  SET";
			if( null != $this->getLibelle()) {
				$sql .=	"libelle_prod = '" . $this->getLibelle() . "',";
			}
			if( null != $this->getPrix()) {
				$sql .=	" prix_prod = '" . $this->getPrix() . "',";
			}
			if( null != $this->getContact()) {
				$sql .=	" contact_vend = '" . $this->getContact() . "',";
			}


			$sql .=	" updated_on = :updatedOn

					WHERE 
						id_prod = :articleId";

			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':articleId', $this->id);
			$stmt->bindParam(':updatedOn', $this->updatedOn);
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function deleteArt() {
			$stmt = $this->con->prepare('DELETE FROM ' . $this->tableName . ' WHERE id_prod = :articleId');
			$stmt->bindParam(':articleId', $this->id);
			
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}
  

 ?>