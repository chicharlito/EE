<?php

require_once('dbconfig.php');

class manager
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function getAll($approuved,$etat)
	{
		try
		{	
			$approuved = (int) $approuved;
			$etat = (int) $etat;		
			$stmt = $this->conn->prepare("SELECT * FROM images_etre_etudiant WHERE approuved=:approuved AND etat=:etat ORDER BY id DESC");
			$stmt->bindParam(':approuved',$approuved,PDO::PARAM_INT);
			$stmt->bindParam(':etat',$etat,PDO::PARAM_INT);
			$stmt->execute();
			$retour = $stmt->fetchAll();	
			return $retour;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function getImages($approuved,$etat,$premiereEntree)
	{
		try
		{	
			$premiereEntree = (int) $premiereEntree;
			$approuved = (int) $approuved;
			$etat = (int) $etat;		
			$stmt = $this->conn->prepare("SELECT * FROM images_etre_etudiant WHERE approuved=:approuved AND etat=:etat ORDER BY id DESC LIMIT :premiereEntree,30");
			$stmt->bindParam(':approuved',$approuved,PDO::PARAM_INT);
			$stmt->bindParam(':premiereEntree',$premiereEntree,PDO::PARAM_INT);
			$stmt->bindParam(':etat',$etat,PDO::PARAM_INT);
			$stmt->execute();		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function approuver($id)
	{
		try
		{
			$id = (int) $id;			
			$stmt = $this->conn->prepare("UPDATE images_etre_etudiant SET approuved = TRUE, etat=TRUE WHERE id=:id");
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	public function archiver($id)
	{
		try
		{
			$id = (int) $id;			
			$stmt = $this->conn->prepare("UPDATE images_etre_etudiant SET approuved = FALSE, etat=TRUE WHERE id=:id");
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function getUrl($id)
	{
		try
		{
			$id = (int) $id;			
			$stmt = $this->conn->prepare("SELECT nom FROM images_etre_etudiant WHERE id=:id");
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$url = $stmt->fetch();	
			return $url[0];	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function getAuteur($id)
	{
		try
		{
			$id = (int) $id;			
			$stmt = $this->conn->prepare("SELECT auteur FROM images_etre_etudiant WHERE id=:id");
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$url = $stmt->fetch();	
			return $url[0];	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function save($image,$auteur)
	{
		try
		{
			$image = htmlentities($image);
			$auteur = htmlentities($auteur);		
			$stmt = $this->conn->prepare("INSERT INTO images_etre_etudiant (nom,auteur,date,approuved,etat) VALUES (:nom,:auteur,NOW(),0,0)");
			$stmt->bindParam(':nom',$image,PDO::PARAM_STR);
			$stmt->bindParam(':auteur',$auteur,PDO::PARAM_STR);
			$stmt->execute();			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function saveMessage($from,$message)
	{
		try
		{
			$from = htmlentities($from);
			$message = htmlentities($message);		
			$stmt = $this->conn->prepare("INSERT INTO messages_etre_etudiant (expediteur,contenu,date_message) VALUES (:expediteur,:message,NOW())");
			$stmt->bindParam(':expediteur',$from,PDO::PARAM_STR);
			$stmt->bindParam(':message',$message,PDO::PARAM_STR);
			$stmt->execute();			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function getMsg()
	{
		try
		{			
			$stmt = $this->conn->query("SELECT * FROM messages_etre_etudiant ORDER BY id DESC");
			$retour = $stmt->fetchAll();		
			return $retour;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
}
?>