<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\Exports\DatatableExport;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use File;
use Mockery\CountValidator\Exception;
use DateTime;


class ProductDatatables extends LivewireDatatable
{
    public $model = Product::class;
    public $product;
    protected $listeners = ['sendFilteredEmail' => 'send_filtered_by_email'];

   /* public function render()
    {
        return view('livewire.product-datatables');
    }*/

    /*
     *
     * Column customization for the Products Datatable
     *
     * */
    function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortBy('id')->linkTo('edit_product'),
            Column::name('name')->label('Name'),
            Column::name('barcode')->label('Barcode'),
            Column::callback('brand',function($brand){

                return $brand;

               /* if($brand == NULL){return 'Local Supplier';}
                else
                {
                    return $brand;

                }*/

            })->label('Brand')->filterable(),
            NumberColumn::name('price')->label('Price')->filterable(),
            Column::callback('image_url',function($image_url)
            {

                return "<img class='object-contain h-32 w-32' src='".$image_url."' />";

            })->exportCallback(function($image_url){

                    return $image_url;

                })->label('Image'),

            //DateColumn::name('date_added')->label('Date Added')->format('d/m/Y G:i:s T'),
            Column::callback('date_added',function($date_added){
                //In order to use .env timestamp

                return date('d/m/Y H:i:s',$date_added);


            })->label("Date Added"),

            Column::callback('id', function ($id) {
                return view('livewire/table-actions', ['id' => $id]);
            })->excludeFromExport()

        ];
    }

    public function delete_product($id)
    {


        if($id)
        {

            $record = Product::where('id',$id);
            $record->delete();
            session()->flash('message','Order deleted successfully!');

            //if image is stored on local - also delete image

        }

    }

    public function edit($id)
    {

        if($id)
        {

            $record = Product::find($id);
            $this->product = $record;
            $this->emit('edit_product', $record->id);

        }

    }

    public function send_filtered_by_email()
    {


        //Copied directly from  MedicOneSystems/livewire-datatables/blob/master/src/Http/Livewire/LivewireDatatable.php

        $this->forgetComputed();

        $results = $this->mapCallbacks($this->getQuery()->get(), true)->map(function ($item) {
            return collect($this->columns)->reject(function ($value, $key) {
                return $value['preventExport'] == true || $value['hidden'] == true;
            })->mapWithKeys(function ($value, $key) use ($item) {
                    return [$value['label'] ?? $value['name'] => $item->{$value['name']}];
                })->all();
        });




        //Store the filtered list in public folder

        try{

        $file_name = "public/".time().Str::random(10)."DatatableExport.xlsx";
        Excel::store(new DatatableExport($results),$file_name );


        //Send the email with the attachement


        $data = array();
        $data['subject'] = "VME Filtered Product List";
        $data['template_name'] = "emails.filtered_list";
        $file = storage_path('app/'.$file_name);
        custom_mail_helper($data,$file);
        }
        catch(Exception $e){

        }
        finally {
        //unlink file
        File::delete(storage_path('app/'.$file_name));
        }


    }
}
