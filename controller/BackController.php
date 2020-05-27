<?php
namespace Blog\Controller;


use Blog\Model\Manager\AdminManager;

use Blog\Model\Manager\CommentManager;
use Blog\Model\Manager\PostManager;


class BackController
{
    
    function checkAuthentification()
    {
        if (!isset($_SESSION['id'])) {
            throw new Exception("Need authentication");
            
        }
    }
    function login() // Connexion à la partie administrateur
    {
        if (isset($_POST['password']) && isset($_POST['username']) && $_POST['username'] != '' && $_POST['password'] != '') {
            $login        = $_POST['username'];
            $pass         = $_POST['password'];
            $loginManager = new AdminManager();
            $loginAdmin   = $loginManager->getLogin($login);
            if ($loginAdmin === null) {
                $_SESSION = array();
                session_destroy();
                $_SESSION['message'] = 'Mauvais identifiant ou mot de passe !';
            } else {
                
                $isPasswordCorrect = password_verify($pass, $loginAdmin['pass']); // Vérifie que le mdp correspond au hachage
                if ($isPasswordCorrect) {
                    $_SESSION['id']    = $loginAdmin['id'];
                    $_SESSION['login'] = $loginAdmin;
                    header('Location: index.php?action=admin');
                } else {
                    $_SESSION = array();
                    session_destroy();
                    $_SESSION['message'] = 'Mauvais identifiant ou mot de passe !';
                }
            }
        } else {
            $_SESSION['message'] = 'Vous devez remplir tous les champs';
            
        }
        header('Location: index.php');
    }
    
    // Modifier chapitre 
    function changePost($postId)
    {
        $this->checkAuthentification();
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $post        = $postManager->getPost($postId);
        $comments     = $commentManager->getComments($_GET['id']);
        
        if (isset($_POST['title'])) {
            $title         = $_POST['title'];
            $content       = $_POST['content'];
            $adminManager  = new AdminManager();
            $affectedlines = $adminManager->updatePost($title, $content, $postId);

            $_SESSION['message'] = "Chapitre modifié";
            header('Location: index.php');
        }
        require('view/backend/updatePostView.phtml');
    }
    
    // Créer un nouveau chapitre
    function createPost()
    {
        $this->checkAuthentification();
        if (isset($_POST['title'])) {
            $title       = $_POST['title'];
            $content     = $_POST['content'];
            $postManager = new AdminManager();
            
            $affectedLines = $postManager->setCreatePost($title, $content);
            
            $_SESSION['message'] = "Article créé";
            header('Location: index.php');
        }
        
        require('view/backend/createPostView.phtml');
    }
    
    // Supprimer un chapitre
    function setDeletePost($postId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deletePost($postId);
        
        if ($affectedLines === false) {
            throw new \Exception('Impossible de supprimer l\'article !');
        } else {
            $_SESSION['message'] = "Chapitre supprimé";
            header('Location: index.php');
        }
    }

    // Afficher page d'accueil de l'administration
    function adminIndex()
    {
        
        $adminManager     = new AdminManager();
        $reportComments = $adminManager->getReportingAdmin();
        
        require('view/backend/adminIndex.phtml');
    }

    // Supprimer un commentaire
    function setDeleteComment($commentId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deleteComment($commentId);
        
        if ($affectedLines === false) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        } 

        $_SESSION['message'] = "Commentaire supprimé";
        header('Location: index.php');
    }
    
    // Supprimer le signalement d'un commentaire
    function deleteReport($commentId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deleteReports($commentId);
        
        if ($affectedLines === false) {
            throw new \Exception('Impossible de supprimer le signalement !');
        } 

        $_SESSION['message'] = "Commentaire validé";
        header('Location: index.php');
    }

    // Déconnexion
    function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }

    
}
