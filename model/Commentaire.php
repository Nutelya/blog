<?php
/**
 *
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 */

class Commentaire {

	/**
	 *
	 * @var int
	 * @access protected
	 */
	protected  $id;

	/**
	 *
	 * @var int
	 * @access protected
	 */
	protected  $idBillet;

	/**
	 *
	 * @var int
	 * @access protected
	 */
	protected  $idAuteur;

	/**
	 *
	 * @var string
	 * @access protected
	 */
	protected  $contenu;

	/**
	 *
	 * @var string
	 * @access protected
	 */
	protected  $dateAjout;

	/**
	 *
	 * @var string
	 * @access protected
	 */
	protected  $dateEdit;

	/**
	 *
	 * @var boolean
	 * @access protected
	 */
	protected  $estNouveau;


	/**
	 * @access public
	 * @param array $values
	 * @return void
	 */

	public final  function __construct($values = array()) {
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}


	/**
	 * @access public
	 * @param array $data
	 * @return void
	 */

	public final  function hydrate($data) {
		foreach ($data as $attribute => $value)
		{
			$methode = 'set'.ucfirst($attribute);

			if (is_callable([$this, $methode]))
			{
				$this->$methode($value);
			}
		}
	}


	/**
	 * @access public
	 * @param int $id
	 * @return void
	 */

	public final  function setId($id) {
		$this->id = (int) $id;
	}


	/**
	 * @access public
	 * @param int $idBillet
	 * @return void
	 */

	public final  function setIdBillet($idBillet) {
		$this->idBillet = (int) $idBillet;
	}


	/**
	 * @access public
	 * @param int $idAuteur
	 * @return void
	 */

	public final  function setIdAuteur($idAuteur) {
		$this->idAuteur = (int) $idAuteur;
	}


	/**
	 * @access public
	 * @param string $contenu
	 * @return void
	 */

	public final  function setContenu($contenu) {
		$this->contenu = $contenu;
	}


	/**
	 * @access public
	 * @param string $datAjout
	 * @return void
	 */

	public final  function setDateAjout($dateAjout) {
		$this->dateAjout = $dateAjout;
	}


	/**
	 * @access public
	 * @param string $dateEdit
	 * @return void
	 */

	public final  function setDateEdit($dateEdit) {
		$this->dateEdit = $dateEdit;
	}

	/**
	 * @access public
	 * @param boolean $estNouveau
	 * @return void
	 */

	public final  function setEstNouveau($estNouveau) {
		$this->estNouveau = (boolean) $estNouveau;
	}


	/**
	 * @access public
	 * @return int const
	 */

	public final  function id() {
		return $this->id;
	}


	/**
	 * @access public
	 * @return int const
	 */

	public final  function idBillet() {
		return $this->idBillet;
	}


	/**
	 * @access public
	 * @return int const
	 */

	public final  function idAuteur() {
		return $this->idAuteur;
	}


	/**
	 * @access public
	 * @return string const
	 */

	public final  function contenu() {
		return $this->contenu;
	}


	/**
	 * @access public
	 * @return string const
	 */

	public final  function dateAjout() {
		return $this->dateAjout;
	}


	/**
	 * @access public
	 * @return string const
	 */

	public final  function dateEdit() {
		return $this->dateEdit;
	}

	/**
	 * @access public
	 * @return boolean const
	 */

	public final  function estNouveau() {
		return $this->estNouveau;
	}

}
?>
