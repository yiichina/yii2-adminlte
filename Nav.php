<?php
namespace yiichina\adminlte;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
class Nav extends \yii\bootstrap\Nav
{
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (isset($item['small'])) {
                $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
                $small = $item['small'];
                $small = is_array($small) ? $small : ['label' => $small];
                $class = isset($small['class']) ? $small['class'] : "label label-danger";
                $item['label'] = ($encodeLabel ? Html::encode($item['label']) : $item['label']) . Html::tag("small", ArrayHelper::remove($small, 'label'), ["class" => $class]);
                $item['encode'] = false;
            }
            
            $items[] = $this->renderItem($item);
        }
    
        return Html::tag('ul', implode("\n", $items), $this->options);
    }
}
