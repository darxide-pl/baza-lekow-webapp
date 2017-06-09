<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Substance extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
