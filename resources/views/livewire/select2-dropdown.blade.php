<div class="w-full">
    <div wire:ignore class="w-full">
        <select
            class="w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-lime-600 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
            id="select2-dropdown" name="location" wire:model="form.location"
            wire:change="$emit('selected_select2_item',$event.target.value)">
            <option value=""></option>
            @foreach ($values as $item)
                <option value="{{ $item }}" @if (old('location') == $item) selected @endif>
                    <span>{{ $item }}</span>
                </option>
            @endforeach
        </select>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            window.initSelectDrop = () => {
                $('#select2-dropdown').select2({
                    placeholder: 'Inside/Outside Valley?',
                    // theme: "classic",
                    closeOnSelect: false,
                    allowClear: true,
                    hidden: true
                });
            }
            initSelectDrop();

            // $('#select2-dropdown').select2({
            //     placeholder: 'Inside/Outside Valley?',
            //     // theme: "classic",
            //     closeOnSelect: false,
            //     allowClear: true,
            //     hidden: true
            // });
            $('#select2-dropdown').on('change', function(e) {
                livewire.emit('selected_select2_item', e.target.value);
                // var data = $('#select2-dropdown').select2("val");
                // console.log(data);
                @this.set('ottPlatform', data);
            });

            window.livewire.on('select2', () => {
                initSelectDrop();
            });
        });
    </script>
@endpush
