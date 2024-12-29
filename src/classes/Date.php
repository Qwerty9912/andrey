<?php

namespace Match;

use DateTime;
use Error;
use ErrorException;
use Exception;

class Date
{
	private $date;
	protected $langFormmat = array('ru_Ru', 'en_US', 'fr_FR', 'de_DE', 'ja_JP');

	public function __construct($date = null)
	{

		if ($date && $userDate = DateTime::createFromFormat('Y-m-d', $date)) {
			$this->date = $userDate;
		} else {
			$this->date = new DateTime();
		}
	}

	public function getDay(): string
	{
		return $this->date->format('d');
	}
	public function getLangsFormats(): array
	{
		return $this->langFormmat;
	}
	public function getMonth($lang = null)
	{
		if (!$lang) {
			return $this->date->format('m');
		}
		if (in_array($lang, $this->langFormmat)) {
			$fmt = new \IntlDateFormatter($lang, \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
			$fmt->setPattern('MMMM');
			return $fmt->format($this->date->format('m'));
		}
		throw new \Exception('Not valid lang: ' . $lang);
	}

	public function getYear()
	{
		return $this->date->format('Y');
	}

	public function getWeekDay($lang = null)
	{
		if (!$lang) {
			return $this->date->format('l');
		}

		if (in_array($lang, $this->langFormmat)) {
			$fmt = new \IntlDateFormatter($lang, \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
			$fmt->setPattern('EEEE');
			return $fmt->format($this->date);
		}
		throw new \Exception('Not valid lang: ' . $lang);
	}

	public function addDay($value)
	{
		$this->date->modify('+1 day');
		return $this;
	}

	public function subDay(int $value)
	{

		$this->date->modify('+' . $value . ' day');
		return $this;
	}

	public function addMonth($value)
	{
		$this->date->modify('+1 month');
		return $this;
	}

	public function subMonth(int $value)
	{
		$this->date->modify('+' . $value . ' month');
		return $this;
	}

	public function addYear($value)
	{
		$this->date->modify('+1 year');
		return $this;
	}

	public function subYear(int $value)
	{
		$this->date->modify('+' . $value . ' year');
		return $this;
	}

	public function format($format)
	{
		if($this->date->format($format)){
			return $this->date->format($format);
		} 
		return false;
	}

	public function __toString()
	{
		return $this->date->format('Y-m-d');
	}
}
