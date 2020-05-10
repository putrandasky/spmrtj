<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
class ThoughtsController extends Controller
{
    public function index()
    {
      $data = App\Respondent::whereNotNull('comment')->select('name','comment','created_at')->paginate(10);
      return $data;
    }
}
