<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Drug Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $add_date
 * @property \Cake\I18n\FrozenTime $last_modify
 * @property string $name
 * @property int $views
 * @property bool $public
 *
 * @property \App\Model\Entity\DrugCategory[] $drug_category
 * @property \App\Model\Entity\DrugDescription[] $drug_description
 * @property \App\Model\Entity\DrugForm[] $drug_form
 * @property \App\Model\Entity\DrugSpecialization[] $drug_specialization
 * @property \App\Model\Entity\DrugSubstance[] $drug_substance
 * @property \App\Model\Entity\DrugTreatment[] $drug_treatment
 * @property \App\Model\Entity\Comment[] $comment
 * @property \App\Model\Entity\Tag[] $tag
 */
class Drug extends Entity
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
