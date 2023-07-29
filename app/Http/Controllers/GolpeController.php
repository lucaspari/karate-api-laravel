<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Golpe;
class GolpeController extends Controller
{
    public function index()
    {
        return Golpe::all();
    }
}
