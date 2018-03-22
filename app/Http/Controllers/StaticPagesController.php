<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
	public function index()
	{
		$feed_items = [];
		if (Auth::check()) {
			$feed_items = Auth::user()->feed()->paginate(30);
		}

		return view('index', ['feed_items' => $feed_items]);
    }
}
