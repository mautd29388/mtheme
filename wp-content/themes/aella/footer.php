<?php 
$footer_social_show = ot_get_option('footer_social_show', 'on');
$footer_social = ot_get_option('footer_social');
?>		
		
		</div> <!-- End Main Content -->

		<!-- Footer -->
		<footer class="footer">
			<div class="footer-grey">
	      		<div class="border-gray pull-down-140"></div>
	      		<?php if ( is_active_sidebar('footer') ) { ?>
	      		<div class="container pull-down-30">
	      			<div class="row push-down-20">
	      			<?php dynamic_sidebar('footer'); ?>
	      			</div>
	      		</div>
	      		<?php } ?>
	      	</div>
	      	<div class="container">
	      		<div class="copyright"><?php echo ot_get_option('copyright', '©FITNESS THEME 2013'); ?></div>
	      	</div>
	    </footer>
			
	</div> <!-- End Wrapt -->

<?php wp_footer(); ?>

</body>
</html>
