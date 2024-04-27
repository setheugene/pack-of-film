<?php
  $logo  = get_field( 'global_footer_logo', 'option' );
  /*
   * create as an array to loop through
   * if they're in a list, or create them individually
   *
   * Call individually
   * $footer_menu_one = new Menu( 'footer_menu_one' );
   * $footer_menu_two = new Menu( 'footer_menu_two' );
  */

  // $menus = array(
  //   new Menu( 'footer_menu_one' ),
  //   new Menu( 'footer_menu_two' )
  // );

  $footer_menu_one = new Menu( 'footer_menu_one' );
?>
<footer class="flex items-center justify-center py-2 paragraph-small footer bg-brand-jet text-brand-ivory" role="contentinfo">
  <div class="container hidden py-12">
    <div class="row">
      <?php if ( $logo ) : ?>
        <div class="w-full col lg:w-1/4">
          <a class="inline-block" href="<?php echo esc_url(home_url('/')); ?>">
            <img class="logo logo--footer ml-auto h-[200px] w-[200px]" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?>">
          </a>
        </div>
      <?php endif; ?>

      <div class="w-full col md:w-1/4">
        <h1 class="hdg-2">Pack Of Film</h1>
      </div>

      <div class="w-full md:w-1/4 col">
        <?php if ( isset($footer_menu_one->hasItems) ) : ?>
          <nav class="">
            <h4 class=""><?php echo $footer_menu_one->name; ?></h4>
            <ul>
              <?php foreach( $footer_menu_one->items as $menu_item ): ?>
                <li class="">
                  <a class="duration-200 paragraph-default text-brand-ivory hover:text-brand-gold" href="<?php echo $menu_item->url ?>" target="<?php echo $menu_item->target; ?>"><?php echo $menu_item->title; ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        <?php endif; ?>
      </div>

    </div>
  </div>
  <div>
    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
  </div>
  <div class="social">
    <?php echo get_social_list(); ?>
  </div>
  <div>
    <a href="<?php echo get_privacy_policy_url(); ?>">Privacy Policy</a>
  </div>
</footer>
