<?php
namespace yiichina\adminlte;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

class Sidebar extends \yii\widgets\Menu
{
    public $enableSearch = true;

    public $linkTemplate = '<a href="{url}">{icon}{label}{menu}</a>';
    
    public $submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";
    
    public $options = ["class" => "sidebar-menu"];
    
    public function run()
    {
        echo Html::beginTag("aside", ["class"=>"main-sidebar"]);
        echo Html::beginTag("section", ["class"=>"sidebar"]);
        if($this->enableSearch) {
            echo $this->renderSearch();
        }
        parent::run();
        echo Html::endTag("section");
        echo Html::endTag("aside");
    }
    
    protected function renderSearch()
    {
        $formOptions = ['class' => 'sidebar-form'];
        $inputOptions = ['type' => 'text', 'name' => 'q', 'value' => '', 'placeholder' => '搜索', 'class' => 'form-control'];
        $html = Html::beginForm('q', 'get', $formOptions);
        $html .= Html::beginTag("div", ['class' => 'input-group']);
        $html .= Html::tag("input", "", $inputOptions);
        $html .= Html::tag("span", 
            Html::button(Html::tag("i", "", ['class'=>'fa fa-search']), ['type'=>'submit', 'name'=>'search', 'class'=>'btn btn-flat']), 
            ['class' => 'input-group-btn']
        );
        $html .= Html::endTag("div");
        $html .= Html::endTag("form");
        return $html;
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $options['class'] = 'treeview';
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }
    
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{icon}' => Html::tag("i", null, ['class' => $item["icon"] ?? 'fa fa-file-text-o']),
                '{label}' => Html::tag('span', $item['label']),
                '{menu}' => empty($item['items']) ? null : Html::tag('span', Html::tag('i', null, ['class' =>'fa fa-angle-left pull-right']), ['class' => 'pull-right-container'])
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
            ]);
        }
    }
}
