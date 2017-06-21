<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DrugComment Entity
 *
 * @property int $id
 * @property int $drug_id
 * @property string $device_id
 * @property string $name
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $add_date
 * @property int $user_id
 *
 * @property \App\Model\Entity\Drug $drug
 * @property \App\Model\Entity\Device $device
 * @property \App\Model\Entity\User $user
 */
class Comment extends Entity
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
