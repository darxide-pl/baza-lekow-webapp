<?php 

namespace App\View\Helper;
use Cake\View\Helper;

class FilterHelper extends Helper
{
    public static function get($filter) {
        return isset($_GET['filter'][$filter])
            ? $_GET['filter'][$filter]
            : '';
    }

    public static function link($filter,$value) {
        return '?'.http_build_query(array_merge($_GET,['filter['.$filter.']' => $value])).'&page=1';
    }

    public function input($filter = '') {
    	if(!isset($_GET['filter'][$filter])) {
    		return '';
    	}

    	if(is_array($_GET['filter'][$filter])) {
    		$html = '';
    		foreach($_GET['filter'][$filter] as $v) {
    			$html .= '<input type="hidden" name="filter['.h($filter).'][]" value="'.h($v).'" />';
    		}

    		return $html;
    	}

    	return '<input type="hidden" name="filter['.h($filter).']" value="'.h($_GET['filter'][$filter]).'" />';
    }
}