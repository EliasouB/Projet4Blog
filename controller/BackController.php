<?php

// Chargement des classes
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/entity/Post.php');
require_once('model/manager/AdminManager.php');



class BackController
{
    
    function checkAuthentification()
    {
        if (!isset($_SESSION['id'])) {
            throw new Exception("Need authentication");
            
        }
    }
    function login()
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
                
                $isPasswordCorrect = password_verify($pass, $loginAdmin['pass']);
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
        header('Location: index.php?action=admin');
    }
    
    
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
    
    
    function setDeletePost($postId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deletePost($postId);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer l\'article !');
        } else {
            $_SESSION['message'] = "Chapitre supprimé";
            header('Location: index.php');
        }
    }
    function adminIndex()
    {
        
        $adminManager     = new AdminManager();
        $reportComments = $adminManager->getReportingAdmin();
        
        require('view/backend/adminIndex.phtml');
    }
    function setDeleteComment($commentId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deleteComment($commentId);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        } 

        $_SESSION['message'] = "Commentaire supprimé";
        header('Location: index.php');
    }
    
    function deleteReport($commentId)
    {
        $this->checkAuthentification();
        $adminManager  = new AdminManager();
        $affectedlines = $adminManager->deleteReports($commentId);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le signalement !');
        } 

        $_SESSION['message'] = "Commentaire validé";
        header('Location: index.php');
    }
    function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }

    
}
