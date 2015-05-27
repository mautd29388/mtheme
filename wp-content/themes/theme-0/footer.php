<?php 
$footer_social_show = ot_get_option('footer_social_show', 'on');
$footer_social = ot_get_option('footer_social');
?>		
		
		</div> <!-- End Main Content -->
		<footer>
			<div class="container">
				<!-- 
				<?php if ( $footer_social_show == 'on' && is_array($footer_social) && count($footer_social) > 0 ) {?>
				<ul class="social">
					<?php foreach ($footer_social as $social) { ?>
						<li><a href="<?php echo $social['url_social']; ?>"><i class="fa <?php echo $social['icons_social']; ?>"></i></a></li>
					<?php } ?>
				</ul>
				<?php } ?> -->
				
				<p class="pull-left">
					<?php echo ot_get_option('copyright'); ?>
				</p>
				<div id="backTop" class="readMore pull-right">
					<div class="readMore-innder">
						<a href="#">back to top <span>&uarr;</span></a>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->
			
	</div> <!-- End Wrapt -->

<?php wp_footer(); ?>

</body>
</html>
