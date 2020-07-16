<?php

declare(strict_types=1);

namespace App\Services\Advert;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Advert\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvertPhotoService
{
    /**
     * @param  Advert  $item
     * @param  UploadedFile[]|null  $files
     * @param  bool  $isCreate
     * @throws \Throwable
     */
    public function addMedia(Advert $item, ?array $files = [], bool $isCreate = false): void
    {
        if (empty($files)) {
            return;
        }

        $sortOrderMax = $item->photos()->max('sort_order');

        DB::transaction(function () use ($files, $item, $isCreate, $sortOrderMax) {
            foreach ($files as $key => $file) {
                $ext = $file->extension();
                $name = Str::random().'.'.$ext;

                $uploadedFile = $file->storeAs($item->mediaPath(), $name, 'public');

                $item->photos()->create([
                    'is_main' => $isCreate && $key === 0,
                    'title' => $file->getClientOriginalName(),
                    'file' => $name,
                    'sort_order' => $sortOrderMax + 1,
                ]);
            }

            $item->update();
        });
    }

    public function removeMedia(Advert $item, Photo $itemMedia): bool
    {
        $path = $itemMedia->mediaPath();

        $wasMain = $itemMedia->is_main;

        $item->photos()->find($itemMedia->id)->delete();

        if ($wasMain) {
            $item->photos()->first()->update([
                'is_main' => true,
            ]);
        }

        if (Storage::disk('public')->has($path)) {
            @Storage::disk('public')->delete($path);
        }

        return true;
    }

    public function mainMedia(Advert $item, Photo $itemMedia): bool
    {
        DB::transaction(function () use ($item, $itemMedia) {
            Photo::where('advert_id', '=', $item->id)->update(['is_main' => 0]);

            $itemMedia->update([
                'is_main' => 1,
            ]);
        });

        return true;
    }

    public function sortUp(Advert $item, Photo $itemMedia): bool
    {
        $willOrder = $itemMedia->sort_order - 1 > 1 ? $itemMedia->sort_order - 1 : 1;
        $this->sort($item, $itemMedia, $willOrder);

        return true;
    }

    public function sort(Advert $item, Photo $itemMedia, int $willOrder): bool
    {
        DB::transaction(function () use ($item, $itemMedia, $willOrder) {
            $order = $itemMedia->sort_order;

            Photo::where('advert_id', '=', $item->id)
                ->where('sort_order', '=', $willOrder)
                ->update(['sort_order' => $order]);

            $itemMedia->update([
                'sort_order' => $willOrder,
            ]);
        });

        return true;
    }

    public function sortDown(Advert $item, Photo $itemMedia): bool
    {
        $willOrder = $itemMedia->sort_order + 1 > 1 ? $itemMedia->sort_order + 1 : 1;
        $this->sort($item, $itemMedia, $willOrder);

        return true;
    }
}
