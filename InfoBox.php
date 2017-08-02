<?php

namespace yiichina\adminlte;

use yii\bootstrap\Widget;
use yii\bootstrap\Html;

class InfoBox extends Widget
{
    public $footer = false;

    public $icon = false;


    public function init()
    {
        Html::addCssClass($this->options,'small-box');
        echo Html::beginTag('div', $this->options);
        echo Html::beginTag('div', ['class' => 'inner']);
    }

    public function run()
    {
        echo $this->renderIcon();
        echo Html::endTag('div');
        echo $this->renderFooter();
        echo Html::endTag('div');
    }

    protected function renderIcon()
    {
        if($this->icon !== false) {
            return Html::tag('div', $this->icon, ['class' => 'icon']);
        }
        return null;
    }

    protected function renderFooter()
    {
        if($this->footer !== false) {
            Html::addCssClass($this->footer['options'],'small-box-footer');
            return Html::a($this->footer['label'], $this->footer['url'], $this->footer['options']);
        }
        return null;
    }


}
