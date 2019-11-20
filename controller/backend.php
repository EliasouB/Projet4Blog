<?php

// Chargement des classes
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/entity/Post.php');
require_once('model/manager/AdminManager.php');

function login()
{
	
	$adminManager = new AdminManager();
	$login = $adminManager->getLogin();
	require('view/backend/adminIndex.phtml');
}