<?php
/**
 *
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 */

class BilletManagerPDO {

	/**
	 *
	 * @var PDO
	 * @access protected
	 */
	protected  $db;


	/**
	 * @access public
	 * @param PDO $db
	 * @return void
	 */

	public final function __construct(PDO $db)
	  {
	    $this->db = $db;
	  }


	/**
	 * @access public
	 * @param Billet $billet
	 * @return void
	 */

	public final  function add(Billet $billet) {
		$request = $this->db->prepare('INSERT INTO billet(title, container, dateAdd, dateEdit, corbeille) VALUES(:title, :container, NOW(), NOW(), :corbeille)');
		$request->bindValue(':title', $billet->title());
		$request->bindValue(':container', $billet->container());
		$request->bindValue(':corbeille', 0, PDO::PARAM_INT);
		$request->execute();
	}


	/**
	 * @access public
	 * @param Billet $billet
	 * @return void
	 */

	public final  function update(Billet $billet) {
		$request = $this->db->prepare('UPDATE billet SET title = :title, container = :container, dateEdit = NOW() WHERE id = :id');
		$request->bindValue(':id', $billet->id(), PDO::PARAM_INT);
		$request->bindValue(':title', $billet->title());
		$request->bindValue(':container', $billet->container());
		$request->execute();
	}

	/**
	 * @access public
	 * @param Billet $billet
	 * @return void
	 */

	public final  function switchCorbeille($id, $corbeille) {
		$request = $this->db->prepare('UPDATE billet SET corbeille = :corbeille WHERE id = :id');
		$request->bindValue(':id', $id, PDO::PARAM_INT);
		$request->bindValue(':corbeille', $corbeille, PDO::PARAM_INT);
		$request->execute();
	}


	/**
	 * @access public
	 * @param int $id
	 * @return void
	 */

	public final  function delete($id) {
		$this->db->exec('DELETE FROM billet WHERE id = '.(int) $id);
		$this->db->exec('DELETE FROM commentaire WHERE idBillet = '.(int) $id);
		$this->db->exec('DELETE FROM signalement WHERE idBillet = '.(int) $id);
	}


	/**
	 * @access public
	 * @return int
	 */

	public final  function count() {
		return $this->db->query('SELECT COUNT(*) FROM billet')->fetchColumn();
	}


	/**
	 * @access public
	 * @param int $start
	 * @param int $end
	 * @return array
	 */

	public final  function getList($start = -1, $end = -1, $corbeille = 0) {
		$sql = "SELECT id, title, container, dateAdd, dateEdit, corbeille FROM billet WHERE corbeille = ". $corbeille ." ORDER BY id DESC";

    // On vérifie l'intégrité des paramètres fournis.
    if ($start != -1 || $end != -1)
    {
      $sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $start;
    }

    $request = $this->db->query($sql);
    $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Billet');

    $listeBillet = $request->fetchAll();

    // On parcourt notre liste de news pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
    foreach ($listeBillet as $billet)
    {
      $billet->setDateAdd(new DateTime($billet->dateAdd()));
      $billet->setDateEdit(new DateTime($billet->dateEdit()));
    }

    $request->closeCursor();

    return $listeBillet;
	}


	/**
	 * @access public
	 * @param int $id
	 * @return Billet
	 */

	public final  function getUnique($id) {
	 $request = $this->db->prepare('SELECT id, title, container, dateAdd, dateEdit FROM billet WHERE id = :id');
	 $request->bindValue(':id', (int) $id, PDO::PARAM_INT);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Billet');

	 $billet = $request->fetch();

	 $billet->setDateAdd(new DateTime($billet->dateAdd()));
	 $billet->setDateEdit(new DateTime($billet->dateEdit()));

	 return $billet;
	}

	/**
	 * @access public
	 * @param string $title
	 * @return id
	 */

	public final  function getId($title) {
	 $request = $this->db->prepare('SELECT id, title FROM billet WHERE title = :title');
	 $request->bindValue(':title', $title);
	 $request->execute();
	 $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Billet');

	 $billet = $request->fetch();
	 $id = $billet->id();

	 return $id;
	}


}
?>
