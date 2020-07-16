<?php

namespace App\Http\Livewire;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class Search extends Component
{
    public $searchTerm;
    public $adverts;
    public $highlightIndex;
    public $searchCategoryId;

    public function mount()
    {

    }

    public function resetState()
    {
        $this->searchTerm = '';
        $this->adverts = [];
        $this->highlightIndex = 0;
    }

//    public function render()
//    {
//        $searchTerm = '%' . $this->searchTerm . '%';
//        $this->adverts = Advert::where('title','like',$searchTerm)->get();
//        return view('livewire.search');
//    }
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->adverts) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->adverts) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectAdvert()
    {

        $advert = $this->adverts[$this->highlightIndex] ?? null;
        if ($advert) {
            $this->redirect(route('adverts.show', $advert['id']));
        }
    }

    public function updatedQuery()
    {
                $searchTerm = '%' . $this->searchTerm . '%';
        $this->adverts = Advert::where('title','like',$searchTerm)
            ->get()
            ->toArray();
//        $this->adverts = Advert::where('title', 'like', '%' . $this->searchTerm . '%')
//            ->get()
//            ->toArray();
    }

    public function render()
    {
        $categories = Category::all();
        $searchTerm = '%' . $this->searchTerm . '%';

        /** @var Builder|Advert $query */
        $query = Advert::where('title','like', $searchTerm);

        if($this->searchCategoryId) {
            $query->whereHas('categories', function($query) {
                $query->where('category_id', '=', $this->searchCategoryId);
            });
        }

        $this->adverts = $query->get();

        return view('livewire.search',compact('categories'));
    }

}
