<!DOCTYPE html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
  <head>
	<?php include('include/head.php'); ?>
	<title>Best of</title>
  </head>

  <body>
	<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '102710270141243',
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

<script>
				// Only works after `FB.init` is called
				function myFacebookLogin(image) {
				  FB.login(function(response) {
					if (response.authResponse) {
						var access_token =   FB.getAuthResponse()['accessToken'];
						var url = "http://www.etre-etudiant.cingeen.com/img/"+image;
						FB.api('/me/photos?access_token='+access_token, 'post', { url: url, access_token: access_token }, function(response) {
							if (!response || response.error) {
								$("#msgs").empty().append("<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Oups !</strong> Ile semble qu'une erreur se soit produite lors du partage :/</div>");
							} else {
								$("#processing-modal").modal('hide');
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
		  	<h2>Les meilleures punchlines !</em></h2>
		  	<p>Les étudiants ont du talent, en voici la preuve ;)</p>
      </div>
    </div>

    <div class="container">
      <div class="row">
	      <ol class="breadcrumb">
		  	<li><a href='http://etre-etudiant.cingeen.com'>Accueil</a></li>
		  	<li>Les meilleures punchlines</li>
		  </ol>
    	<div class='list-group gallery'>
	    	<?php foreach($images as $image){ ?>
			<div class="col-sm-4 col-xs-6 col-md-3 col-lg-3">
				<a class="thumbnail fancybox" rel="ligthbox" href="http://etre-etudiant.cingeen.com/img/<?php echo $image['nom'] ?>.png">
				  <img class="img-responsive" alt="" src="http://etre-etudiant.cingeen.com/img/mini/mini_<?php echo $image['nom'] ?>.png" />
				</a>
				  <div class="caption">
					<p><div class="share pull-right" style='margin-bottom:30px;margin-top:-13px;'><button class="btn btn-primary btn-xs" id="share pull-right_button1" name="<?php echo $image['nom'] ?>" type='button_count'><i class="fa fa-facebook-official"></i> partager</button></div></p>
				  </div>
			</div><?php } ?>
        </div> <!-- list-group / end -->
      </div>
      <hr />
      <div class="text-center">
	     <nav>
			  <ul class="pagination">
			    <?php for($i=0;$i<$nombrePage;$i++)
				    if($nombrePage == 1)
				    {
					    echo "<li><a href='?bestof'>Début</a></li>";
				    }
				    else
				    {
					   if($i==0)
					    {
						    echo "<li><a href='?page=".$i."'>Début</a></li>";
					    }
					    else{
						    echo "<li><a href='?page=".$i."'>".$i."</a></li>";
					    }
				    }
				          
				  ?>
			  </ul>
			</nav>
      </div>
      
      <footer>
        <?php include('views/footer.php'); ?>
		<script src="../include/jquery.fancybox.pack.js"></script>
		<script src="../include/jquery.fancybox.js"></script>
		<script>
				$(".fancybox").fancybox();
			</script>
			<script>
				$("button[id^='share pull-right_button']").click(function(e){
					var img = $(this).attr('name');
					var url = "http://etre-etudiant.cingeen.com/img/mini/mini_"+img+".png";
					e.preventDefault(); 
					FB.login(function(response) {
							if (response.authResponse) {
								var access_token =   FB.getAuthResponse()['accessToken'];
								FB.api('/me/photos?access_token='+access_token, 'post', { url: url, access_token: access_token }, function(response) {
									if (!response || response.error) {
										$("#msgs").empty().append("<div class=\"alert alert-warning alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Oups !</strong> Ile semble qu'une erreur se soit produite lors du partage :/</div>");
									} else {
										$("#processing-modal").modal('hide');
										$("#msgs").empty().append("<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>  <strong>Félicitations !</strong> Votre image a été partagé sur votre profil.</div>");
									}
								});
							} else {
								console.log('User cancelled login or did not fully authorize.');
							}
							}, {scope: 'publish_actions'});    
				});
			</script>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
