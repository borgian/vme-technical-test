<!DOCTYPE html>
<html>
<head>
    <title>VME Technical test</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
</head>
<body>

@extends('layouts.app')

@section('content')

    @include('vme_layouts.menu')

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

    @include('vme_layouts.messages')


    <!-- new products btn ++ import modal  -->
    <div x-data="{ show: false }">
        <div class="flex">
            <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" href="{{url('/productcrud');}}">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                &nbsp;
                <span>New Product</span></a>
            <button @click={show=true} type="button" class="inline-flex items-center h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-green-400 rounded-lg focus:shadow-outline hover:bg-green-800">Import Products</Button>
        </div>
        <div x-show="show" tabindex="0" class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
            <div  @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
            <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                <button @click={show=false} class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                <div class="px-6 py-3 text-xl border-b font-bold">Import Products(.csv)</div>
                <div class="p-6 flex-grow">
                   <form action="upload" method="POST" enctype="multipart/form-data">
                       @csrf
                       <input type="file" name="import_csv" accept=".csv"/>

                       <div class="flex mt-5">
                        <button type="submit" class="bg-blue-600 text-gray-200 rounded px-4 py-2">Import</Button>

                       </div>

                   </form>
                </div>
                <div class="px-6 py-3 border-t">
                    <div class="flex justify-end">
                        <button @click={show=false} type="button" class="bg-gray-700 text-gray-100 rounded px-4 py-2 mr-1">Close</Button>

                    </div>
                </div>
            </div>
        </div>
        <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
    </div>

    <!-- END new products btn ++ import modal-->


    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">

        <livewire:product-datatables exportable searchable="name,barcode,brand,price,date_added"/>

    </div>


</div>

@endsection


</body>
</html>
