<?php
$hide_sidebar = get_field( 'blog_hide_sidebar', get_option('page_for_posts') );
$add_breadcrumbs = get_field( 'blog_breadcrumbs', get_option('page_for_posts') );
$back_link = '<a class="duration-200 hover:text-brand-rust" href="'.get_permalink(get_option('page_for_posts')).'">Back to Blog</a>';

$post_categories = get_the_terms( get_the_ID(), 'category' );
$post_tags = get_the_terms( get_the_ID(), 'post_tag' );

$args = array(
  'post_type'       => 'post',
  'post_status'     => 'publish',
  'orderby'         => 'menu_order',
  'order'           => 'ASC',
  'posts_per_page'  => 2,
  'post__not_in' => [ get_the_ID() ],
  'tax_query'       => [
    [
      'taxonomy'      => 'category',
      'field'         => 'term_id',
      'terms'         => get_queried_object_id(),
      'operator'       => '='
    ]
  ]
);

$related_posts = new WP_Query( $args );
?>

<div class="blog-page blog-page--single" data-component="blog">
  <div class="container">

    <div class="blog__columns">
      <?php if ( ! $hide_sidebar ) : ?>
        <div class="blog__sidebar">
        <?php if ( !$add_breadcrumbs ) : ?>
          <div class="hidden lg:block"><?php echo $back_link; ?></div>
        <?php endif; ?>
          <?php get_template_part('templates/partials/blog-sidebar'); ?>
        </div>
      <?php endif; ?>

      <div class="blog__post <?php echo $hide_sidebar ? 'lg:col-span-3' : 'lg:col-span-2'; ?>">
        <?php if ( !$add_breadcrumbs ) : ?>
          <div class="<?php echo $hide_sidebar ? '' : 'lg:hidden'; ?>">
            <?php echo $back_link; ?>
          </div>
        <?php endif; ?>

        <article <?php post_class(); ?>>
          <?php if ( $add_breadcrumbs && function_exists('yoast_breadcrumb') ) : ?>
            <div class="flex justify-center text-center">
              <?php yoast_breadcrumb(); ?>
            </div>
          <?php endif; ?>
          <div class="single-post__headings">
            <?php
              $small_heading = get_field( 'post_small_heading' );
              $heading_tag = (empty($small_heading['tag']) || $small_heading['tag'] !== 'h1') ? 'h1' : 'h2';
            ?>

            <?php if ( ! empty($small_heading['text']) ) : ?>
              <<?php echo $small_heading['tag']; ?> class="hdg-6"><?php echo $small_heading['text']; ?></<?php echo $small_heading['tag']; ?>>
            <?php endif; ?>


            <<?php echo $heading_tag; ?> class="hdg-1">
            <?php echo get_the_title(); ?>
            </<?php echo $heading_tag; ?>> 
          </div>

          <div class="single-post__meta">
            <?php if ( !empty( $post_categories ) ) : ?>
              <ul class="flex categories">
                <?php foreach ( $post_categories as $key => $cat ) : ?>
                  <li class="px-2 py-0 leading-none border-r paragraph-large last:mr-0 border-brand-jet last:border-0"><div class="cat"><?php echo $cat->name; ?></div></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

          <div class="post">
            <?php if ( get_post_thumbnail_id() ) : ?>
              <div class="relative mb-12 aspect-16/9">
                <?php
                  include_component(
                    'fit-image',
                    array(
                      'image_id' => get_post_thumbnail_id(),
                      'position' => 'object-center',
                      'fit' => 'object-contain',
                    ),
                    array(

                    )
                  );
                ?>
              </div>
            <?php endif; ?>

            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </div>
        </article>

        <div class="grid mt-12 gap-y-8 lg:grid-cols-4 single-post__footer gap-x-gutter-full">
          <?php if ( $related_posts->have_posts() ) : ?>
            <div class="lg:col-span-2 blog__footer-block blog__block blog__block--related">
              <h2 class="mb-4 hdg-3">Related Articles</h2>
              <div class="grid grid-cols-2 gap-y-12 gap-x-gutter-full">
                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                  <?php get_template_part('templates/contents/content'); ?>
                <?php endwhile; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>


  </div>
</div>

