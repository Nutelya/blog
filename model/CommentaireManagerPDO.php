<?php

namespace blog\model;
use \PDO;
use \DateTime;

class CommentaireManagerPDO
{

	protected  $db;

	public final function __construct(PDO $db)
	  {
	    $this->db = $db;
	  }

	public final  function add(Commentaire $commentaire)
	{
		$request = $this->db->prepare('INSERT INTO commentaire(idBillet, idAuteur, contenu, dateAjout, dateEdit, estNouveau) VALUES(:idBillet, :idAuteur, :contenu, NOW(), NOW(), :estNouveau)');
		$request->bindValue(':idBillet', $commentaire->idBillet());
		$request->bindValue(':idAuteur', $commentaire->idAuteur());
    $request->bindValue(':contenu', $commentaire->contenu());
		$request->bindValue(':estNouveau', 1, PDO::PARAM_BOOL);
		$request->execute();
	}

	public final  function update(Commentaire $commentaire)
	{
		$request = $this->db->prepare('UPDATE commentaire SET contenu = :contenu, dateEdit = NOW() WHERE id = :id');
		$request->bindValue(':id', $commentaire->id(), PDO::PARAM_INT);
		$request->bindValue(':contenu', $commentaire->contenu());
		$request->execute();
	}

	public final  function updateNew($id, $type)
	{
		if ($type == 0) {
			$request = $this->db->prepare('UPDATE commentaire SET estNouveau = 0 WHERE id = :id');
		}
		else if ($type == 1)
		{
			$request = $this->db->prepare('UPDATE commentaire SET estNouveau = 1 WHERE id = :id');
		}
		$request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->execute();
	}

	public final  function delete($id)
	{
		$this->db->exec('DELETE FROM commentaire WHERE id = '.(int) $id);
		$this->db->exec('DELETE FROM signalement WHERE idCommentaire = '.(int) $id);
	}

	public final  function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM commentaire')->fetchColumn();
	}

	public final  function countNew()
	{
		return $this->db->query('SELECT COUNT(*) FROM commentaire WHERE estNouveau = 1')->fetchColumn();
	}

	public final  function getList($start = -1, $end = -1)
	{
		$sql = "SELECT id, idBillet, idAuteur, contenu, dateAjout, dateEdit, estNouveau FROM commentaire ORDER BY estNouveau DESC, dateAjout DESC";
    if ($start != -1 || $end != -1) {
       $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }
    $request = $this->db->query($sql);
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Commentaire');
    $listeCommentaire = $request->fetchAll();

    foreach ($listeCommentaire as $commentaire)
    {
      $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
      $commentaire->setDateEdit(new DateTime($commentaire->dateEdit()));
    }
    $request->closeCursor();
    return $listeCommentaire;
	}

	public final  function getListCom($start = -1, $end = -1, $idBillet)
	{
		$sql = 'SELECT id, idBillet, idAuteur, contenu, dateAjout, dateEdit FROM commentaire WHERE idBillet = :idBillet ORDER BY id';

    if ($start != -1 || $end != -1)
    {
      $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }
    $request = $this->db->prepare($sql);
    $request->bindValue(':idBillet', $idBillet, PDO::PARAM_INT);
    $request->execute();
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Commentaire');

    $listeCommentaire = $request->fetchAll();

    foreach ($listeCommentaire as $commentaire)
    {
      $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
      $commentaire->setDateEdit(new DateTime($commentaire->dateEdit()));
    }
    $request->closeCursor();
    return $listeCommentaire;
	}

	public final  function getUnique($id)
	{
	 $request = $this->db->prepare('SELECT id, idBillet, idAuteur, contenu, dateAjout, dateEdit FROM commentaire WHERE id = :id');
	 $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Commentaire');
	 $commentaire = $request->fetch();
	 $commentaire->setDateAjout(new DateTime($commentaire->dateAjout()));
	 $commentaire->setDateEdit(new DateTime($commentaire->dateEdit()));
	 return $commentaire;
	}
}
?>
