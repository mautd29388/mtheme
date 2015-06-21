<?php

get_header(); 

global $wp_query, $portfolio;

$portfolio['query'] = $wp_query;
$portfolio['next_posts'] = next_posts($portfolio['query']->max_num_pages, false);
$portfolio['style'] = ot_get_option('portfolio_style', 'style_v1');
get_template_part('contents/portfolio', '');

get_footer();