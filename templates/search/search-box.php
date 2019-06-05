<div class="search-box">
	<a href="#" class="search-opener"><?=_icon("icon_search")?></a>
	<form method="get" class="searchform-popup" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<div class="searchform-popup-inner">
			<label for="" class="search-label"><?=__("Search for...",THEME_NAME)?></label>
			<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', THEME_NAME ); ?>"/>
			<span class="box-arrow"></span>
			
		</div>
		<a href="#" class="search-closer"><?=_icon("icon_close")?></a>
		<span class="search-loader"><?=_icon("icon_loading","spin")?></span>
	</form>
</div>