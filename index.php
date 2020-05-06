<?php
session_start();
require('controller/frontend.php');
require('controller/backend.php');

try { // On essaie de faire des choses

    if (isset($_GET['action'])) {
        if($_GET['action'] == 'login'){
                login();
        }
        elseif($_GET['action'] == 'logout'){
                logout();
        }
        elseif($_GET['action'] == 'updatePost'){
                updatePost();   
        }
        elseif($_GET['action'] == 'createPost'){
                createPost();       
        }

        elseif ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment']));
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
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
   echo 'Erreur :' . $errorMessage = $e->getMessage();
    
}