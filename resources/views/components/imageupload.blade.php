{{-- Image --}}
<div class="mt-4">
    <div class="rounded-lg mt-2 object-cover flex flex-col gap-2 w-max" alt="image">
        <div class="preview relative" id="preview">
            <img id="preview-selected-image" class="rounded-lg w-32 h-32 object-cover" />
            <x-fas-xmark
                class="absolute top-2 right-2 w-5 h-5 shadow-lg fill-red-600 p-0.5 rounded-full bg-white"
                id="removePreview" />
        </div>
        <div id="UploadImg"
                class="flex flex-col gap-2 w-32 justify-center items-center border border-dashed p-5 rounded-lg aspect-square">
                <svg id="svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="white" class="w-16 h-16">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <p class="text-white" id="image_label">{{ __('Upload') }}</p>
            </div>

        <script>
            $("#UploadImg").click(function() {
                $("#image").trigger('click');
            });
            $("#preview-selected-image").click(function() {
                $("#image").trigger('click');
            })
        </script>
    </div>
</div>
<div>
    <x-text-input id="image" name="image" type="file" class="mt-1 w-full" autofocus
        autocomplete="image" onchange="previewImage(event);" hidden />
    <script>
        $("#preview").hide()

        $("#removePreview").click(function() {
            $("#image").val('');
            $("#preview").hide();
            $('#UploadImg').show();
            $("#image_label").show();
        });
        /**
         * Create an arrow function that will be called when an image is selected.
         */
        const previewImage = (event) => {
            /**
             * Get the selected files.
             */
            const imageFiles = event.target.files;
            /**
             * Count the number of files selected.
             */
            const imageFilesLength = imageFiles.length;
            /**
             * If at least one image is selected, then proceed to display the preview.
             */
            if (imageFilesLength > 0) {
                /**
                 * Get the image path.
                 */
                const imageSrc = URL.createObjectURL(imageFiles[0]);
                /**
                 * Select the image preview element.
                 */
                const imagePreviewElement = document.querySelector("#preview-selected-image");
                /**
                 * Assign the path to the image preview element.
                 */
                imagePreviewElement.src = imageSrc;
                /**
                 * Show the element by changing the display value to "block".
                 */
                $("#preview").show();
                $('#UploadImg').hide();
                $('#image_label').hide();

            }
        };
    </script>
    <x-input-error class="mt-2" :messages="$errors->get('image')" />
</div>