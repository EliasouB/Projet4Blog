<?php

namespace Blog;

use Blog\Controller\BackController;
use Blog\Controller\FrontController;



class Router 	{

	private $backController;
	private $frontController;

	public function __construct(){
		$this->backController = new BackController();
		$this->frontController = new FrontController();
	}

	public function route(){
		try { // On essaie de faire des choses

		    if (isset($_GET['action'])) {
		        if($_GET['action'] == 'login'){
		                $this->backController->login();
		        }
		        elseif($_GET['action'] == 'logout'){
		                $this->backController->logout();
		        }
		        elseif($_GET['action'] == 'createPost'){
		                $this->backController->createPost();       
		        }
		        elseif($_GET['action'] == 'deletePost'){
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                    $this->backController->setDeletePost($_GET['id']);       
		                }
		        }
		        elseif($_GET['action'] == 'deleteComment'){
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                    $this->backController->setDeleteComment($_GET['id']);       
		                }
		        }
		        elseif ($_GET['action'] == 'updatePost') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                     $this->backController->changePost($_GET['id']);
		                }  
		        }    
		        elseif ($_GET['action'] == 'admin'){
		                $this->backController->adminIndex();    
		        }
		        elseif ($_GET['action'] == 'listPosts') {
		            $this->frontController->listPosts();
		        }
		        elseif ($_GET['action'] == 'reportComment') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                $this->frontController->reportComment($_GET['id']);
		            }
		            else {
		                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
		                throw new Exception('Aucun identifiant de commentaire');
		            }
		        }
		        elseif ($_GET['action'] == 'deleteReport') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                $this->backController->deleteReport($_GET['id']);
		            }
		            else {
		                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
		                throw new Exception('Aucun identifiant de commentaire');
		            }
		        }
		        elseif ($_GET['action'] == 'post') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                $this->frontController->post();
		            }
		            else {
		                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
		                throw new Exception('Aucun identifiant de billet envoyé');
		            }
		        }
		        elseif ($_GET['action'] == 'addComment') {
		            if (isset($_GET['id']) && $_GET['id'] > 0) {
		                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
		                    $this->frontController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
		                }
		                else {
		                    // Autre exception
		                    throw new \Exception(' Tous les champs ne sont pas remplis !');
		                }
		            }
		            else {
		                // Autre exception
		                throw new \Exception('Aucun identifiant de billet envoyé');
		            }
		        }
		    }
		    else {
		        $this->frontController->listPosts();
		    }
		}
		catch(\Exception $e) { // S'il y a eu une erreur, alors...
			$this->frontController->error($e->getMessage());
		}
	}
}