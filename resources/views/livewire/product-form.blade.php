
<div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">

    @if($updateMode)
    @include('livewire.product-form-update')
    @else
    @include('livewire.product-form-create')
    @endif

</div>