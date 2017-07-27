<?php
namespace yiichina\adminlte;

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class Nav extends \yii\bootstrap\Nav
{
    /**
     * Renders widget items.
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            Html::addCssClass($item['options'], ['dropdown']);
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }
}