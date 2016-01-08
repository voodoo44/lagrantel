<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return View
     */
    public function showProfile()
    {
        $variableList = array(
            'var' => 'with vars',
            'postfix' => '1'
        );

        return view('showprofile', $variableList);
    }
}