<?php

namespace App\Jobs;

use Throwable;
use App\Models\Product;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ProductCsvProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $data;
    public $header;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $product) {
            $productData = array_combine($this->header, $product);
            $productData['date_added'] = human_date_to_unix_timestamp($productData['date_added']);
            $productData['is_import']=1; //to distinguish between automated imports and manual creation
            Product::create($productData);
         }

    }



    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }

}
