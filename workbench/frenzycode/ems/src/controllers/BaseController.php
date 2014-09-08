<?php

namespace Frenzycode\Ems\Controllers;

use Frenzycode\Ems\Models\PageModel;
use Auth;
use Redirect;
class BaseController extends \Controller {

    protected $messages = array();
    protected $pageModel;

    function __construct() {
        $this->pageModel = new PageModel();

        $this->beforeFilter(function() {
            if (Auth::guest())
                return Redirect::to('login')->withErrors(array('You have login first.'));
        }, ['except' => ['showLogin', 'doLogin']]);
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}
