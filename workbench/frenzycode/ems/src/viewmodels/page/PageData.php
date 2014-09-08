<?php
namespace Frenzycode\Ems\ViewModels\Page;
class PageData {
    public $head;
    public $footer ;
    public $body;
    public $bodyTemplate;
    
    function __construct() {
        $this->head = new PageHead();
        $this->footer = new PageFooter();
        $this->body = new PageBody();
    }
    
    public function addStyle($style) {
        $this->head->addStyle($style);
    }
    
     public function addScript($script)
    {
        $this->footer->addScript($script);
    }
    
    public function addInitScript($initScript)
    {
        $this->footer->addInitScript($initScript);
    }
    
    public function addFunctionScript($customFunction)
    {
        $this->footer->addFunctionScript($customFunction);
    }
}
