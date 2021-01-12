<?php


namespace Framework;


class Breadcrumb
{
	private $breadcrumbs = array();

	public function add($title, $href)
	{
		$this->breadcrumbs[$title] = array(
			'title' => $title,
			'href' => $href
		);
	}

	public function render()
	{
		$output = "<nav aria-label=\"breadcrumb\"><ol class=\"breadcrumb\">";
		foreach ($this->breadcrumbs as $breadcrumb) {
			$output .= "<li class=\"breadcrumb-item\"><a href='{$breadcrumb['href']}'>{$breadcrumb['title']}</a></li>";
		}
		$output .= "</ol></nav>";
		return $output;
	}

}