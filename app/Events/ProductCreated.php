<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class ProductCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {

        if($product->is_import == 1){return;}
        $to_name = "Ian";

        //The new product's details

        $product_body = "";
        $product_body.="<b>ID: </b>".$product->id;
        $product_body.="<br/>";
        $product_body.="<b>Name: </b>".$product->name;
        $product_body.="<br/>";
        $product_body.="<b>Barcode: </b>".$product->barcode;
        $product_body.="<br/>";
        $product_body.="<b>Brand: </b>".$product->brand;
        $product_body.="<br/>";
        $product_body.="<b>Price: </b>".$product->price;


        $type = "created";

        //Send Email

        $data = array('type'=>$type,"name"=>$to_name,"product_id"=>$product->id,"body"=>$product_body);
        $data['subject'] = "VME $type new product";
        $data['template_name'] = "emails.mail";


        custom_mail_helper($data);

      /*  Mail::send('emails.mail',$data,function($message) use ($to_name,$to_email,$type)
        {

            $message->to($to_email,$to_name)->subject("VME $type new product");//issue with subject line spacing if created is placed after product
            $message->from('vme.test.49358352@gmail.com','VME');


        });*/
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
