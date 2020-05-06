<?php

// Chargement des classes
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/entity/Post.php');
require_once('model/manager/AdminManager.php');



function checkAuthentification()
{
  if(!isset($_SESSION['id'])){
    throw new  Exception("Need authentication");
    
  }
}


function login()
{
	 if(isset($_POST['password']) && isset($_POST['username']) && $_POST['username'] != '' && $_POST['password'] != '') {
        $login = $_POST['username'];
        $pass = $_POST['password'];
        $loginManager = new AdminManager();
        $loginAdmin = $loginManager->getLogin($login);
        if ($loginAdmin === null){
            $_SESSION = array();
            session_destroy();
            $_SESSION['message'] = 'Mauvais identifiant ou mot de passe !';
        }
        else {
            
            $isPasswordCorrect = password_verify($pass, $loginAdmin['pass']);
            if ($isPasswordCorrect) {                     
                $_SESSION['id'] = $loginAdmin['id'];
                $_SESSION['login'] = $loginAdmin;
                header('Location: index.php?action=admin');
            }
            else {
                $_SESSION = array();
                session_destroy();
                $_SESSION['message'] = 'Mauvais identifiant ou mot de passe !';
            }
        }
    }
    else {
        $_SESSION['message'] = 'Vous devez remplir tous les champs';
    
    }
    header('Location: index.php');
}


function updatePost(){
    checkAuthentification();
    require('view/backend/updatePostView.phtml');
}

function createPost($title, $content){
    checkAuthentification();
    require('view/backend/createPostView.phtml');
}



function logout()
{
    $_SESSION = array();
    session_destroy();
}  