<?php
session_start();
	require_once('./Facebook/autoload.php');
	$fb = new Facebook\Facebook([
  'app_id' => '1084551268283466', // Replace {app-id} with your app id
  'app_secret' => 'c77a87fd6b5397641586232a325f6a6c',
  'default_graph_version' => 'v2.5',
  ]);

require_once("class.user.php");
require_once("class.manager.php");

$login = new USER();
$manager = new manager();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}

if(isset($_POST['action']) AND $_POST['action'] == 'oui')
{
	$reponse = (int) $_POST['id'];
	//$manager->approuver($reponse);
	$url = $manager->getUrl($reponse);
	$linkData = [
	  'url' => 'http://etcasedit.cingeen.com/img/'.$url,
	  ];
try {
	$accessToken = 'EAAPaZAMUWNEoBAM6EGRgvkGVT440vPvwd4cfJSbU7KuWBOyr1SSOWUQaqVoZBykGzPHQX4sXm3c4pzqxJv8YtATFAZA85TShbxopKHleZAotH2nR6BWsfpFlwlHADfBr9PNrz8W9EoeOdqBpVVMGMmFhNxSIcokWBjKSBOJj8WyU35ykl8TY';
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/1538759083087226/photos', $linkData, $accessToken);
} catch(Exception $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Exception $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();

echo 'Posted with id: ' . $graphNode['id'];
}

if(isset($_POST['action']) AND $_POST['action'] == 'non')
{
	$reponse = (int) $_POST['id'];
	$manager->archiver($reponse);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log In to WebApp.</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
      	<br />
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
      </form>

    </div>
    
</div>

</body>
</html>