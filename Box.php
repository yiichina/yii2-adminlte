<?php
namespace yiichina\adminlte;
use yii\bootstrap\Widget;
use yii\bootstrap\Html;
class Box extends Widget
{
    
    const TYPE_INFO = 'info';
    const TYPE_PRIMARY = 'primary';
    const TYPE_SUCCESS = 'success';
    const TYPE_DEFAULT = 'default';
    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    
    const TOOL_COLLAPSE = 'collapse';
    const TOOL_REMOVE = 'remove';
    const TOOL_REFRESH = 'refresh';
    
    /**
     * @var string $type color style of widget*
     */
    public $type = self::TYPE_DEFAULT;
    /**
     * @var boolean $solid is solid box header*
     */
    public $solid = false;
    /**
     * @var boolean $withBorder add border after box header
     */
    public $withBorder = true;

    public $noPadding = false;
    
    /**
     * @var string
     */
    public $title = '';
    
    /**
     * the item can be a html or (remove, collapse)
     * @var array
     */
    public $tools = [];
    
    public $footer = '';
    
    /**
     * 
     * @var bool whether collapsed the box body
     */
    public $collapsed = false;
    
    protected $sysTools = [self::TOOL_COLLAPSE, self::TOOL_REMOVE];
    
    public function init()
    {
        Html::addCssClass($this->options,'box');
        Html::addCssClass($this->options,'box-' . $this->type);
        $this->options['id'] = !empty($this->options['id']) ? $this->options['id'] : $this->getId();
        if($this->solid){
            Html::addCssClass($this->options,'box-solid');
        }
        if ($this->collapsed) {
            Html::addCssClass($this->options,'collapsed-box');
            if (!in_array(self::TOOL_COLLAPSE, $this->tools)) {
                array_unshift($this->tools, self::TOOL_COLLAPSE);
            }
        }
        
        echo Html::beginTag("div", $this->options);
        echo $this->renderHeader();
        echo Html::beginTag("div", ["class" => "box-body" . ($this->noPadding ? ' no-padding' : null)]);
    }
    
    public function run()
    {
        echo Html::endTag("div");
        echo $this->renderFooter();
        echo Html::endTag("div");
    }
    
    protected function renderHeader()
    {
        $tools = '';
        foreach ($this->tools as $v) {
            if (in_array($v, $this->sysTools)) {
                $tools .= $this->$v();
            } else {
                $tools .= $v;
            }
        }
        if (!$this->title && !$tools) {
            return '';
        }
        $html = '';
        $headerOption = ["class" => "box-header"];
        $this->title = $this->title ? $this->title : ' ';
        if ($this->withBorder) {
            Html::addCssClass($headerOption, "with-border");
        }
        $html .= Html::beginTag("div", $headerOption);
        $html .= Html::tag("h3", $this->title, ["class"=>"box-title"]);
        $html .= $tools ? Html::tag("div", $tools, ["class"=>"box-tools pull-right"]) : null;
        $html .= Html::endTag("div");
        return $html;
    }
    
    protected function renderFooter()
    {
        if ($this->footer) {
            return Html::tag("div", $this->footer, ["class" => "box-footer"]);
        }
        return '';
    }
    
    protected function collapse()
    {
        $icon = Html::tag("i", "", ["class" => "fa fa-" . ($this->collapsed ? "plus" : "minus")]);
        return Html::tag("button", $icon, ["class" => "btn btn-box-tool", "data-widget" => "collapse"]);
    }
    
    protected function remove()
    {
        $icon = Html::tag("i", "", ["class" => "fa fa-times"]);
        return Html::tag("button", $icon, ["class" => "btn btn-box-tool", "data-widget" => "remove"]);
    }
}
