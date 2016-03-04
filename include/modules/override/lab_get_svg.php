<?php 

namespace modules\override;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class LabOverride{

  public function lab_get_svg_child($svg_path, $id = null, $size = array(24, 24), $is_asset = true){

    if($is_asset)
      $svg_path = get_template_directory() . '-child/assets/' .  $svg_path;

    if( ! $id)
      $id = sanitize_title(basename($svg_path));

    if(is_numeric($size))
      $size = array($size, $size);

    ob_start();

    echo file_get_contents($svg_path);

    $svg = ob_get_clean();

    $svg = preg_replace(
      array(
        '/^.*<svg/s',
        '/id=".*?"/i',
        '/width=".*?"/',
        '/height=".*?"/'
      ),
      array(
        '<svg', 'id="'.$id.'"',
        'width="'.$size[0].'px"',
        'height="'.$size[0].'px"'
      ),
      $svg
    );

    return $svg;
  }
}

?>