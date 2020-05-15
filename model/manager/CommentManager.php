<?php

require_once("Manager.php");

class CommentManager extends Manager
{
    // Méthode qui récupère les commentaires d'un Post
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }    

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $req->execute(array($id));

        return $req->fetch();
    }

    // Méthode qui ajoute un commentaire
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment)); // Ce que l'on a passé en commentaire

        return $affectedLines;
    }

    // Méthode qui ajoute le signalement d'un commentaire
    public function postReport($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO report(comment_id, reporting_date) VALUES(?, NOW())');
        $affectedLines = $comments->execute(array($commentId));
        return $affectedLines;
    }

}