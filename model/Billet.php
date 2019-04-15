<?php

namespace blog\model;
class Billet
{

	protected  $id;
	protected  $title;
	protected  $container;
	protected  $dateAdd;
	protected  $dateEdit;
	protected  $corbeille;

	public   function __construct($value = array())
	{
		if (!empty($value))
			{
				$this->hydrate($value);
			}
	}

	public   function hydrate($data)
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

	public   function setId($id)
	{
		$this->id = (int) $id;
	}

	public   function setTitle($title)
	{
		$this->title = $title;
	}

	public   function setContainer($container)
	{
		$this->container = $container;
	}


	public   function setDateAdd($dateAdd)
	{
		$this->dateAdd = $dateAdd;
	}

	public   function setDateEdit($dateEdit)
	{
		$this->dateEdit = $dateEdit;
	}

	public   function setCorbeille($corbeille)
	{
		$this->corbeille = (int) $corbeille;
	}


	public   function id()
	{
		return $this->id;
	}

	public   function title()
	{
		return $this->title;
	}

	public   function container()
	{
		return $this->container;
	}

	public   function dateAdd()
	{
		return $this->dateAdd;
	}

	public   function dateEdit()
	{
		return $this->dateEdit;
	}

	public   function corbeille()
	{
		return $this->corbeille;
	}
}

?>
