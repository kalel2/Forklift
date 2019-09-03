<?php

namespace Drupal\forklift_general\Plugin\Field\FieldFormatter;

use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;

/**
 * Plugin implementation of the 'image' formatter.
 *
 * @FieldFormatter(
 *   id = "forklift_image",
 *   label = @Translation("Image"),
 *   field_types = {
 *     "forklift_image"
 *   },
 *   quickedit = {
 *     "editor" = "forklift_image"
 *   }
 * )
 */
class ForkliftImageFormatter extends ImageFormatter
{

}
