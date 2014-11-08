<?php

/**
 * @file
 * Contains \Drupal\block_content\Entity\BlockContentType.
 */

namespace Drupal\block_content\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\block_content\BlockContentTypeInterface;

/**
 * Defines the block content type entity.
 *
 * @ConfigEntityType(
 *   id = "block_content_type",
 *   label = @Translation("Block content type"),
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\block_content\BlockContentTypeForm",
 *       "add" = "Drupal\block_content\BlockContentTypeForm",
 *       "edit" = "Drupal\block_content\BlockContentTypeForm",
 *       "delete" = "Drupal\block_content\Form\BlockContentTypeDeleteForm"
 *     },
 *     "list_builder" = "Drupal\block_content\BlockContentTypeListBuilder"
 *   },
 *   admin_permission = "administer blocks",
 *   config_prefix = "type",
 *   bundle_of = "block_content",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "delete-form" = "entity.block_content_type.delete_form",
 *     "edit-form" = "entity.block_content_type.edit_form"
 *   }
 * )
 */
class BlockContentType extends ConfigEntityBundleBase implements BlockContentTypeInterface {

  /**
   * The block content type ID.
   *
   * @var string
   */
  public $id;

  /**
   * The block content type label.
   *
   * @var string
   */
  public $label;

  /**
   * The default revision setting for block content of this type.
   *
   * @var bool
   */
  public $revision;

  /**
   * The description of the block type.
   *
   * @var string
   */
  public $description;

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    if (!$update && !$this->isSyncing()) {
      block_content_add_body_field($this->id);
    }
  }

}
