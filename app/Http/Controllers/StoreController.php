<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Http\Response;

class StoreController extends Controller
{
	public function index()
	{
		$models = App\Store::all();

		return view('storage.index', ['models' => $models]);
	}

	public function store(Request $request)
	{
//		App\Storage::create();

		$url = $request->url;

		Storage::disk('local')->put($url, 'Contents');

//
//		return redirect('/');

//		return 'hello man!';

	}

}
