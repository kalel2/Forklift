<?php

namespace Drupal\forklift_general\Plugin\Field\FieldFormatter;

/**
 * Plugin implementation of the '<flexslider>' formatter.
 *
 * @FieldFormatter(
 *   id = "forklift_flexslider",
 *   label = @Translation("ForkliftFlexSlider"),
 *   field_types = {
 *     "forklift_image"
 *   }
 * )
 */
use Drupal\flexslider_fields\Plugin\Field\FieldFormatter\FlexsliderFormatter;

class FlexsliderExtendFormatter extends FlexsliderFormatter
{

}
