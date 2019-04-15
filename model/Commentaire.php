<?php

namespace blog\model;

class Commentaire {

	protected  $id;
	protected  $idBillet;
	protected  $idAuteur;
	protected  $contenu;
	protected  $dateAjout;
	protected  $dateEdit;
	protected  $estNouveau;

	public final  function __construct($values = array())
	{
		if (!empty($values))
		{
			$this->hydrate($values);
		}
	}

	public final  function hydrate($data)
	{
		foreach ($data as $attribute => $value)
		{
			$methode = 'set'.ucfirst($attribute);

			if (is_callable([$this, $methode]))
			{
				$this->$methode($value);
			}
		}
	}

	public final  function setId($id)
	{
		$this->id = (int) $id;
	}

	public final  function setIdBillet($idBillet)
	{
		$this->idBillet = (int) $idBillet;
	}

	public final  function setIdAuteur($idAuteur)
	{
		$this->idAuteur = (int) $idAuteur;
	}

	public final  function setContenu($contenu)
	{
		$this->contenu = $contenu;
	}

	public final  function setDateAjout($dateAjout)
	{
		$this->dateAjout = $dateAjout;
	}

	public final  function setDateEdit($dateEdit)
	{
		$this->dateEdit = $dateEdit;
	}

	public final  function setEstNouveau($estNouveau)
	{
		$this->estNouveau = (boolean) $estNouveau;
	}

	public final  function id()
	{
		return $this->id;
	}

	public final  function idBillet()
	{
		return $this->idBillet;
	}

	public final  function idAuteur()
	{
		return $this->idAuteur;
	}

	public final  function contenu()
	{
		return $this->contenu;
	}

	public final  function dateAjout()
	{
		return $this->dateAjout;
	}

	public final  function dateEdit()
	{
		return $this->dateEdit;
	}

	public final  function estNouveau()
	{
		return $this->estNouveau;
	}
}
?>
