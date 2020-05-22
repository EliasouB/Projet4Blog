<!doctype html>
<html lang="zxx" class="h-100">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="public/style.css">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <title><?= $title ?></title>
      <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/">
      <!-- Bootstrap core CSS -->
      <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- Custom styles for this template -->
   </head>
   <body class="d-flex flex-column h-100">
      <!-- Fixed navbar -->
      <header>
         <nav class="navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="index.php">Jean Forteroche<span class="sr-only">(current)</span></a>
                  </li>
               </ul>
            </div>
            <?php 
               if (!isset($_SESSION{'login'})):
                ?>
            <form class="form-inline mt-2 mt-md-0" action="index.php?action=login" method="POST">        
               <input class="form-control mr-sm-2" type="text" placeholder="Identifiant" id="username" name="username">
               <input class="form-control mr-sm-2" type="password" placeholder="Mot de passe" id="password" name="password">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button>
            </form>
            <?php 
               else:  ?>
            <ul class="nav navbar-right navbar-nav">
               <li><a href="index.php?action=admin" class="btn btn-light">Administration</a></li>
               <li><a href="index.php?action=logout" class="btn btn-xs btn-primary">Déconnexion</a></li>
            </ul>
            <?php 
               endif;
               ?>
         </nav>
         <?php if(isset($_SESSION['message'])): ?>
         <div class="alert alert-success" role="alert"><?= $_SESSION['message'] ?></div>
         <?php unset($_SESSION['message']); endif; ?>
         <?= $content ?>
      </header>
      <footer class="footer mt-auto py-3"></footer>
      <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script type="public/blog.js"></script>
   </body>
</html>