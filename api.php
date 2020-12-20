  
<?php 
class Api extends Rest {

		
		public function __construct() {
			parent::__construct();
		}

		public function generateToken() {
			$email = $this->validateParameter('Email', $this->param['Email'], STRING);
			$pass = $this->validateParameter('Mdp', $this->param['Mdp'], STRING);
			try {

				$stmt = $this->con->prepare("SELECT * FROM administrateur WHERE email= :email AND pass= :pass");
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":pass", $pass);
				$stmt->execute();
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				if(!is_array($user)) {
					$this->returnResponse(INVALID_USER_PASS, "Email or Password is incorrect.");
				}

				if( $user['active'] == 0) {
					$this->returnResponse(USER_NOT_ACTIVE, "User is not activated. Please contact to admin.");
				}

				$paylod = [
					'iat' => time(),
					'iss' => 'localhost',
					'exp' => time() + (15*60),
					'userId' => $user['id']
				];

				$token = JWT::encode($paylod, SECRETE_KEY);
				
				$data = ['token' => $token];
				$this->returnResponse(SUCCESS_RESPONSE, $data);
			} catch (Exception $e) {
				$this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
			}
		}
//****** Les fonctions CRUD DE L'UTILISATEUR******************///////


		public function addUser() {
			$Nom = $this->validateParameter('Nom', $this->param['Nom'], STRING, false);
			$Prenom = $this->validateParameter('Prenom', $this->param['Prenom'], STRING, false);
			$Email = $this->validateParameter('Email', $this->param['Email'], STRING, false);
			$num_tel = $this->validateParameter('num_tel', $this->param['num_tel'], STRING, false);
			$adresse = $this->validateParameter('adresse', $this->param['adresse'], STRING, false);
			$date_naiss = $this->validateParameter('date_naiss', $this->param['date_naiss'], STRING, false);
			$uidFirebase = $this->validateParameter('uidFirebase', $this->param['uidFirebase'],STRING , false);
			$Mdp = $this->validateParameter('Mdp', $this->param['Mdp'], STRING, false);

			$cust = new User;
			$cust->setNom($Nom);
			$cust->setPrenom($Prenom);
			$cust->setEmail($Email);
			$cust->setNumero($num_tel);
			$cust->setAdresse($adresse);
			$cust->setDate($date_naiss);
			$cust->setFirebase($uidFirebase);
			$cust->setMdp($Mdp);
			$cust->setCreatedOn(date('Y-m-d'));
			

			if(!$cust->insert()) {
				$message = 'Failed to insert.';
			} else {
				$message = "Inserted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

		public function getUserDetails() {
			$userId = $this->validateParameter('userId', $this->param['userId'], INTEGER);

			$cust = new User;
			$cust->setId($userId);
			$customer = $cust->getUser();
			if(!is_array($customer)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'User details not found.']);
			}

			$response['userId'] 	= $customer['id'];
			$response['Nom'] 	= $customer['Nom'];
			$response['Prenom'] 		= $customer['Prenom'];
			$response['Email'] 		= $customer['Email'];
			$response['num_tel'] 		= $customer['num_tel'];
			$response['adresse'] 		= $customer['adresse'];
			$response['date_naiss'] 	= $customer['date_naiss'];
			$response['uidFirebase'] 	= $customer['uidFirebase'];
			$response['Mdp'] 	= $customer['Mdp'];
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}
			public function getAll() {

			
			$cust = new User;
			$data[]  = $cust->readAll();
			if(!is_array($data)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'User information not found.']);
			}

			$response[] = $data;
	
		
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}

		public function update() {

		
			
			$cust = new User;
		

			$cust->updateUser();



			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

		public function deleteCustomer() {
			$customerId = $this->validateParameter('userId', $this->param['id'], INTEGER);

			$cust = new User;
			$cust->setId($customerId);

			if(!$cust->delete()) {
				$message = 'Failed to delete.';
			} else {
				$message = "deleted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}


		//****** FIN******************///////




		//****** Les fonctions CRUD DE L'ATICLE******************///////

		public function add() {
			$libelle_prod = $this->validateParameter('libelle_prod', $this->param['libelle_prod'], STRING, false);
			$Prix_prod = $this->validateParameter('prix_prod', $this->param['prix_prod'], DOUBLE, false);
			$Contact_vend = $this->validateParameter('contact_vend', $this->param['contact_vend'], INTEGER, false);

			$cust = new Articles;
			$cust->setLibelle($libelle_prod);
			$cust->setPrix($Prix_prod);
			$cust->setContact($Contact_vend);
			$cust->setCreatedOn(date('Y-m-d'));
			

			if(!$cust->insertArticle()) {
				$message = 'Failed to insert.';
			} else {
				$message = "Inserted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

		public function getArticleDetails() {
			$articleId = $this->validateParameter('articleId', $this->param['articleId'], INTEGER);

			$cust = new Article;
			$cust->setId($articleId);
			$customer = $cust->getArticles();
			if(!is_array($customer)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'Article details not found.']);
			}

			$response['articleId'] 	= $customer['id'];
			$response['libelle_prod'] 	= $customer['libelle_prod'];
			$response['prix_prod'] 		= $customer['prix_prod'];
			$response['contact_vend'] 		= $customer['contact_vend'];
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}
			public function getAllArticles() {

			
			$cust = new Article;
			$data[]  = $cust->readAllArticles();
			if(!is_array($data)) {
				$this->returnResponse(SUCCESS_RESPONSE, ['message' => 'Articles information not found.']);
			}

			$response[] = $data;
	
		
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}

		public function updateArticles() {

	       $userId = $this->validateParameter('userId', $this->param['userId'], INTEGER);
			$Nom = $this->validateParameter('Nom', $this->param['Nom'], STRING, false);
			$Prenom = $this->validateParameter('Prenom', $this->param['Prenom'], STRING, false);
			$num_tel = $this->validateParameter('num_tel', $this->param['num_tel'], STRING, false);
			$adresse = $this->validateParameter('adresse', $this->param['adresse'], STRING, false);
			$Mdp = $this->validateParameter('Mdp', $this->param['Mdp'], STRING, false);
		
			
			$cust = new User;
			$cust->setId($userId);
			$cust->setNom($Nom);
			$cust->setPrenom($Prenom);
			$cust->setNumero($num_tel);
			$cust->setAdresse($adresse);
			$cust->setMdp($Mdp);
			$cust->setUpdatedOn(date('Y-m-d'));
            $response =$cust->updateUser();

			if(!$response) {
				$message = 'Failed to update.';
			} else {
				$message = "Updated successfully.";
			}



			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

		public function deleteArticles() {
			$articleId = $this->validateParameter('articleId', $this->param['article_id'], INTEGER);

			$cust = new Article;
			$cust->setId($articleId);

			if(!$cust->deleteArt()) {
				$message = 'Failed to delete.';
			} else {
				$message = "deleted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}


	}
	
 ?>