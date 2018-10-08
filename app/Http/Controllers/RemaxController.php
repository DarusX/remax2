<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class RemaxController extends Controller
{
    public function properties()
    {
        return view('public.properties')->with([
            'properties' => Property::all()
        ]);
    }

    public function property(Property $property)
    {
        return view('public.property')->with([
            'property' => $property
        ]);
    }
}
