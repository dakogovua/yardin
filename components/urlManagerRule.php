<?php

namespace app\components;


use app\admin\controllers\CustomController;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;


class urlManagerRule extends BaseObject implements UrlRuleInterface
{
		public function createUrl($manager, $route, $params)
		{
			if ($route === 'autosklo/marka')
			{
				$url = 'marka'.implode('/', $params);
				return $url;
			}
			
			return false;
		}
		
		public function parseRequest($manager, $request)
		{
			$pathInfo = $request -> getPathInfo();
			
			$urls = explode('/', $pathInfo);
			
			print_r($urls);
		}
}


?>