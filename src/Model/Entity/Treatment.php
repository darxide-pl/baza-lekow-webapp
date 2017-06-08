<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Treatment extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
