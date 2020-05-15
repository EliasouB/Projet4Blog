<?php
session_start();
require('controller/FrontController.php');
require('controller/BackController.php');


$backController = new BackController();
$frontController = new FrontController();

try { // On essaie de faire des choses

    if (isset($_GET['action'])) {
        if($_GET['action'] == 'login'){
                $backController->login();
        }
        elseif($_GET['action'] == 'logout'){
                $backController->logout();
        }
        elseif($_GET['action'] == 'createPost'){
                $backController->createPost();       
        }
        elseif($_GET['action'] == 'deletePost'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $backController->setDeletePost($_GET['id']);       
                }
        }
        elseif($_GET['action'] == 'deleteComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $backController->setDeleteComment($_GET['id']);       
                }
        }
        elseif ($_GET['action'] == 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                     $backController->changePost($_GET['id']);
                }  
        }    
        elseif ($_GET['action'] == 'admin'){
                $backController->adminIndex();    
        }
        elseif ($_GET['action'] == 'listPosts') {
            $frontController->listPosts();
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontController->reportComment($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de commentaire');
            }
        }
        elseif ($_GET['action'] == 'deleteReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backController->deleteReport($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de commentaire');
            }
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontController->post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontController->addComment($_GET['id'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment']));
                }
                else {
                    // Autre exception
                    throw new Exception(' Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        $frontController->listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
$frontController->error($e->getMessage());
    
}