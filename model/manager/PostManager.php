<?php

require_once("Manager.php");

class PostManager extends Manager
{ 
    // Méthode qui récupere tous les Posts
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    // Méthode qui récupère un Post 
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getCheckPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT exists (SELECT * FROM chapters WHERE id = ?) AS post_exist');
        $req->execute(array($postId));
        $check = $req->fetch();
        return $check;
    }
}

