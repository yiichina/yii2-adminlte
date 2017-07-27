<?php

namespace yiichina\adminlte;

use yii\bootstrap\Widget;
use yii\bootstrap\Html;

class Box extends Widget
{
    public $title;

    public $tools = false;
    
    public $footer = false;

    public $headerOptions = [];

    public $toolsOptions = [];

    public $footerOptions = [];
    
    public function init()
    {
        Html::addCssClass($this->options,'box');
        echo Html::beginTag('div', $this->options);
        echo $this->renderHeader();
        echo Html::beginTag('div', ['class' => 'box-body']);
    }
    
    public function run()
    {
        echo Html::endTag('div');
        echo $this->renderFooter();
        echo Html::endTag('div');
    }
    
    protected function renderHeader()
    {
        Html::addCssClass($headerOption, 'box-header');
        return Html::tag('div', Html::tag('h3', $this->title, ['class' => 'box-title']) . $this->renderTools(), $headerOption);
    }

    protected function renderFooter()
    {
        if($this->footer !== false) {
            Html::addCssClass($this->footerOptions,'box-footer');
            return Html::tag('div', $this->footer, $this->footerOptions);
        }
        return null;
    }

    protected function renderTools()
    {
        if($this->tools !== false) {
            Html::addCssClass($this->toolsOptions,'box-tools pull-right');
            return Html::tag("div", $this->tools, $this->toolsOptions);
        }
        return null;
    }


}
