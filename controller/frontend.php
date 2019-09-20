<?php

// Chargement des classes
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/entity/Post.php');

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listsPostView.phtml');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $postObject = new Post();
    $postObject->setId($post['id']);
    $postObject->setTitle($post['title']);
    $postObject->setContent($post['content']);
    $postObject->setCreationDate($post['creation_date']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.phtml');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function error($e)
{
    require('view/frontend/errorView.php');
}