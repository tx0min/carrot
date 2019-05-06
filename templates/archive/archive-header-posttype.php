<!--.archive-header-->
<div class="<?php archive_class(); ?> ">	
	<div class="container" >	
		<div class="row">
			<div class="col-sm-6">
				<h1 class="page-title" >
				<?php 	
					the_archive_title();	
				?>	
				</h1>
				<h3><span class="archive-count"><strong><?php carrot_found_posts();?></strong> <?=__("Articles",THEME_NAME)?></span></h3>
			</div>
			<div class="col-sm-6">
				<?php if(carrot_page_breadcrumb_is_visible()) carrot_breadcrumb(); ?>
			</div>
		</div>
	</div>
</div>