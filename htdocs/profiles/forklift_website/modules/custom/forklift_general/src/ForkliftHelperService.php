<?php

namespace Drupal\forklift_general;

class ForkliftHelperService
{
  /**
   * @param $field_type string
   * @param $node_type string
   * @return string | null
   */
  public function getFieldNameByFieldTypeFonNodeType($field_type, $node_type) {
    $fields = \Drupal::service('entity_field.manager')->getFieldMapByFieldType($field_type)['node'];
    foreach ($fields as $field_name => $value) {
      if (key($value['bundles']) === $node_type) {
        return $field_name;
      }
    }
    return null;
  }
}
