<?php

namespace blog\model;
use \PDO;
use \DateTime;

class BilletManagerPDO
{

	protected  $db;

	public  function __construct(PDO $db)
	  {
	    $this->db = $db;
	  }

	public   function add(Billet $billet)
	{
		$request = $this->db->prepare('INSERT INTO billet(title, container, dateAdd, dateEdit, corbeille) VALUES(:title, :container, NOW(), NOW(), :corbeille)');
		$request->bindValue(':title', $billet->title());
		$request->bindValue(':container', $billet->container());
		$request->bindValue(':corbeille', 0, PDO::PARAM_INT);
		$request->execute();
	}

	public   function update(Billet $billet)
	{
		$request = $this->db->prepare('UPDATE billet SET title = :title, container = :container, dateEdit = NOW() WHERE id = :id');
		$request->bindValue(':id', $billet->id(), PDO::PARAM_INT);
		$request->bindValue(':title', $billet->title());
		$request->bindValue(':container', $billet->container());
		$request->execute();
	}

	public   function switchCorbeille($id, $corbeille)
	{
		$request = $this->db->prepare('UPDATE billet SET corbeille = :corbeille WHERE id = :id');
		$request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->bindValue(':corbeille', $corbeille, PDO::PARAM_INT);
		$request->execute();
	}

	public   function delete($id)
	{
		$this->db->exec('DELETE FROM billet WHERE id = '.(int) $id);
		$this->db->exec('DELETE FROM commentaire WHERE idBillet = '.(int) $id);
		$this->db->exec('DELETE FROM signalement WHERE idBillet = '.(int) $id);
	}

	public   function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM billet')->fetchColumn();
	}


	public   function getList($start = -1, $end = -1, $corbeille = 0)
	{
		$sql = "SELECT id, title, container, dateAdd, dateEdit, corbeille FROM billet WHERE corbeille = ". $corbeille ." ORDER BY id DESC";
    if ($start != -1 || $end != -1)
		{
      $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }

    $request = $this->db->query($sql);
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Billet');
		$listeBillet = $request->fetchAll();

    foreach ($listeBillet as $billet)
    {
      $billet->setDateAdd(new DateTime($billet->dateAdd()));
      $billet->setDateEdit(new DateTime($billet->dateEdit()));
    }

    $request->closeCursor();
  	return $listeBillet;
	}

	public   function getUnique($id)
	{
	 $request = $this->db->prepare('SELECT id, title, container, dateAdd, dateEdit FROM billet WHERE id = :id');
	 $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Billet');
	 $billet = $request->fetch();
	 $billet->setDateAdd(new DateTime($billet->dateAdd()));
	 $billet->setDateEdit(new DateTime($billet->dateEdit()));
	 return $billet;
	}

	public   function getId($title)
	{
	 $request = $this->db->prepare('SELECT id, title FROM billet WHERE title = :title');
	 $request->bindValue(':title', $title);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, '\blog\model\Billet');
	 $billet = $request->fetch();
	 return $billet->id();
	}
}
?>
