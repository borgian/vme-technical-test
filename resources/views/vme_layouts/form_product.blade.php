<!DOCTYPE html>
<html>
<head>
    <title>VME Technical test</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">


    @livewire('product-form')




</div>
@endsection



</body>
</html>
