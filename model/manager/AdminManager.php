<?php

require_once("Manager.php");

class AdminManager extends Manager
{

    public function getLogin($login)
    {
        $bdd = $this->dbConnect();
        $req= $bdd->prepare('SELECT * FROM users WHERE login = :login');
        $req->execute(array('login' => $login));
        $loginAdmin = $req->fetch();
        return $loginAdmin;
    }

    public function updatePost($title, $content, $postId) 
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE chapters SET title = ?, content = ?, creation_date = NOW() WHERE id = ?');
        $updated = $req->execute(array($title, $content, $postId));
        return $updated;
    }

    public function setCreatePost($title, $content) 
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO chapters(title, content, creation_date) VALUES (?, ?, NOW()');
        $newPost = $req->execute(array($title, $content));
        return $newPost;
    }
    public function deletePost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM chapters WHERE id = ?');
        $deletedPost = $req->execute(array($postId));
        return $deletedPost;
    }
    public function getReportingAdmin()
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('SELECT * FROM posts AS p INNER JOIN comments AS c ON c.post_id = p.id INNER JOIN reporting AS r ON c.id = r.comment_id');
        $reporting->execute();
        return $reporting;
    }
}