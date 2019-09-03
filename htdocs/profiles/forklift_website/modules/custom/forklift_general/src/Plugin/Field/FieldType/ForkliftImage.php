<?php

namespace Drupal\forklift_general\Plugin\Field\FieldType;

use Drupal\image\Plugin\Field\FieldType\ImageItem;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'image' field type.
 *
 * @FieldType(
 *   id = "forklift_image",
 *   label = @Translation("Forklift image"),
 *   category = @Translation("Reference"),
 *   default_widget = "forklift_image",
 *   default_formatter = "image",
 *   column_groups = {
 *     "file" = {
 *       "label" = @Translation("File"),
 *       "columns" = {
 *         "target_id", "width", "height"
 *       },
 *       "require_all_groups_for_translation" = TRUE
 *     },
 *     "alt" = {
 *       "label" = @Translation("Alt"),
 *       "translatable" = TRUE
 *     },
 *     "title" = {
 *       "label" = @Translation("Title"),
 *       "translatable" = TRUE
 *     },
 *     "front_image" = {
 *       "label" = @Translation("Use as front Image"),
 *       "translatable" = TRUE
 *     },
 *   },
 *   list_class = "\Drupal\file\Plugin\Field\FieldType\FileFieldItemList",
 *   constraints = {"ReferenceAccess" = {}, "FileValidation" = {}}
 * )
 */
class ForkliftImage extends ImageItem
{

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings()
  {
    return parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings()
  {
    return parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition)
  {
    $schema = parent::schema($field_definition);
    $schema['columns']['front_image'] = [
      'description' => 'Flag to control whether this file should be displayed as front image.',
      'type' => 'int',
      'size' => 'tiny',
      'unsigned' => TRUE,
      'default' => 0,
    ];
    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
  {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['front_image'] = DataDefinition::create('boolean')
      ->setLabel(t('Use as front Image'))
      ->setDescription(t('Flag to control whether this file should be displayed as front image.'));

    return $properties;
  }
}
