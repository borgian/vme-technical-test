<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings;


/*
 * Human date to unix timestamp
 *
 * */

if(!function_exists('human_date_to_unix_timestamp')){

    function human_date_to_unix_timestamp($date)
    {
        //23/02/2021 17:50:02
        $dtime = DateTime::createFromFormat("d/m/Y G:i:s", $date);
        $timestamp = $dtime->getTimestamp();
        return $timestamp;
    }



}


/*
 *
 * A centralized custom email sender.
 *
 */
if(!function_exists('custom_mail_helper')){

    function custom_mail_helper($data,$file=null)
    {

       // $data= array();



        $v = Settings::where('name','staff_email_address')->firstOrFail();
        $data['to_email'] = $v->value;


        Mail::send($data['template_name'], $data, function($message)use($data, $file) {

            $message->to($data["to_email"], $data["to_email"])
                ->subject($data["subject"]);

            if(isset($file)){
            $message->attach($file);
            }
            $message->from('vme.test.49358352@gmail.com','VME');


        });

    }



}