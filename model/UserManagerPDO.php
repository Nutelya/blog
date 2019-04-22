<?php

namespace blog\model;
use \PDO;
use \DateTime;

class UserManagerPDO
{
	protected  $db;

	public final function __construct(PDO $db)
		{
			$this->db = $db;
		}


	public final  function add(User $user)
	{
		$password_hache = password_hash($user->password(), PASSWORD_DEFAULT);
		$request = $this->db->prepare('INSERT INTO utilisateur(pseudo, password, email, date_register, role) VALUES(:pseudo, :password, :email, NOW(), :role)');
		$request->bindValue(':pseudo', $user->pseudo());
		$request->bindValue(':password', $password_hache);
		$request->bindValue(':email', $user->email());
		$request->bindValue(':role', 'membre');
		$request->execute();
	}

	public final function verifyPseudo($pseudo)
	{
		$sql = 'SELECT id, pseudo, password, email, date_register FROM utilisateur WHERE pseudo = :pseudo';
		$request = $this->db->prepare($sql);
		$request->bindValue(':pseudo',$pseudo);
		$test = $request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\User');
    $test = $request->fetchAll();
		if (empty($test))
		{
			$resultat = false;
		}
		else
		{
			$resultat = true;
		}
		return $resultat;
	}

	public final function verifyEmail($email)
	{
		$sql = 'SELECT id, pseudo, password, email, date_register FROM utilisateur WHERE email = :email';
		$request = $this->db->prepare($sql);
		$request->bindValue(':email',$email);
		$test = $request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\User');
    $test = $request->fetchAll();
		if (empty($test))
		{
			$resultat = false;
		}
		else
		{
			$resultat = true;
		}
		return $resultat;
	}

	public final function verifyUser(User $user)
	{
		$sql = 'SELECT id, pseudo, password, email, date_register FROM utilisateur WHERE pseudo = :pseudo AND email = :email';
		$request = $this->db->prepare($sql);
		$request->bindValue(':pseudo',$user->pseudo());
		$request->bindValue(':email',$user->email());
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\User');
		$test = $request->fetchAll();
		if (empty($test))
		{
			$resultat = false;
		}
		else
		{
			$resultat = true;
		}
		return $resultat;
	}

	public final function changeMdp(User $user)
	{
		if ($user->password() == '')
		{
			$length = rand(8,12);
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$password = '';
	    for($i=0; $i<$length; $i++)
			{
	        $password .= $chars[rand(0, strlen($chars)-1)];
	    }
			$user->setPassword($password);
		}
		$request = $this->db->prepare('UPDATE utilisateur SET password = :password WHERE email = :email AND pseudo = :pseudo');
		$password_hache = password_hash($user->password(), PASSWORD_DEFAULT);
		$request->bindValue(':password', $password_hache);
		$request->bindValue(':pseudo', $user->pseudo());
		$request->bindValue(':email', $user->email());
		$request->execute();
		return $user->password();
	}

//	public final function emailMdp(User $user)
//	{
//		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $user->email()))
//			{
//				$passage_ligne = "\r\n";
//			}
//			else
//		{
//		$passage_ligne = "\n";
//}

//		$message_txt = "Bonjour,
//											Cet email a été envoyé car votre mot de passe a été changé.
//											Voici votre nouveau mot de passe : ". $user->password();
//	  $message_html = "<html><head></head><body><b>Bonjour</b>,<br> Cet email a été envoyé car votre mot de passe a été changé.
//											<br>Voici votre nouveau mot de passe : ". $user->password() ."</body></html>";
//		$boundary = "-----=".md5(rand());
//		$sujet = "Réinitialisation du mot de passe";
//		$header = "From: \"Support\" <support@salucin.ovh>".$passage_ligne;
//		$header.= "Reply-to: \"Test\" <".$user->email().">".$passage_ligne;
//		$header.= "MIME-Version: 1.0".$passage_ligne;
//	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//		$message = $passage_ligne."--".$boundary.$passage_ligne;

//		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
//	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
//$message.= $passage_ligne.$message_txt.$passage_ligne;

//$message.= $passage_ligne."--".$boundary.$passage_ligne;

//		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
//		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
//		$message.= $passage_ligne.$message_html.$passage_ligne;

//		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//		mail($user->email(),$sujet,$message,$header);
//	}

	public final  function delete($id)
	{
		$this->db->exec('DELETE FROM utilisateur WHERE id = '.(int) $id);
		$this->db->exec('DELETE FROM commentaire WHERE idAuteur = '.(int) $id);
		$this->db->exec('DELETE FROM signalement WHERE idAuteur = '.(int) $id);
		$this->db->exec('DELETE FROM signalement WHERE idSignale = '.(int) $id);
	}

	public final  function getList($start = -1, $end = -1)
	{
		$sql = 'SELECT id, pseudo, password, email, date_register FROM utilisateur ORDER BY id DESC';

    if ($start != -1 || $end != -1)
    {
      $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }
    $request = $this->db->query($sql);
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\User');
    $listeUtilisateur = $request->fetchAll();

    foreach ($listeUtilisateur as $user)
    {
      $user->setDate_register(new DateTime($user->date_register()));
    }
    $request->closeCursor();
    return $listeUtilisateur;
	}

	public final  function getUnique($id)
	{
	 $request = $this->db->prepare('SELECT id, pseudo, password, email, date_register, role FROM utilisateur WHERE id = :id');
 	 $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
 	 $request->execute();
 	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\User');
 	 $user = $request->fetch();
 	 $user->setDate_register(new DateTime($user->date_register()));
 	 return $user;
	}


	public final function connexion(User $user)
	{
		$req = $this->db->prepare('SELECT id, password, role FROM utilisateur WHERE pseudo = :pseudo');
		$req->execute(array(
        ':pseudo' => $user->pseudo()));
  	$resultat = $req->fetch();

	  $isPasswordCorrect = password_verify($user->password(), $resultat['password']);

		if ($resultat)
		{
    	if ($isPasswordCorrect)
			{
        session_start();
        $_SESSION['id']  = $resultat['id'];
        $_SESSION['pseudo'] = $user->pseudo();
				$_SESSION['role'] = $resultat['role'];
    	}
  	}
	}

}
?>
