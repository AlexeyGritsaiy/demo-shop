<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\SearchRequest;
use App\Http\Router\AdvertsPath;
use App\Models\Product;
use App\AdvertsFilter;
use App\ReadModel\AdvertReadRepository;
use App\UseCases\Adverts\SearchService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function index(SearchRequest $request, AdvertsPath $path, AdvertsFilter $filters)
    {
        //$adverts = Advert::where('title', 'like', '%' . $request->get('title').'%' )->paginate(20);
        $adverts = Advert::with('info')->filter($filters)->get();
//        dd($adverts);
        $category = $path->category;

//
        $result = $this->search->search($category, $request, 20, $request->get('page', 1));
//
//        $adverts = $result->adverts;
        $categoriesCounts = $result->categoriesCounts;

        $query = $category ? $category->children() : Category::whereIsRoot();
        $categories = $query->defaultOrder()->getModels();

        $categories = array_filter($categories, function (Category $category) use ($categoriesCounts) {
            return isset($categoriesCounts[$category->id]) && $categoriesCounts[$category->id] > 0;
        });

        return view('adverts.index', compact(
            'category',
            'categories',
            'categoriesCounts',
            'adverts'
        ));
    }

    public function show(Advert $advert,Request $request)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        $user = Auth::user();

        $productsQuery = Advert::with('categories');
        $adverts = $productsQuery->paginate(6)->withPath("?".$request->getQueryString());
        return view('adverts.show', compact('advert', 'user','adverts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        $categories = Category::get();
        return view('admin.adverts.adverts.form', compact('advert', 'categories'));
    }
    public function phone(Advert $advert): string
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return $advert->user->phone;
    }

    public function showCategories(Category $category)
    {
        $parentAttributes = $category->parentAttributes();
        $attributes = $category->attributes()->orderBy('sort')->get();

        return view('adverts.index', compact('category', 'attributes', 'parentAttributes'));
    }

    public function deademon(Request $request, AdvertsFilter $filters)
    {
        if ($request->expectsJson())
        {

            $products = Advert::with('info')->filter($filters)->get();

            return response()->json($products->toArray());
        }
        return view('product.index', compact('products'));
    }
}
