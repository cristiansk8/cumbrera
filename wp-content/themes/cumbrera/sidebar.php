<div class="left content-right relacionados">
    <h4>CATEGORIES</h4>
    <ul>
		<?php 
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
			) );
			foreach( $categories as $category ) {
		?>
          <li><a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a></li>
        <?php } ?>
    </ul>
    <h4>MEMBERS</h4>
    <ul>
		<?php 
		$args = array(
			'blog_id'      => $GLOBALS['blog_id'],
			'role'         => '',
			'orderby'      => 'display_name',
			'order'        => 'ASC',
			'fields'       => 'all'
		 );
		$users = get_users($args);

		foreach ( $users as $user ) { ?>
			<li><a href="<?php echo get_author_posts_url($user->ID); ?>"><?php echo $user->display_name; ?></a></li>
        <?php } ?>
    </ul>
</div>