<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;


class CustomController extends Controller
{
    public static function translit($name){
		//echo $name;
		$name = mb_strtolower ($name, 'utf-8');
		$name = trim($name);
		$name = preg_replace(
			"/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
			"-",
			$name
		);
		
		$name = str_replace('а', 'a', $name);
		$name = str_replace('б', 'b', $name);
		$name = str_replace('в', 'v', $name);
		$name = str_replace('г', 'g', $name);
		$name = str_replace('д', 'd', $name);
		$name = str_replace('е', 'ye', $name);
		$name = str_replace('ё', 'yo', $name);
		$name = str_replace('ж', 'zh', $name);
		$name = str_replace('з', 'z', $name);
		$name = str_replace('и', 'i', $name);
		$name = str_replace('й', 'yi', $name);
		$name = str_replace('к', 'k', $name);
		$name = str_replace('л', 'l', $name);
		$name = str_replace('м', 'm', $name);
		$name = str_replace('н', 'n', $name);
		$name = str_replace('о', 'o', $name);
		$name = str_replace('п', 'p', $name);
		$name = str_replace('р', 'r', $name);
		$name = str_replace('с', 's', $name);
		$name = str_replace('т', 't', $name);
		$name = str_replace('у', 'u', $name);
		$name = str_replace('ф', 'f', $name);
		$name = str_replace('х', 'h', $name);
		$name = str_replace('ц', 'c', $name);
		$name = str_replace('ч', 'ch', $name);
		$name = str_replace('ш', 'sh', $name);
		$name = str_replace('щ', 'sch', $name);
		$name = str_replace('ь', '', $name);
		$name = str_replace('ъ', '', $name);
		$name = str_replace('ы', 'y', $name);
		$name = str_replace('э', 'e', $name);
		$name = str_replace('ю', 'yu', $name);
		$name = str_replace('я', 'ya', $name);
		$name = str_replace(',', '', $name);
		$name = str_replace('.', '', $name);
		$name = str_replace('(', '', $name);
		$name = str_replace(')', '', $name);
		$name = str_replace('/', '-', $name);
		$name = str_replace('\\', '-', $name);
	
		return $name;
	}
}



