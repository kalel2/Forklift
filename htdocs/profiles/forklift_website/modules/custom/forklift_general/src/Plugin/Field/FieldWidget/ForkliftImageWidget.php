<?php

namespace Drupal\forklift_general\Plugin\Field\FieldWidget;

use Drupal\image\Plugin\Field\FieldWidget\ImageWidget;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Render\ElementInfoManagerInterface;
use Drupal\Core\Image\ImageFactory;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Tests\Core\DrupalKernel\fakeAutoloader;

/**
 * Plugin implementation of the 'image' formatter.
 *
 * @FieldWidget(
 *   id = "forklift_image",
 *   label = @Translation("Forklift image"),
 *   field_types = {
 *     "forklift_image"
 *   }
 * )
 */
class ForkliftImageWidget extends ImageWidget
{

  /**
   * Constructs an ImageWidget object.
   *
   * @param string $plugin_id
   *   The plugin_id for the widget.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the widget is associated.
   * @param array $settings
   *   The widget settings.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\Core\Render\ElementInfoManagerInterface $element_info
   *   The element info manager service.
   * @param \Drupal\Core\Image\ImageFactory $image_factory
   *   The image factory service.
   */
  public function __construct($plugin_id, $plugin_definition,
                              FieldDefinitionInterface $field_definition,
                              array $settings, array $third_party_settings,
                              ElementInfoManagerInterface $element_info,
                              ImageFactory $image_factory = NULL)
  {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings, $element_info);

  }

  public static function process($element, FormStateInterface $form_state, $form)
  {
    $item = $element['#value'];

    if (!empty($element['#files']) && $element['#preview_image_style']) {
      $element['front_image'] = array(
        '#title' => 'Use this image as front Image',
        '#type' => 'checkbox',
        '#default_value' => isset($item['front_image']) ? $item['front_image'] : '',
        '#weight' => -13,
        '#access' => true,
        '#required' => false,
        '#element_validate' =>  array(array(get_called_class(), 'validateFrontImageField'))
      );
    }

    return parent::process($element, $form_state, $form);
  }
  
}
