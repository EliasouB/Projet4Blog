<?php

// Chargement des classes
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/entity/Post.php');
require_once('model/manager/AdminManager.php');


class FrontController
{
    
    function listPosts()
    {
        $postManager = new PostManager(); // Création d'un objet
        $posts       = $postManager->getPosts(); // Appel d'une fonction de cet objet
        
        require('view/frontend/listsPostView.phtml');
    }
    
    function post()
    {
        $postManager    = new PostManager();
        $commentManager = new CommentManager();
        
        $post = $postManager->getPost($_GET['id']);
        if ($post === null) {
            throw new Exception("Cet article n'existe pas");
        }
        
        $comments = $commentManager->getComments($_GET['id']);
        
        require('view/frontend/postView.phtml');
    }
    
    function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();
        
        $affectedLines = $commentManager->postComment($postId, $author, $comment);
        
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    
    function error($message)
    {
        require('view/frontend/errorView.phtml');
    }
    
    function reportComment($commentId)
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($commentId);

        if(!$comment){
                throw new Exception('Impossible de signaler le commentaire !');
        }
        // TODO recuperer postId à partir du commentaire en base de données
        $affectedLines  = $commentManager->postReport($commentId);
        if ($affectedLines === false) {
            throw new Exception('Impossible de signaler le commentaire !');
        } else {

            $_SESSION['message'] = "Commentaire signalé";
            header('Location: index.php?action=post&id=' . $comment['post_id']);
        }
    }
}