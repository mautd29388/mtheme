<?php 
$footer_social_show = ot_get_option('footer_social_show', 'on');
$footer_social = ot_get_option('footer_social');
?>		
		
		</div> <!-- End Main Content -->

		<!-- Footer -->
		<footer class="footer">
			<?php if ( $footer_social_show == 'on' && is_array($footer_social) && count($footer_social) > 0 ) {?>
			<ul class="social">
				<?php foreach ($footer_social as $social) { ?>
					<li><a href="<?php echo $social['url_social']; ?>"><i class="fa <?php echo $social['icons_social']; ?>"></i></a></li>
				<?php } ?>
			</ul>
			<?php } ?>
			
			<p class="copyright"><?php echo ot_get_option('copyright', '&copy; 2015 Aella Events'); ?></p>
		</footer> <!-- End Footer -->
			
	</div> <!-- End Wrapt -->

<?php wp_footer(); ?>

</body>
</html>
