<?php
	require_once("class.manager.php");
	$manager = new manager();
	$images = $manager->getImages(0,0,0);  
  if(isset($_POST['action']) AND $_POST['action'] == 'oui')
{
	
	$reponse = (int) $_POST['id'];	
	$manager->approuver($reponse);
	header('Location: http://etre-etudiant.cingeen.com/.admin/index.php');
}

if(isset($_POST['action']) AND $_POST['action'] == 'non')
{
	$reponse = (int) $_POST['id'];
	$manager->archiver($reponse);
	header('Location: http://etre-etudiant.cingeen.com/.admin/index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Administration Etre étudiant</title>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Administration Etre étudiant</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<h1>Administration Etre étudiant</h1>
        <hr />
        <?php
	        foreach($images as $image){
		        echo "<div class='row'><div class='col-md-9'><img src='http://etre-etudiant.cingeen.com/img/mini/mini_",$image['nom'],".png' class='img-responsive' style='max-width:250px;margin:10px auto;' /><p class='text-center'>",$image['auteur'],"</p><p class='text-center'><a href='http://etre-etudiant.cingeen.com/img/",$image['nom'],".png' class='btn btn-default'>Voir l'image en taille réelle</a></p></div><div class='col-md-3'><form action='index.php' method='POST'><input type='hidden' value='",$image['id'],"' name='id' /><input type='submit' name='action' value='oui' class='btn btn-success' style='width:48%;' /> <input type='submit' name='action' value='non' class='btn btn-danger' style='width:48%;' /></form></div></div><div class='row'><hr /></div>";
	        }
        ?>       
        
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>