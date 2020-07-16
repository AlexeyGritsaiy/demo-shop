<?php

namespace App\Http\Controllers;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;

class HomeController extends Controller
{
    public function index()
    {
       // $regions = Region::roots()->orderBy('name')->getModels();

     //   $adverts = Advert::all();
       $categories = Category::whereIsRoot()->defaultOrder()->getModels();
       // $categories = Category::all();

       // return view('home', compact('regions', 'adverts','categories'));
        return view('home', [
            'regions' => Region::roots()->orderBy('name')->getModels(),
            'adverts' => Advert::all(),
            'categories'=> $categories,
        ]);
    }
//
//    public function category($slug)
//    {
//        $categories = Category::whereIsRoot()->defaultOrder()->getModels();
//        $category = Category::where('slug', $slug)->first();
//        $adverts = Advert::where('category_id' , '=' , $category->id)->get();
//        return view('category', compact('category','adverts','categories'));
//     //   return view('category', compact('category','categories','adverts'));
//    }
}
