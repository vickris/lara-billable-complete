<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
      return "Normal Lessons";
    }

    public function premium()
    {
      return "Premium Lessons";
    }
}
