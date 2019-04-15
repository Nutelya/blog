<?php

namespace blog\model;
use \PDO;
use \DateTime;

class SignalementManagerPDO
{
	protected  $db;

	public final function __construct(PDO $db)
	  {
	    $this->db = $db;
	  }

	public final  function add(Signalement $signalement)
	{
		$request = $this->db->prepare('INSERT INTO signalement(idBillet, idAuteur, idCommentaire, dateAjout, estNouveau, idSignale) VALUES(:idBillet, :idAuteur, :idCommentaire, NOW(), :estNouveau, :idSignale)');
		$request->bindValue(':idBillet', $signalement->idBillet());
		$request->bindValue(':idAuteur', $signalement->idAuteur());
    $request->bindValue(':idCommentaire', $signalement->idCommentaire());
		$request->bindValue(':idSignale', $signalement->idSignale());
    $request->bindValue(':estNouveau', 1);
		$request->execute();
	}

	public final  function peutSignaler($idAuteur, $idCommentaire)
	{
		$request = $this->db->prepare('SELECT idAuteur, idCommentaire FROM signalement WHERE (idAuteur = :idAuteur) AND (idCommentaire = :idCommentaire)');
		$request->bindValue(':idAuteur', $idAuteur, PDO::PARAM_INT);
		$request->bindValue(':idCommentaire', $idCommentaire, PDO::PARAM_INT);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Signalement');
 	  $signalement = $request->fetch();
		if (empty($signalement))
		{
			$signal = true;
		}
		else
		{
			$signal = false;
		}
		return $signal;
	}

	public final  function update(Signalement $signalement)
	{
		$request = $this->db->prepare('UPDATE signalement SET estNouveau = :estNouveau WHERE id = :id');
		$request->bindValue(':estNouveau', $signalement->id(), PDO::INT);
		$request->bindValue(':estNouveau', 1, PDO::PARAM_BOOL);
		$request->execute();
	}

	public final  function deleteTous($id)
	{
		$this->db->exec('DELETE FROM signalement WHERE idCommentaire = '.(int) $id);
	}

	public final  function delete($id)
	{
		$this->db->exec('DELETE FROM signalement WHERE id = '.(int) $id);
	}

	public final  function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM signalement')->fetchColumn();
	}

	public final  function countNew()
	{
		return $this->db->query('SELECT COUNT(*) FROM signalement WHERE estNouveau = 1')->fetchColumn();
	}

	 public final  function updateNew($id, $type)
	 {
 		if ($type == 0)
		{
 			$request = $this->db->prepare('UPDATE signalement SET estNouveau = 0 WHERE idCommentaire = :idCommentaire');
 		}
		else if ($type == 1)
		{
 			$request = $this->db->prepare('UPDATE signalement SET estNouveau = 1 WHERE idCommentaire = :idCommentaire');
 		}
 		$request->bindValue(':idCommentaire', $id, PDO::PARAM_INT);
 		$request->execute();
 	}

	public final  function getList($start = -1, $end = -1, $type = -1)
	{
		if ($type == -1)
		{
			$sql = "SELECT id, idBillet, idAuteur, idCommentaire, dateAjout, estNouveau FROM signalement ORDER BY estNouveau DESC, dateAjout DESC";
		}
		else
		{
			$sql = "SELECT id, idBillet, idAuteur, idCommentaire, dateAjout, estNouveau FROM signalement WHERE idCommentaire = " .$type. " ORDER BY idCommentaire, dateAjout DESC";
		}

    if ($start != -1 || $end != -1)
    {
      $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }
    $request = $this->db->query($sql);
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Signalement');
    $listeSignalement = $request->fetchAll();

    foreach ($listeSignalement as $signalement)
    {
      $signalement->setDateAjout(new DateTime($signalement->dateAjout()));
    }
    $request->closeCursor();
    return $listeSignalement;
	}

	public final  function getUnique($id)
	{
	 $request = $this->db->prepare('SELECT id, idBillet, idAuteur, idCommentaire, dateAjout, estNouveau FROM signalement WHERE id = :id');
	 $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Signalement');
	 $signalement = $request->fetch();
	 $signalement->setDateAjout(new DateTime($signalement->dateAjout()));
	 return $signalement;
	}
}
?>
