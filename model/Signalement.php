<?php

namespace blog\model;
class Signalement
{
	protected  $id;
	protected  $idBillet;
	protected  $idAuteur;
	protected  $idCommentaire;
	protected  $dateAjout;
	protected  $estNouveau;
	protected  $idSignale;

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

	public final  function setIdCommentaire($idCommentaire)
	{
		$this->idCommentaire = $idCommentaire;
	}

	public final  function setDateAjout($dateAjout)
	{
		$this->dateAjout = $dateAjout;
	}

	public final  function setEstNouveau($estNouveau)
	{
		$this->estNouveau = $estNouveau;
	}

	public final  function setIdSignale($idSignale)
	{
		$this->idSignale = $idSignale;
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

	public final  function idCommentaire()
	{
		return $this->idCommentaire;
	}

	public final  function dateAjout()
	{
		return $this->dateAjout;
	}

	public final  function estNouveau()
	{
		return $this->estNouveau;
	}

	public final  function idSignale()
	{
		return $this->idSignale;
	}
}
?>
