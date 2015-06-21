<?php 

global $portfolio;

$portfolio_cat = get_terms('mportfolio_cat');

if ( $portfolio['style'] == 'portfolio_v1' ) { ?>
<section id="portfolio" class="portfolio portfolioIsotope <?php echo $portfolio['style']; ?>">

</section>
<?php } ?>