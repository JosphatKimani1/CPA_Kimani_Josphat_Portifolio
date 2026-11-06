<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Portifolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function AllRecentWorks(){
        $works = Portifolio::Latest()->get();
        return view('backend.portfolio.all_recent_works', compact('works'));

    } //End Method
}
