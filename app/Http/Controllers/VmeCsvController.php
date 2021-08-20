<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCsvProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;

class VmeCsvController extends Controller
{

    /*
     *
     * From CSV file to Queued Jobs
     *
     * */
   public function upload(Request $request)
   {
       //name=import_csv

      /* var_dump($request);
       exit(0);*/

       $validated = $request->validate([
           'import_csv' => 'required|mimes:csv',
       ]);


       //Check if file has been uploaded first
       if($request->hasFile('import_csv')){


              //local test file = public_path()."/uploads/"."legacy_products.csv";

               //Uploaded csv file
               $path = $request->file('import_csv')->store('temp');
               $file_name = storage_path("app/".$path);

               //no need to unlink file if laravel's garbage collector is running.


               if(true){

                   $file = file($file_name);
                   $data = array_slice($file,1);
                   $header = array("name","barcode","brand","price","image_url","date_added");


                   //Split into multiple batches

                   $batches = array_chunk($data,250);


                   //Process the batches and dispatch

                   foreach($batches as $key=>$batch){

                       $data = array_map('str_getcsv', $batch);
                       ProductCsvProcess::dispatch($data,$header);


                   }


                   session()->flash('message', 'File uploaded, Products are being imported in the background.');
                   return redirect()->to('/');

               }


       }
         session()->flash('error', 'Please select a file to import.');
           return redirect()->to('/');




   }



}
