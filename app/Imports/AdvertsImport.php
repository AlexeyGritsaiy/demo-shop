<?php

namespace App\Imports;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Advert\Manufacturer;
use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdvertsImport implements WithHeadingRow, ToModel
{
    public function model(array $row)
    {
        $advert = $this->createAdvert($row);
        $this->createAttributes($advert, $row);
        $this->createPhoto($advert, $row);
    }

    protected function createPhoto(Advert $advert, array $row)
    {
        if (isset($row['image_urls_xyz'])) {
            $urls = explode('|', $row['image_urls_xyz']);

            foreach ($urls as $url) {
                $content = @file_get_contents($url);

                $path = 'advert/' . $advert->id . '/images';

                if (!File::exists(storage_path('app/public/' . $path))) {
                    File::makeDirectory($path, 0755, true);
                }

                $filename = $path . '/' . Str::random(16) . '.jpg';

                Storage::drive('public')->put($filename, $content);

                $advert->photos()->create([
                    'file' => $filename
                ]);
            }
        }
    }

    protected function createAdvert(array $row): Advert
    {
        $manufacturer = $this->findOrCreateManufacturer($row['manufacturer']);

        if (!$advert = Advert::find($row['product_id'])) {
            $advert = new Advert([
                'title' => $row['name'],
//                'content' => $row['description'],
                'price' => $row['unit_price'],
                'manufacturer_id' => $manufacturer->id,
                'user_id' => \Auth::id(),
                'status' => Advert::STATUS_DRAFT,
            ]);

            $advert->save();
        } else {
            $advert->update([
                'title' => $row['name'],
                'content' => $row['description'],
                'price' => $row['unit_price'],
                'manufacturer_id' => $manufacturer->id,
            ]);
        }

        $this->findOrCreateCategory($advert, $row['categories_xyz']);

        return $advert;
    }

    /**
     * @param Advert $advert
     * @param string $name
     * @return array|Category[]
     */
    protected function findOrCreateCategory(Advert $advert, string $name)
    {
        $categories = explode('|', $name);

        if (!empty($categories)) {
            $ids = [];
            foreach ($categories as $categoryName) {
                $category = Category::where('name', '=', $categoryName)->first();
                if (!$category) {
                    $category = Category::create([
                        'name' => $categoryName,
                        'slug' => Str::slug($categoryName),
                        'parent_id' => null,
                    ]);
                }

                $ids[] = $category->id;
            }

            $advert->categories()->sync($ids);
        }
    }

    protected function findOrCreateManufacturer(string $name): Manufacturer
    {
        $manufacturer = Manufacturer::where('name', '=', $name)->first();

        if (!$manufacturer) {
            $manufacturer = Manufacturer::create([
                'name' => $name,
            ]);
        }

        return $manufacturer;
    }

    protected function createAttributes(Advert $advert, array $row)
    {
        if (isset($row['feature_namevalueposition'])) {
            $attributes = explode('|', $row['feature_namevalueposition']);
            $advert->values()->delete();

            foreach ($attributes as $attribute) {
                $data = explode(':', $attribute);

                DB::transaction(function () use ($data, $advert) {
                    $attribute = Attribute::where('name', '=', $data[0])->first();
                    //  dd($data[0]);

                    if (!$attribute) {
                        $attribute = Attribute::create([
                            'name' => $data[0],
                            'type' => Attribute::TYPE_STRING,
                            'required' => true,
                            'variants' => [
                                $data[1]
                            ],
                            'sort' => $data[2],
                        ]);
                    }

                    $advert->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $data[1],
                    ]);

                    $advert->update();
                });
            }
        }
    }
}