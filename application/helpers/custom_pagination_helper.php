<?php

function custom_pagination($url, $per_page, $rows)
{
	$config	= [
		'base_url'			=> base_url($url),
		'per_page'			=> $per_page,
		'total_rows'		=> $rows,
		'full_tag_open'		=> '<ul class="pagination justify-content-center">',
		'full_tag_close'	=> '</ul>',
		'first_link'		=> 'Fisrt',
		'last_link'			=> 'Last',
		'first_tag_open'	=> '<li class="page-item">',
		'first_tag_close'	=> '</li>',
		'last_tag_open'		=> '<li class="page-item">',
		'last_tag_close'	=> '</li>',
		'prev_link'			=> 'Prev',
		'next_link'			=> 'Next',
		'prev_tag_open'		=> '<li class="page-item">',
		'prev_tag_close'	=> '</li>',
		'next_tag_open'		=> '<li class="page-item">',
		'next_tag_close'	=> '</li>',
		'num_tag_open'		=> '<li class="page-item">',
		'num_tag_close'		=> '</li>',
		'cur_tag_open'		=> '<li class="page-item active"><a class="page-link">',
		'cur_tag_close'		=> '</a></li>',
		'attributes'		=> ['class' => 'page-link']
	];

	return $config;
}
