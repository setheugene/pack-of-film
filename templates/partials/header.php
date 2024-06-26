<?php
  $logo = get_field( 'global_logo', 'option' );
  $primary_menu   = new Menu( 'primary_navigation' );
?>
<header class="flex h-[100px] py-2 border-b navbar text-brand-jet border-brand-jet/50 bg-brand-ivory" role="banner">
  <div class="container relative flex items-end h-full">
    <div class="flex items-end justify-between w-full flex-nowrap">

      <div class="social">
        <?php echo get_social_list(); ?>
      </div>

      <?php if ( $logo ) : ?>
        <a class="absolute flex items-center justify-center -translate-x-1/2 -translate-y-1/2 rounded-full top-1/2 left-1/2 size-[100px]" href="<?php echo esc_url(home_url('/')); ?>">
          <img class="logo logo--header size-[120px]" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?>">
        </a>
      <?php endif; ?>

      <button type="button" class="md:hidden navbar-toggle" data-toggle-class="is-open" data-toggle-target="#primary-nav">
        <span class="navbar-toggle-icon"></span>
        <span class="sr-only">Main Menu</span>
      </button>

      <nav class="hidden md:block primary-nav" id="primary-nav" role="navigation">
        <ul class="flex">
          <?php if ( $primary_menu->items ) : ?>
            <?php foreach( $primary_menu->items as $menu_item ) : ?>
              <li class="mr-8 primary-menu-item last:mr-0">
                <<?php echo $menu_item->has_children ? 'button' : 'a'; ?> class="inline-block font-medium duration-200 hdg-5 hover:text-brand-rust text-brand-jet"
                  <?php if( $menu_item->has_children ) : ?>
                    data-toggle-class="is-open"
                    data-toggle-target="#menu-<?php echo $menu_item->ID; ?>" aria-expanded="false"
                    data-toggle-group="menu-accordions"
                    id="item-<?php echo $menu_item->ID; ?>"
                    <?php else : ?>
                    href="<?php echo $menu_item->url ?>"
                    target="<?php echo $menu_item->target; ?>"
                  <?php endif; ?>
                >
                  <?php echo $menu_item->title; ?>

                  <?php if ( $menu_item->has_children ) : ?>
                    <span class="inline-block">
                      <svg class="icon icon-chevron-down" aria-hidden="true"><use xlink:href="#icon-chevron-down"></use></svg>
                    </span>
                  <?php endif; ?>
                </<?php echo $menu_item->has_children ? 'button' : 'a'; ?>>

                <?php if ( $menu_item->has_children ) : ?>
                  <div class="hidden" id="menu-<?php echo $menu_item->ID; ?>" aria-hidden="true" aria-labelledby="item-<?php echo $menu_item->ID; ?>">
                    <ul>
                      <?php foreach ( $menu_item->children as $child_item ) : ?>
                        <li class="">
                          <a href="<?php echo $child_item->url; ?>" target="<?php echo $child_item->target; ?>"><?php echo $child_item->title; ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </nav>

    </div>
  </div>
</header>
