<?php
namespace Frenzycode\Ems\ViewModels\Page;
use HTML;
class PageFooter {
    public $title = '';
    public $customScripts = array();
    public $initScript = '';
    public $customFunction = '';
    
    public function addScript($script)
    {
        $script = HTML::script($script);
        if (!in_array($script,$this->customScripts))
        {
            array_push($this->customScripts,$script);        
        }
    }
    
    public function addInitScript($initScript)
    {
        $this->initScript .= $initScript;
    }
    
    public function addFunctionScript($customFunction)
    {
        $this->customFunction .= $customFunction;
    }
}
