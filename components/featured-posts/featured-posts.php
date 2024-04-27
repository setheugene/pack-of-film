<?php
/**
* Featured Posts
* -----------------------------------------------------------------------------
*
* Featured Posts component
*/

$classes = $component_args['classes'] ?? [];
$component_id = $component_args['id'] ?? false;
$defaults = [
  'content' => '',
  'posts' => [],
];

$component_data = parse_args( $component_data, $defaults );
$posts = $component_data['posts'];
?>

<?php if ( is_empty( $component_data ) ) return; ?>
<section class="featured-posts py-10 lg:py-14 <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ); ?> data-component="featured-posts">
  <div class="container">
    <div class="justify-center row">
      <div class="w-full col lg:w-10/12">
        <div class="justify-center row">
          <?php if($component_data['content'] != '') : ?>
            <div class="w-full col">
              <div class="wysiwyg">
                <?php echo $component_data['content']; ?>
              </div>
            </div>
          <?php endif; ?>
          <?php if(!empty($posts)) : ?>
            <?php foreach($posts as $featured_post) : ?>
              <article class="w-full col md:w-1/2 lg:w-1/4" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ); ?>>
                <?php
                  $cats = get_the_terms( $featured_post, 'category' );
                  $corner_tag = true;
                  $content_tag = false;
                ?>
                <a class="post__card group" href="<?php echo get_permalink($featured_post) ?>" title="Read more about <?php echo get_the_title($featured_post); ?>">
                  <div class="relative overflow-hidden post__image-wrapper aspect-2/3">
                    <?php
                      include_component(
                        'fit-image',
                        array(
                          'image_id' => get_post_thumbnail_id($featured_post),
                          'position' => 'object-center'
                        ),
                        array(
                          'classes' => ['post__image']
                        )
                      );
                    ?>
                    <img class="absolute inset-0 object-cover w-full h-full opacity-20 mix-blend-multiply group-hover:opacity-0" src="<?php echo get_template_directory_uri(); ?>/assets/img/grain-texture.jpg" alt="background grain texture overlay">
                    <?php if ( !empty($cats[0]) && $corner_tag ) : ?>
                      <div class="relative z-10 flex flex-col items-center justify-center w-1/2 h-10 px-3 pt-1 text-xl text-center uppercase duration-200 ease-in-out post__category-corner-tag group-hover:text-brand-ivory paragraph-large group-hover:w-full group-hover:bg-black/50 bg-brand-ivory text-brand-jet">
                        <p class="block hdg-6 group-hover:hidden"><?php echo $cats[0]->name; ?></p>
                        <p class="hidden hdg-6 group-hover:block">Learn More <span class="sr-only">about <?php echo get_the_title( $featured_post ); ?></span></p>
                      </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 flex items-center justify-center w-full h-full p-3 duration-200 ease-in-out opacity-100 group-hover:opacity-0 bg-black/60">
                      <h2 class="w-full text-center hdg-3 text-brand-ivory">
                        <?php echo get_the_title( $featured_post ); ?>
                      </h2>
                    </div>
                  </div>
                </a>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
