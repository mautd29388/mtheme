
<form role="search" method="get" class="searchform"
	action="<?php echo home_url( '/' ); ?>">
	<label class="fa fa-search" for="s"></label>
		<input type="search" class="search-field"
		placeholder="<?php echo esc_attr_x( 'To search type and hit enter', 'placeholder' ) ?>"
		value="<?php echo get_search_query() ?>" name="s"
		title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
		<input type="submit" value="&#xf002;" id="searchsubmit" name="submit" class="submit fa">
</form>

