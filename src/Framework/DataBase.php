<?php


namespace Framework;


class DataBase
{

	private $_isDebug = false;
	private $_connection;
	private $_queries = array();

	public function __construct($hostname, $username, $password, $database, $port = '3306')
	{
		if (defined('DEV')) {
			$this->_isDebug = constant('DEV');
		}

		$this->_connection = new \mysqli($hostname, $username, $password, $database, $port);

		if ($this->_connection->connect_error) {
			throw new \Exception('Error: ' . $this->_connection->error . '<br />Error No: ' . $this->_connection->errno);
		}

		$this->_connection->set_charset("utf8");
		$this->_connection->query("SET SQL_MODE = ''");
	}

	public function __destruct()
	{
		$this->_connection->close();
	}

	public function query($sql)
	{
		if (!$this->_connection->errno) {
			if ($this->_isDebug) {
				$start = microtime(true);
			}

			$query = $this->_connection->query($sql);

			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();
			} else {
				$result = true;
			}

			if ($this->_isDebug) {
				$time = microtime(true) - $start;

				$this->_queries[] = array(
					'sql' => $sql,
					'duration' => $time,
				);
			}

			return $result;
		} else {
			throw new \Exception('Error: ' . $this->_connection->error . '<br />Error No: ' . $this->_connection->errno . '<br />' . $sql);
		}
	}

	public function escape($value)
	{
		return $this->_connection->real_escape_string($value);
	}

	public function countAffected()
	{
		return $this->_connection->affected_rows;
	}

	public function getLastId()
	{
		return $this->_connection->insert_id;
	}

	public function connected()
	{
		return $this->_connection->ping();
	}

	public function getQueries()
	{
		return $this->_queries;
	}

}