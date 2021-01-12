<?php


namespace Framework;


class Model extends AbstractController
{
	public function __get($key)
	{
		return $this->registry->get($key);
	}

	public function __set($key, $value)
	{
		$this->registry->set($key, $value);
	}

	public function getDb(): \Framework\DataBase
	{
		return $this->db;
	}

	public function getAllCountriesAsOptions()
	{
		$options = [];
		$countries = $this->getEntityManager()->getRepository('Entity\Country')->findAll();
		foreach ($countries as $country) {
			$options[$country->getCountryId()] = $country->getTitle();
		}
		return $options;
	}



}