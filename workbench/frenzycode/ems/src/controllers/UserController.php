<?php

namespace Frenzycode\Ems\Controllers;
/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */
use Redirect;
use Validator;
use Auth;
use Input;
/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Config\PageType;

class UserController extends BaseController {

    public function showLogin() {
        $pageData = $this->pageModel->createPage(PageType::PAGE_LOGIN);
        return $this->pageModel->generateLoginView($pageData);
    }

    public function doLogin() {
        
        
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required|min:3|max:32', 
            'password' => 'required|alphaNum|min:3' 
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            
            return Redirect::to('login')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                return Redirect::to('setting/fields');
            } else {

                // validation not successful, send back to form	
                return Redirect::to('login')->withErrors(array('message' => 'Username or password is not corrected.'));
            }
        }
    }

    public function doLogout() {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

}
