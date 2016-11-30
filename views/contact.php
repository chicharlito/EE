<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
  <head>
	<?php include('include/head.php'); ?>
	<title>Nous contacter</title>
  </head>
  <body>
  	<div id="fb-root"></div>
		<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '1084551268283466',
			  xfbml      : true,
			  version    : 'v2.5'
			});
		  };

		  (function(d, s, id){
			 var js, fjs = d.getElementsByTagName(s)[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement(s); js.id = id;
			 js.src = "//connect.facebook.net/en_US/sdk.js";
			 fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		</script>
    <?php include('views/nav.php'); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
		  	<h2>Un bug ? Une suggestion ? Un renseignement ?</h2>
		  	<p>Ecrivez-nous, nous vous répondrons très rapidement !</p>
      </div>
    </div>

    <div class="container">
      <div class="row">
	      <ol class="breadcrumb">
		  	<li><a href='http://etre-etudiant.cingeen.com'>Accueil</a></li>
		  	<li>Nous contacter</li>
		  </ol>
    	</div>
		<div class="row">
			<div class="col-md-8 fbbackground" style="padding:25px;">
				<form action="" method="POST">
				  <div class="form-group">
					<?php
						if($msg)
						{
							echo "<div class=\"alert alert-",$classe,"\" role=\"alert\">",$msg,"</div>";
						}
					?>
					<label for="adressemail">Votre adresse mail</label>
					<input type="email" class="form-control" name="adressemail" id="adressemail" placeholder="Votre adresse mail">
				  </div>
				  <div class="form-group">
					<label for="message">Votre message</label>
					<textarea class="form-control" name="message" rows="8" placeholder="Votre message..."></textarea>
				  </div>
				  <div class="text-center">
					<input type="submit" name="action" value="Envoyer" class="btn btn-success" />
				  </div>
				</form>
			</div>
			<div class="col-md-4">
				<a href="?bestof" class="thumbnail">
				  <img id="preview-header-img" src="http://etre-etudiant.cingeen.com/img/mini/mini_image_1461681599.png" class="img-responsive" alt="Etre étudiant">
			  </a>
			</div>
		</div>
		<hr />
    </div> <!-- /container -->
      <footer class="footer">
		<div class="container">
			<?php include('views/footer.php'); ?>
		</div>
      </footer>
  </body>
</html>
