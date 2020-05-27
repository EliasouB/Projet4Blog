<?php
namespace Blog\Model\Manager;

use Blog\Model\Entity\Post;

class PostManager extends Manager
{ 
    public function getPosts() // Méthode qui récupere tous les Posts
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId) // Méthode qui récupère un Post 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        if($post){            
            $postObject = new Post();
            $postObject->setId($post['id']);
            $postObject->setTitle($post['title']);
            $postObject->setCreationDate($post['creation_date_fr']);
            $postObject->setContent($post['content']);
        return $postObject;
        }

        return null;

    }
}

