<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class VmeController extends Controller
{



    #region VIEW FUNCTIONS


   /*
    *
    * Dashboard/View Products
    *    -Search
    *    -Sorting across all fields
    *    -Filter by price range(range slider)
    *    -Filter by brand
    *
    * */

    public function view_products(){

        return view('vme_layouts.welcome');

    }



    /*
     * Mail filter products as CSV to submitted email address or save staff email address in settings page
     *
     *
     * */

    public function mail_filtered_products(){}


    #endregion




}
