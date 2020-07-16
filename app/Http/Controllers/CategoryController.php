<?php



namespace App\Http\Controllers;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $categories = Category::whereIsRoot()->defaultOrder()->getModels();
        /** @var Category $category */
        $category = Category::where('slug', $slug)->first();

        $adverts = $category->adverts;

        return view('category', compact('category','adverts','categories'));
    }
}