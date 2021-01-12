<?php


namespace Framework;


class Validator
{
	private $_registry;

	public function __construct(Registry $registry)
	{
		$this->_registry = $registry;
	}

	public function isEmpty($data)
	{
		return empty($data);
	}

	public function isBoolean($data)
	{
		return filter_var($data, FILTER_VALIDATE_BOOLEAN);
	}

	public function isInteger($data)
	{
		return filter_var($data, FILTER_VALIDATE_INT);
	}

	public function isFloat($data)
	{
		return filter_var($data, FILTER_VALIDATE_FLOAT);
	}

	public function isEmail($data)
	{
		if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	public function isDomainName($data)
	{
		return filter_var($data, FILTER_VALIDATE_DOMAIN);
	}

	public function isIp($data)
	{
		return filter_var($data, FILTER_VALIDATE_IP);
	}

	public function isMac($data)
	{
		return filter_var($data, FILTER_VALIDATE_MAC);
	}

	public function isUrl($data)
	{
		return filter_var($data, FILTER_VALIDATE_URL);
	}

	public function isStringLengthBetween($data, $length_start, $length_end)
	{
		return (((utf8_strlen($data) < $length_start) || (utf8_strlen($data) > $length_end)) ? true : false);
	}

	public function isStringLengthLess($data, $length)
	{
		return (utf8_strlen($data) < $length);
	}

	public function isStringLengthMore($data, $length)
	{
		return (utf8_strlen($data) > $length);
	}

}