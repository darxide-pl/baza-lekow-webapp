<?php 

namespace App\Controller\Component;
use Cake\Controller\Component;

class FilterComponent extends Component
{
    public static function get($filter) {
        return isset($_GET['filter'][$filter])
            ? $_GET['filter'][$filter]
            : '';
    }

    public static function link($filter,$value) {
        return '?'.http_build_query(array_merge($_GET,['filter['.$filter.']' => $value]));
    }
}