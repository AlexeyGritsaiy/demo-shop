<?php

namespace App\Models;

use App\Entity\Adverts\Advert\Advert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property string $phone
 * @property Carbon $created_at
 *
 * @property Advert[] $products
 */
class Order extends Model
{
    public const STATUS_WAIT = '0';

    // protected $fillable = ['user_id'];
    public const STATUS_ACTIVE = '1';
    protected $table = 'advert_order';
    protected $fillable = [
        'name', 'phone', 'status',
    ];

    protected $with = [
        'products',
    ];

    public static function eraseOrderSum()
    {
        session()->forget('full_order_sum');
    }

    public static function new($name, $phone): self
    {
        return static::create([
            'name' => $name,
            'phone' => $phone,
            //   'status' => $status,
            //            'password' => bcrypt(Str::random()),
            //            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class, 'advert_order_product')
            ->withPivot('count')
            ->withTimestamps();
    }

    public function productsMany()
    {
        return $this->hasMany(Advert::class, 'id', 'order_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullSum()
    {
        $sum = 0;

        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }

        return $sum;
    }

    public function saveOrder($name, $phone)
    {
        if ($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }

    public function adverts()
    {
        return $this->belongsToMany(Advert::class, 'advert_cart_product');
    }

    public function addProduct(Advert $advert)
    {
        if ($this->order->products->contains($advert->id)) {
            $pivotRow = $this->getPivotRow($advert);

            $pivotRow->count++;

            $pivotRow->update();
        } else {
            $this->order->products()->attach($advert->id);
        }

        Order::changeFullSum($advert->price);

        return true;
    }

    public static function changeFullSum($changeSum)
    {
        $sum = self::getFullSum() + $changeSum;
        session(['full_order_sum' => $sum]);
    }

    public static function getFullSum()
    {
        return session('full_order_sum', 0);
    }
}


