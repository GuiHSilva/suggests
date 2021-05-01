<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {


        return view('admin.category.index');
    }

    public function select2(Request $request){

        $categories = Category::select("*")
            ->where('active', true)
            ->where(function ($q) use ($request) {
                $q->orWhere('name', 'iLIKE', "%$request->q%");
                $q->orWhere('description', 'iLIKE', "%$request->q%");
            })
            ->get();

        return response()->json($categories);

    }
}
