<?php

namespace App\Http\Controllers;
use App\Models\Golpe;
class GolpeController extends Controller
{
    public function index()
    {
        return response()->json(Golpe::all(),200);
    }
}
