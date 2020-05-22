<?php
namespace Blog\Model\Manager;

class CommentManager extends Manager
{
    public function getComments($postId) // Méthode qui récupère les commentaires d'un Post
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }    

    public function getComment($id) // Méthode qui récupère le commentaires d'un Post
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $req->execute(array($id));

        return $req->fetch();
    }

    public function postComment($postId, $author, $comment) // Méthode qui ajoute un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment)); // Ce que l'on a passé en commentaire

        return $affectedLines;
    }

    public function postReport($commentId) // Méthode qui ajoute le signalement d'un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO report(comment_id, reporting_date) VALUES(?, NOW())');
        $affectedLines = $comments->execute(array($commentId));
        return $affectedLines;
    }

}