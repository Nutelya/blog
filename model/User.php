<?php

namespace blog\model;
class User
{
	protected  $id;
	protected  $pseudo;
	protected  $password;
	protected  $email;
	protected  $date_register;
	protected  $role;

	public final  function __construct($value = array())
	{
		if (!empty($value))
		{
			$this->hydrate($value);
		}
	}

	public final  function hydrate($data)
	{
		foreach ($data as $attribute => $value)
		{
			$methode = 'set'.ucfirst($attribute);

			if (is_callable([$this,$methode]))
			{
				$this->$methode($value);
			}
		}
	}

	public final  function setId($id)
	{
		$this->id = (int) $id;
	}

	public final  function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}

	public final  function setPassword($password)
	{
		$this->password = $password;
	}

	public final  function setEmail($email)
	{
		$this->email = $email;
	}

	public final  function setDate_register($date_register)
	{
		$this->date_register = $date_register;
	}

	public final  function setrole($role)
	{
		$this->role = $role;
	}

	public final  function id()
	{
		return $this->id;
	}

	public final  function pseudo()
	{
		return $this->pseudo;
	}

	public final  function password()
	{
		return $this->password;
	}

	public final  function email()
	{
		return $this->email;
	}

	public final  function date_register()
	{
		return $this->date_register;
	}

	public final  function role()
	{
		return $this->role;
	}
}
?>
