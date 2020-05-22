<?php

namespace Blog\Model\Manager;

class AdminManager extends Manager
{

    public function getLogin($login) // Connexion à la base de données 
    {
        $bdd = $this->dbConnect();
        $req= $bdd->prepare('SELECT * FROM users WHERE login = :login');
        $req->execute(array('login' => $login));
        $loginAdmin = $req->fetch();
        return $loginAdmin;
    }

    public function updatePost($title, $content, $postId) // Modification du post
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE chapters SET title = ?, content = ?, creation_date = NOW() WHERE id = ?');
        $updated = $req->execute(array($title, $content, $postId));
        return $updated;
    }

    public function setCreatePost($title, $content) // Création du Post
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO chapters(title, content, creation_date) VALUES (?, ?, NOW())');
        $newPost = $req->execute(array($title, $content));
        return $newPost;
    }

    public function deletePost($postId) { // Suppression du post
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM chapters WHERE id = ?');
        $deletedPost = $req->execute(array($postId));
        return $deletedPost;
    }

    public function getReportingAdmin() // Jointure entre la table report et comments pour le signalements des commentaires 
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('
            SELECT * FROM report AS r
            INNER JOIN comments AS c ON c.id = r.comment_id
            ');
        $reporting->execute();
        return $reporting->fetchAll();
    }

    public function deleteComment($commentId) // Suppression des commentaires
    { 
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $req->execute(array($commentId));
        return $deletedComment;
    }
    
    public function deleteReports($commentId) // Suppression des signalements
    { 
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM report WHERE comment_id = ?');
        $deletedReport = $req->execute(array($commentId));
        return $deletedReport;
    }
}