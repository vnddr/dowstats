<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ChartsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $jsOptions = [
        'position' => 'POS_HEAD'
    ];
    public $js = [
        'js/highcharts.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}