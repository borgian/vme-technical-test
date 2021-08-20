@extends('layouts.base')
@section('body')
@include('vme_layouts.menu')
<div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

    @include('vme_layouts.messages')
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
</div>
@endsection


