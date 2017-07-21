<?php

namespace yiichina\adminlte;

use yii\web\AssetBundle;

/**
 * This is just an example.
 */
class AdminlteAsset extends AssetBundle
{
    public $sourcePath = '@bower/adminlte/dist';
    public $css = [
        'css/AdminLTE.min.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
