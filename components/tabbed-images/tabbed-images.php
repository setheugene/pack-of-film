<?php
/**
* Tabbed Images
* -----------------------------------------------------------------------------
*
* Tabbed Images component
*/

$classes = $component_args['classes'] ?? [];
$component_id = $component_args['id'] ?? false;
$defaults = [
  'intro' => '',
  'tabs' => [],
];

$component_data = parse_args( $component_data, $defaults );
$intro = $component_data['intro'];
$tabs_field = $component_data['tabs'];
$tabs = [];
if(!empty($tabs_field)) {
  foreach($tabs_field as $tab) {
    $tabs[] = [
      'title' => $tab['title'],
      'image' => $tab['image'],
    ];
  }
}
?>

<?php if ( is_empty( $component_data ) ) return; ?>
<section class="tabbed-images py-12 lg:py-16 <?php echo implode( " ", $classes ); ?>" <?php echo ( $component_id ? 'id="'.$component_id.'"' : '' ); ?> data-component="tabbed-images">
  <div class="container">
    <div class="justify-center row">
      <div class="w-full col lg:w-10/12">
        <div class="items-center row">
          <div class="w-full col lg:w-1/2">
            <?php if($intro != '') : ?>
              <div class="mb-6 wysiwyg">
                <?php echo $intro; ?>
              </div>
            <?php endif; ?>
            <?php if(!empty($tabs)) : ?>
              <div class="flex flex-col gap-y-4">
                <?php foreach($tabs as $key => $tab_button) : ?>
                  <button class="w-[350px] text-left flex items-center justify-between border-b-2 border-brand-jet hdg-4 relative after:bg-brand-rust after:absolute after:w-0 after:duration-500 after:ease-out after:h-[2px] after:bottom-[-2px] [&.is-active]:after:w-full [&.is-active]:text-brand-rust after:left-0 hover:after:w-full" data-toggle-target="#tabbed-images-<?php echo $key; ?>-<?php echo $component_id; ?>" data-toggle-class data-toggle-radio-group="tabbed-images-<?php echo $component_id; ?>" <?php echo $key === 0 ? 'data-toggle-is-active' : ''; ?>>
                    <span>
                      <?php echo $tab_button['title']; ?>
                    </span>
                    <svg class="block icon size-4 icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg>
                  </button>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="relative w-full col lg:w-1/2 h-[678px]">
            <?php if(!empty($tabs)) : ?>
              <?php foreach($tabs as $key => $tab_image) : ?>
                <?php if($tab_image['image']['image_id']) : ?>
                  <div id="tabbed-images-<?php echo $key; ?>-<?php echo $component_id; ?>" class="absolute inset-0 w-full opacity-0 duration-200 [&.is-active]:opacity-100 h-[678px]">
                    <div class="relative h-[678px]">
                      <?php
                        include_component(
                          'fit-image',
                          array(
                            'image_id' => $tab_image['image']['image_id'],
                            'thumbnail_size' => 'full',
                            'position' => $tab_image['image']['image_focus_point'],
                            'fit' =>  $tab_image['image']['image_fit'],
                            'loading' => $tab_image['image']['image_loading']
                          )
                        );
                      ?>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
