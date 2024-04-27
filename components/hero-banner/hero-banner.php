<?php
/**
* Hero Banner
* -----------------------------------------------------------------------------
*
* Hero Banner component
*/

$classes = $component_args['classes'] ?? [];
$component_id = $component_args['id'] ?? false;
$defaults = [
  'heading' => array(
    'tag'  => 'h2',
    'text' => null
  ),
  'image_id' => null,
  'image_focus_point' => null,
  'content' => '',
];

$component_data      = parse_args( $component_data, $defaults );
?>

<?php if ( is_empty( $component_data ) ) return; ?>
<section class="hero-banner relative flex bg-brand-jet justify-center items-center py-20 lg:min-h-[calc(80vh_-_var(--topOffset))] <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ); ?> data-component="hero-banner">
  <?php if($component_data['image_id']) : ?>
    <?php
      include_component(
        'fit-image',
        array(
          'image_id' => $component_data['image_id'],
          'thumbnail_size' => 'full',
          'position' => $component_data['image_focus_point'],
          'fit' =>  $component_data['image_fit'],
          'loading' => $component_data['image_loading']
        )
      );
    ?>
  <?php endif; ?>
  <img class="absolute inset-0 w-full h-full opacity-60 mix-blend-multiply" src="<?php echo get_template_directory_uri(); ?>/assets/img/grain-texture.jpg" alt="background grain texture overlay">
  <div class="absolute inset-0 w-full h-full bg-black opacity-60"></div>
  <div class="container relative z-10">
    <div class="justify-center row">
      <div class="w-full col">
        <div class="justify-center row">
          <div class="w-full col lg:w-1/2">
            <div class="text-center wysiwyg">
              <?php if( $component_data['heading'] && $component_data['heading']['text'] ) : ?>
                <<?php echo $component_data['heading']['tag']; ?> class="mb-2 hdg-6 text-brand-ivory js-fade"><?php echo $component_data['heading']['text']; ?></<?php echo $component_data['heading']['tag']; ?>>
              <?php endif; ?>
              <div class="wysiwyg">
                <?php echo $component_data['content']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
