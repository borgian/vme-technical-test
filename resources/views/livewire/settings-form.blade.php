<div class="w-screen">
<div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Update Settings</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Change settings.
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
                                    Staff Email Address*
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input type="text" placeholder="Enter email" wire:model="email" id="InputEmail" class="block focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 focus:shadow-outline @error('name') border-red-500 @enderror" aria-describedby="nameHelp" >

                                    @error('email')<span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1" id="nameHelp">{{ $message }}</span>@enderror

                                </div>
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
    </div>