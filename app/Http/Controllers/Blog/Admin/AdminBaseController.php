<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as MainBaseController;
use Illuminate\Http\Request;

abstract class AdminBaseController extends MainBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');

        if (!session()->has('admin')) {

            session(['admin' => true]);
        }
    }
}
