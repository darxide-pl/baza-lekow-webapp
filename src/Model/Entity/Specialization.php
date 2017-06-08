<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Specialization extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
