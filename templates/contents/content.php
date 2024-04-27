<?php
/**
 * Any additional classes to apply to the main component container.
 *
 * @var array
 * @see args['classes']
 */
$classes = ( isset( $component_args['classes'] ) ? $component_args['classes'] : array() );

/**
 * ID to apply to the main component container.
 *
 * @var array
 * @see args['id']
 */
$component_id   = ( isset( $component_args['id'] ) ? $component_args['id'] : false );

$post = !empty($component_data['post']) ? $component_data['post'] : get_the_ID();
?>
<article <?php post_class(implode( " ", $classes ), $post ); ?> <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ); ?>>
  <?php
    $cats = get_the_terms( $post, 'category' );
    $corner_tag = true;
    $content_tag = false;
  ?>
  <a class="post__card group" href="<?php echo get_permalink($post) ?>" title="Read more about <?php echo get_the_title($post); ?>">
    <div class="relative overflow-hidden post__image-wrapper aspect-2/3">
      <?php
        include_component(
          'fit-image',
          array(
            'image_id' => get_post_thumbnail_id($post),
            'position' => 'object-center'
          ),
          array(
            'classes' => ['post__image']
          )
        );
      ?>

      <?php if ( !empty($cats[0]) && $corner_tag ) : ?>
        <div class="relative z-10 flex flex-col items-center justify-center w-1/2 h-10 px-3 pt-1 text-xl text-center uppercase duration-200 ease-in-out post__category-corner-tag group-hover:text-brand-ivory paragraph-large group-hover:w-full group-hover:bg-black/50 bg-brand-ivory text-brand-jet">
          <p class="block hdg-6 group-hover:hidden"><?php echo $cats[0]->name; ?></p>
          <p class="hidden hdg-6 group-hover:block">Learn More <span class="sr-only">about <?php echo get_the_title( $post ); ?></span></p>
        </div>
      <?php endif; ?>
      <img class="absolute inset-0 object-cover w-full h-full opacity-20 mix-blend-multiply group-hover:opacity-0" src="<?php echo get_template_directory_uri(); ?>/assets/img/grain-texture.jpg" alt="background grain texture overlay">
      <div class="absolute inset-0 flex items-center justify-center w-full h-full p-3 duration-200 ease-in-out opacity-100 group-hover:opacity-0 bg-black/60">
        <h2 class="w-full text-center hdg-3 text-brand-ivory">
          <?php echo get_the_title( $post ); ?>
        </h2>
      </div>
    </div>
  </a>
</article>
