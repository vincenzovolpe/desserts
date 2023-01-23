<?php

namespace App\Http\Controllers;

use App\Models\Dessert;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function index(Request $request)
    {

        if (Auth::check()) {
            // The user is logged in...

            // Retrieve the currently authenticated user...
            
            $id = Auth::id();

            $desserts = Dessert::with('ingredients')
                                ->where('user_id', '=', $id)
                                ->where('vendita', '=', 1)
                                ->where('disponibilita', '<>', 0)
                                ->latest()->paginate(6);

        } else {

            $desserts = Dessert::with('ingredients')
                                ->where('vendita', '=', 1)
                                ->where('disponibilita', '<>', 0)
                                ->latest()->paginate(6);

        }



        return view('welcome', ['desserts' => $desserts])->with('i', (request()->input('page', 1) - 1) * 6);

        // return view('welcome',compact('desserts'));
    }

    public function visualizza($dessert)
    {

        $desserts = Dessert::with('ingredients')->where('id', $dessert)->first();

        return view('show', ['dessert' => $desserts]);
    }

}
