<?php

use Framework\Pagination;

function renderPagination(int $page, int $total, int $limit, string $url) {
	$pagination = new Pagination();
	$pagination->total = $total;
	$pagination->page = $page;
	$pagination->limit = $limit;
	$pagination->url = $url;

	return $pagination->render();
}