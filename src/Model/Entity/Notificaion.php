<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Drugnotification Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $add_date
 * @property int $user_id
 * @property int $drug_id
 * @property int $comment_id
 * @property int $type
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Drug $drug
 * @property \App\Model\Entity\Comment $comment
 */
class Notification extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
