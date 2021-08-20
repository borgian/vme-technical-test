<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public $name;
    public $barcode;
    public $brand;
    public $price;
    public $image;
    public $product_id;
    public $image_url;
    public $updateMode = false;
    public $product;
    public $isUploaded = true;

    use WithFileUploads;


    /*
     * Reset all fields
     *
     * */
    private function resetInputFields(){
        $this->name = '';
        $this->$barcode = '';
        $this->$brand = '';
        $this->$price = '';
        $this->image = null;
        $this->$image_url = '';
    }

    /*
     *
     * Capture a form submit for a new product
     *
     */
    public function submit()
    {

        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'barcode' => 'required',
            'brand' => '',
            'price' => 'required|numeric',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048' //slight problem here  - image selection is required for Form to be submitted //sometimes|required
        ]);



        if($this->image!= null && $this->isUploaded){

            $path = $this->image->store("image-uploads",'public');
            $validatedData['image_url'] = Storage::url($path);
            $validatedData['image'] = null;
        }

        //Set default fields
       $validatedData['date_added'] = time();


       //Setting local supplier for non-branded items
       if($validatedData['brand'] == null || strlen($validatedData['brand']) <=0)
       {
           $validatedData['brand'] = "Local Supplier";
       }

        Product::create($validatedData);

        session()->flash('message', 'Product successfully saved.');

        return redirect()->to('/');

    }

    /*
     *
     * Is this considered best practise?
     *
     * Mount is used when an id is passed - On Product Edit
     *
     * */
    public function mount($id = NULL)
    {


        if($id)
        {
            $this->updateMode = true;

            $this->product_id = $id;
            $product = Product::where('id',$id)->first();
            $this->name = $product->name;
            $this->barcode = $product->barcode;
            $this->brand = $product->brand;
            $this->price = $product->price;
            $this->image_url = $product->image_url;
            $this->image = $product->image_url;
            $this->isUploaded = false;

        }
    }




    /*
     *
     * On Edit Form Submission
     *
     * */
    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'brand' => '',
            'price' => 'required|numeric',
            //'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048' //slight problem here  - image selection is required for Form to be submitted //sometimes|required
        ]);

        if ($this->product_id) {

            //or use // request()->hasFile('image')
            if($this->image!= null && $this->isUploaded){

                $path = $this->image->store("image-uploads",'public');
                $validatedData['image_url'] = Storage::url($path);
                $this->image_url =   $validatedData['image_url'];
            }

            if($validatedData['brand'] == null || strlen($validatedData['brand']) <=0)
            {
                $validatedData['brand'] = "Local Supplier";
            }



            $product  = Product::find($this->product_id);
            $product->update([
                'name' => $this->name,
                'brand' => $this->brand,
                'price' => $this->price,
                'image_url' => $this->image_url,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Product Updated Successfully.');
            return redirect()->to('/');

        }
    }


    /*
     * Photo has been replaced on edit form
     *
     * -- hook with updated#VARNAME
     *
     * */

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $this->isUploaded = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }



    public function render()
    {
        return view('livewire.product-form');
    }
}
