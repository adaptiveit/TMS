<?php

namespace App\Http\Controllers;

//use Pingpong\Modules\Routing\Controller;
use Auth;
use Modules\Admin\Models\Role;

class DashboardController extends Controller {

    public function index() {
        $title = "Dashboard";
       
        $newComments = 100;//Article::count();
        $newTasks = 100;//Article::count();
        $newOrders = 100;//Article::count();
       
        return view('dashboard.index', compact('title', 'newComments', 'newTasks', 'newOrders'));
    }

}
