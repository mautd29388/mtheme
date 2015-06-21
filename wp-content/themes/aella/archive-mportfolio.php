<?php

get_header(); 

global $wp_query, $portfolio;

$portfolio['query'] = $wp_query;
$portfolio['next_posts'] = next_posts($portfolio['query']->max_num_pages, false);
$portfolio['layout'] = ot_get_option('portfolio_layout', 'layout_1');
get_template_part('contents/content', 'portfolio');

get_footer();