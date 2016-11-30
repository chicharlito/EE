<?php
	require_once("./.admin/class.manager.php");
	if(isset($_POST['action']) and $_POST['action'] == 'Envoyer')
	{
		if(!empty($_POST['adressemail']) AND !empty($_POST['message']))
			{
				$mailLn = strlen($_POST['adressemail']);
				if($mailLn > 60){
					include("views/contact.php");
					exit;
				}
				
				$messageLn = strlen($_POST['message']);
				if($mailLn > 500){
					include("views/contact.php");
					exit;
				}
				
				$mailSafe = htmlentities($_POST['adressemail']);
				$messagePreSafe = nl2br($_POST['message']);
				$messageSafe = htmlentities($messagePreSafe);
				$sujet = "1 nouveau message";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: <'.$mailSafe.'>' . "\r\n";
				// on envoie le mail
				//mail("contact@cingeen.com",$sujet,$messageSafe,$headers);
				
				$manager = new manager();
				$manager->saveMessage($mailSafe,$messageSafe);
				
				$classe = "success";
				$msg = "Merci pour votre message, nous le traitons le plus rapidement possible :)";
				include("views/contact.php");
				exit;
			}
			else{
				$classe = "danger";
				$msg = "Tous les champs sont obligatoires";
				include("views/contact.php");
				exit;
			}
	}
	if(isset($_POST['image']))
	{
		$time = time();
		$save = str_replace('data:image/png;base64,', '', $_POST['image'] );
		file_put_contents( './img/image'.$time.'.png', base64_decode( $save ) );
		echo "image".$time;
		exit;
	}
	if(isset($_GET['image']))
	{
		$image = $_GET['image'];
		include("views/resume.php");
		exit;
	}
	if(isset($_POST['action']) and $_POST['action'] == 'Créer l\'image')
	{		
		$texteln = strlen($_POST['textPunch']);
		if($texteln > 100)
		{
			include("views/home.php");
			exit;
		}
		else
		{
			if(strlen($_POST['auteur']) > 100)
			{
				include("views/home.php");
				exit;
			}
			else
			{
				$auteur = htmlspecialchars($_POST['auteur']);
			}

			$texteBrut = $_POST['textPunch'];
			$texteLisse = str_ireplace("\r\n"," ",$texteBrut);

		}

			
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			
			

			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			$ext = end((explode(".", $_FILES["fileToUpload"]["name"]))); # extra () to prevent notice
			switch($ext){
				case 'jpg':
				$fonction = 'imagecreatefromjpeg';
				break;
				
				default:
				$fonction = 'imagecreatefrompng';
				break;
			}
			
	
			
			// éléments de l'image
			$blurs = 10;
			$image = $fonction('uploads/'.$_FILES["fileToUpload"]["name"]);
			$image  = imagescale($image ,500 , 500);
			$filtre = imagecreatefrompng('backgrounds/filtre.png');
			$logo = imagecreatefrompng('backgrounds/en-tete.png');
			$logo  = imagescale($logo ,100 , 100);
			
			for ($i = 0; $i < $blurs; $i++) {
				imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
			}
			
			imagecopymerge($image, $filtre, 0, 0, 0, 0, 500, 500, 50);
			imagecopymerge($image, $logo, 200, 10, 0, 0, 100, 100, 100);
			
			$imgwidth = 500;
			$fontsize = 45;
			$font = "fonts/ahkio.ttf";
			$bleu = imagecolorallocate($image, 70, 184, 212);
			$orange = imagecolorallocate($image, 255, 128, 0);
			$bleuclair = imagecolorallocate($image, 156, 227, 254);
			$noir = imagecolorallocate($image, 0, 0, 0);
			$blanc = imagecolorallocate($image, 255, 255, 255);
			
			$sig = wordwrap($texteBrut, 30, "<br />", true);
			$phrases = explode('<br />',$sig);
			$lignes = count($phrases);
			
			$image_width = 500; 
			$image_height = 500;
			
			function write_multiline_text($image, $font_size, $color, $font, $text, $start_x, $start_y, $max_width) 
			{ 
					//split the string 
					//build new string word for word 
					//check everytime you add a word if string still fits 
					//otherwise, remove last word, post current string and start fresh on a new line 
					$words = explode(" ", $text); 
					$string = ""; 
					$tmp_string = ""; 
					
					for($i = 0; $i < count($words); $i++) 
					{ 
						$tmp_string .= $words[$i]." "; 
						
						//check size of string 
						$dim = imagettfbbox($font_size, 0, $font, $tmp_string); 
						
						if($dim[4] < $max_width) 
						{ 
							$string = trim($tmp_string); 
						} else { 
							$i--; 
							$tmp_string = ""; 
							imagettftext($image, 40, 0, $start_x, $start_y, $color, $font, $string); 
							
							$string = ""; 
							$start_y += 65;
						} 
					} 
						
					$start_xx = $start_x + round(($max_width - $dim[4] - $start_x) / 2);
					imagettftext($image, 40, 0, $start_xx, $start_y, $color, $font, $string); //"draws" the rest of the string
			}
			
			switch($lignes){
				case 1:
				$startY = 270;
				break;
				
				case 2:
				$startY = 220;
				break;
				
				case 3:
				$startY = 170;
				break;
				
				case 4:
				$startY = 170;
				break;
			}
			
			write_multiline_text($image, $fontsize, $blanc, $font, $texteLisse, 60, $startY, $imgwidth);
			
			// On enregistre le tout
			$token = time();
			$imagetoken = "img/image_".$token.".png";		
			imagepng($image, $imagetoken);
			
			// on créé une miniature
			$source = imagecreatefrompng($imagetoken); // La photo est la source
			$destination = imagecreatetruecolor(500, 500); // On crée la miniature vide
			
			// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx($source);
			$hauteur_source = imagesy($source);
			$largeur_destination = imagesx($destination);
			$hauteur_destination = imagesy($destination);
			
			// On crée la miniature
			imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
			
			
			
			// On enregistre la miniature
			$miniImageToken = "img/mini/mini_image_".$token.".png";
			imagepng($destination, $miniImageToken);
			$manager = new manager();
			$imageToDb = "image_".$token;
			$manager->save($imageToDb,$auteur);
			
			include("views/resume.php");
			exit;	
	}
	if(isset($_GET['bestof']))
	{
		$manager = new manager();
		$images = $manager->getImages(1,1,0);
		$total = count($manager->getAll(1,1));
		$nombrePage = ceil($total/30);
		include("views/bestof.php");
		exit;
	}
	if(isset($_GET['page']))
	{
		$page = (int) $_GET['page'];		
		$premiereEntree = ($page*30)+1;
		$manager = new manager();
		$images = $manager->getImages(1,1,$premiereEntree);
		$total = count($manager->getAll(1,1));
		$nombrePage = ceil($total/30);
		include("views/bestof.php");
		exit;
	}
	if(isset($_GET['contact']))
	{
		include("views/contact.php");
		exit;
	}		
	else
	{
		include("views/home.php");
		exit;
	}
?>