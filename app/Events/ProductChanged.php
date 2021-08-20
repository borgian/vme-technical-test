<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;


class ProductChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $to_name = "Ian";
        $to_email = "ianbborg@gmail.com";

        $product_body = "";


        //Iterate the product changes and collect the details
        $changes = 0;
        foreach($product->getChanges() as $key=>$change)
        {
            if($key =="image_url"){continue;}
            $product_body.="<b>$key</b>: $change<br>";
            $changes++;

        }

        //If there were no changes stop here
        if($changes <=0){return;}



        $type = "updated";


        //Send Email

        $data = array('type'=>$type,"name"=>$to_name,"product_id"=>$product->id,"body"=>$product_body);
        //Send Email

        $data['subject'] = "VME product ".$type;
        $data['template_name'] = "emails.mail";


        custom_mail_helper($data);

       /* Mail::send('emails.mail',$data,function($message) use ($to_name,$to_email,$type)
        {

            $message->to($to_email,$to_name)->subject("VME product ".$type);
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
