<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Product') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('product.update', $product) }}" class="max-w-sm" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-2">
                <x-label for="name" :value="__('Product Name')" />

                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-boxes-packing aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="name" class="block w-full" type="text" name="name"
                        :value="old('name', $product->name)" placeholder="{{ __('Type product name here...') }}" autofocus="true" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4 space-y-2">
                <x-label for="price" :value="__('Product Price')" />

                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-rupee-sign aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="price" class="block w-full" type="number" name="price"
                        :value="old('price', $product->price)" placeholder="{{ __('Type product price here...') }}" autofocus="true" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>

            <x-imageuploadwithvar :variable=$product />

            <div class="mt-4 space-y-2">
                <x-label for="description" :value="__('Product Description')" />
                <textarea id="description"
                    class="block w-full border-lime-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm focus:ring-0 resize-none overflow-hidden"
                    type="number" name="description" placeholder="Type product description here..." autofocus="true">{{ old('description', $product->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                <script>
                    var textarea = document.getElementById("description");

                    textarea.oninput = function() {
                        textarea.style.height = "";
                        /* textarea.style.height = Math.min(textarea.scrollHeight, 300) + "px"; */
                        textarea.style.height = textarea.scrollHeight + "px"
                    };
                </script>
            </div>

            <div class="mt-4">
                <x-button class="justify-center gap-2 w-max" type="submit">
                    <x-fas-circle-arrow-up class="w-6 h-6" aria-hidden="true" />
                    <span>{{ __('Update') }}</span>
                </x-button>
            </div>
        </form>
        @if ($product->image)
            <form action="{{ route('product.destroyImage', $product) }}" method="post" id="removeImage">
                @csrf
                @method('delete')
                <button form="removeImage" type="submit"
                    onclick="return confirm('Are you sure you want to remvove this image?')"
                    class="mt-2 flex gap-2 items-center px-4 py-2 border border-current text-red-500 rounded-lg text-xs"
                    id="removeImageButton">
                    <x-fas-trash class="w-3 h-3 drop-shadow-lg fill-red-600" /><span>Remove Image</span>
                </button>
                <script>
                    // $('#removeImageButton').click(function(){
                    //     $(this).closest("form").submit();
                    // });
                </script>
            </form>
        @endif
    </div>
</x-app-layout>
