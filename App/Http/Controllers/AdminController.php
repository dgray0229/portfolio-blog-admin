<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // This will use the Auth iddleware and include an index() action method
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    /**
     * In the index() action method, we included a snippet that will ensure that only admin users can visit the admin dashboard and perform CRUD operations on posts.
     * We will not start building the admin dashboard in this article but will test that our API works properly.
     * We will use Postman to make requests to the application.
     */
    {
        if (request()->user()->hasRole('admin')) {
            return view('admin.dashboard');
        }

        if (request()->user()->hasRole('user')) {
            return redirect('/home');
        }
    }
}
