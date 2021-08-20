<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Update Product</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Change this product's details.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="update" enctype="multipart/form-data" method = "Post">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="InputName" class="block text-sm font-medium text-gray-700">
                                    Name*
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input type="text" placeholder="Enter name" wire:model="name" id="InputName" class="block focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 focus:shadow-outline @error('name') border-red-500 @enderror" aria-describedby="nameHelp" >

                                    @error('name')<span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1" id="nameHelp">{{ $message }}</span>@enderror

                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="InputBarcode" class="block text-sm font-medium text-gray-700">
                                    Barcode*
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input disabled readonly  type="text" placeholder="Enter barcode" wire:model="barcode" id="InputBarcode" class="select-none text-gray-300 block focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" >
                                    @error('barcode') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="InputBrand" class="block text-sm font-medium text-gray-700">
                                    Brand
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input type="text" placeholder="Enter brand" wire:model="brand" id="InputBrand" class="block focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" >
                                    @error('brand') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-9 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="InputPrice" class="block text-sm font-medium text-gray-700">
                                    Price*
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input type="text" placeholder="Enter price" wire:model="price" id="InputPrice" class="block focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" >
                                    @error('price') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>



                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Image
                            </label>
                            <div class="mt-1 flex items-center">
                <span class="inline-block h-12 w-12 overflow-hidden bg-gray-100">

                       @if ($image)
                    <img src="{{ $isUploaded? $image->temporaryUrl() :  url($image)  }}" class="object-contain w-full h-full">
                    @else
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>no-image</title><path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/><path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="24" height="24"/></svg>
                @endif
                </span>
                                <input wire:model="image" type="file" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"/>

                                @error('image') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>


                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-left sm:px-6 inline-block">
                        <p class="text-xs align-text-bottom inline-block">* required</p>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 inline-block float-right">
                        <button wire:target="submit" wire:loading.attr="disabled" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>