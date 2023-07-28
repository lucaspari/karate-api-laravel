<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use Illuminate\Http\Request;

class KataController extends Controller
{
    public function index()
    {
        return Kata::all();
    }
}
