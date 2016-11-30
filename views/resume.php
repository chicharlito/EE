<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
  <head>
	  <?php include('include/head.php'); ?>
	  <title>Résumé de votre punchline</title>
  </head>

  <body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '102710270141243',
      xfbml      : true,
      version    : 'v2.6'
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
<script>
				// Only works after `FB.init` is called
				function myFacebookLogin() {
				  FB.login(function(response) {
					if (response.authResponse) {
						var access_token =   FB.getAuthResponse()['accessToken'];
						FB.api('/me/photos?access_token='+access_token, 'post', { url: "http://www.etre-etudiant.cingeen.com/<?php echo $imagetoken; ?>", access_token: access_token }, function(response) {
							if (!response || response.error) {
								$("#processing-modal-publish").modal('hide');
								$("#msgs").empty().append("<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Oups !</strong> Ile semble qu'une erreur se soit produite lors du partage :/</div>");
							} else {
								$("#processing-modal-publish").modal('hide');
								$("#msgs").empty().append("<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Félicitations !</strong> Votre image a été partagé sur votre profil.</div>");
							}
						});
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
					}, {scope: 'publish_actions'});
				}
			</script>
    <?php include('views/nav.php'); ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3 id="h3-etre-etudiant-header">Etre étudiant</h3>
      </div>
    </div>

    <div class="container">
      <div class="row">
	      <ol class="breadcrumb">
		  	<li><a href='http://etre-etudiant.cingeen.com'>Accueil</a></li>
		  	<li>Résumé de votre punchline</li>
		  </ol>
	    <div class="col-md-12">
		    <div id="msgs"></div>
	    </div>
		<div class="col-md-12 well">
			<h3><i class="fa fa-hand-peace-o"></i> Félicitations ! Vous pouvez désormais partager l'image, la télécharger ou recommencer</h3>
			<div class="alert alert-info" role="alert">Les <strong>données</strong> collectées sont <strong>confidentielles</strong> et ne seront <strong>ni revendues ni transmises</strong> ! :)</div>
		</div>
	  </div>
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo $miniImageToken; ?>" class='img-responsive' />      
       </div>
		<div class="col-md-6 well">
			<button data-toggle="modal" data-target="#processing-modal-publish" onclick="myFacebookLogin()" class="col-lg-12 btn btn-lg btn-primary"><i class="fa fa-facebook-official"></i> Partager sur Facebook</button>
			<div>
				<a href="http://www.etre-etudiant.cingeen.com/<?php echo $imagetoken; ?>" download="punchline" class="btn btn-default btn-lg col-lg-12"><i class="fa fa-download"></i> Télécharger</a>
			</div>
			<div>
				<a href="http://etre-etudiant.cingeen.com/" class="btn btn-success btn-lg col-lg-12"><i class="fa fa-history"></i> Recommencer</a>
			</div>
		</div>
      </div>
	  <?php echo $sig; ?><br />
	  <?php echo var_dump($lignes); ?><br />
	  <?php echo var_dump($phrases); ?><br />
	  <?php echo $phrases[0]; ?><br />
	  <?php echo $phrases[1]; ?><br />
	  <?php echo $phrases[2]; ?><br />
      <hr />
      <footer>
			<?php include('views/footer.php'); ?>
		</footer>
	</div>
  </body>
</html>
