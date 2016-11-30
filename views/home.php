<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
  <head>
	<?php include('include/head.php'); ?>
	<title>Etre étudiant générateur - Accueil</title>
  </head>

  <body>
	<div id="fb-root"></div>
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
	<div class="container">
		<div class="row">
    <!-- Main jumbotron for a primary marketing message or call to action -->
	  <div class="col-md-2 text-center">
		<img src="http://etre-etudiant.cingeen.com/backgrounds/logo.png" class="img-responsive thumbnail" id="img-header"/>
		<p class="text-right">
			
		</p>
	  </div>
	  <!--<div class="col-md-offset-1 col-md-6 text-center">
		  <h3>Créateur d'images</h3>
		<h1><?php echo mb_strtoupper("être étudiant"); ?></h1>
		<h2>Pour vous, être étudiant c'est quoi ?</h2>
		<a href="?bestof" class="btn btn-lg btn-default" style="width:100%;">voir les punchlines</a>
    </div>-->
	<?php include('views/nav.php'); ?>
    
      
		<!--<div class="col-md-12 well">
			<div class="col-md-4 guide-number"><span class="number">1</span> Tapez votre punchline</div>
			<div class="col-md-4 guide-number"><span class="number">2</span> Générez l'image</div>
			<div class="col-md-4 guide-number"><span class="number">3</span> Partagez sur Facebook !</div>
		</div>-->
        <div class="col-md-7 fbbackground" style="margin-right:10px;">
		<form action="" method="POST" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
			<div class="panel-group" id="accordion">
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
					<span class="number">1</span> Tapez votre punchline</a>
				  </h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in">
				  <div class="panel-body">
					<div class="form-group">
						<div id="msg"></div>
						<h4 class="text-center">Pour moi être étudiant...</h4>
						<div id="textPunchDr">
							<span id="draggable" class="text-right col-lg-12"><img src="backgrounds/move.png" width="32" height="32" id="imgCursor" />
								<textarea onkeyup="textAreaAdjust(this)" class="form-control" rows="5" id="textPunch" name="textPunch" placeholder="Tapez votre punchline ici..."></textarea>
							</span>
						</div>
						<div class="text-center btns">
							<span class="btn btn-default" id="grow"><strong>Aa</strong></span>&nbsp;
							<span class="btn btn-default" id="grow-up"><strong>aA</strong></span>
						</div>
					  </div>
				  </div>
				</div>
			  </div>
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
					<span class="number">2</span> Choisissez une image de fond</a>
				  </h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
				  <div class="panel-body">

							<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />

							<div>
								<label for="fileToUpload">Appuyer pour télécharger :</label>
								<input type="file" id="fileToUpload" name="fileToUpload"/>
								<div id="filedrag">ou faites glisser l'image ici</div>
							</div>
				  </div>
				</div>
			  </div>
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
					<span class="number">3</span> Tapez votre nom (facultatif)</a>
				  </h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
				  <div class="panel-body">
					<div class="form-group">
						<p>Il sera utilisé pour vous nommer et vous remercier dans la publication Facebook de la page officielle</p>
						<p><input type="text" name="auteur" placeholder="votre nom" class="form-control" /></p><hr />
					</div>
				  </div>
				</div>
			  </div>
			  <input type="submit" name="action" value="Créer l'image" class="btn btn-lg btn-success col-md-12" id="generate" />
			</div>
			</form>
        </div>
		<div class="col-md-3 fbbackground" style="width:23%;">
			<div class="fb-page" data-href="https://www.facebook.com/%C3%8Atre-%C3%A9tudiant-998943953518856/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/%C3%8Atre-%C3%A9tudiant-998943953518856/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/%C3%8Atre-%C3%A9tudiant-998943953518856/">Être étudiant</a></blockquote></div>
		</div>
        <!--<div class="col-md-offset-1 col-md-5 fbbackground" id="preview-row">
			<h3 class="guide"><i class="fa fa-eye"></i> Preview</h3>
          <p>Voici ce que donnera votre punchline</p><hr />
          <div class="col-lg-12 text-right">
	          <button class="col-lg-2" id="grow">a</button>
	          <button class="col-lg-2" id="grow-up">A</button>
          </div>
          <div class="col-xs-12 col-md-8">
		    <div class="thumbnail" id="preview-img">
			  <span id="draggable">
			  <div id="resizable">
			  	<div id="punchPreview">&nbsp;</div>
			  </div>
			  </span>
		    </div>
			<hr />
		  </div>
       </div>-->
      </div>

      <hr />
		<footer>
			<script>
				function textAreaAdjust(o) {
					  o.style.height = "1px";
					  o.style.height = (25+o.scrollHeight)+"px";
					}
			</script>
			<?php include('views/footer.php'); ?>
			<script>
				function countLines() {
				  var divHeight = document.getElementById('punchPreview').offsetHeight;
				  var lineHeight = $('#punchPreview').css('line-height');
				  lineHeight = lineHeight.substring(0,2);
				  var lines = divHeight / lineHeight;
				  alert("Lines: " + lines);
				}
				
			</script>
			<button class="col-lg-2" onClick="countLines()">Count lines</button>
		</footer>
    </div> <!-- /container -->
  </body>
</html>
