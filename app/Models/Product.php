<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    protected $fillable = ["name","barcode","brand","price","image_url","date_added","is_import"];
    public $timestamps = FALSE;

    protected $dispatchesEvents = [

        'created' => \App\Events\ProductCreated::class,
        'updated' => \App\Events\ProductChanged::class,

    ];

    use HasFactory;


    /**
     *
     * Get the brand associated with this product
     */

   /* public function brand()
    {

        return $this->belongsTo(Brand::class);
    }*/






}
