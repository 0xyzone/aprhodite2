<div class="w-full">
    <div wire:ignore class="w-full">
        <select class="w-full" id="productLists" name="products[]" wire:model="form.products" wire:change="$emit('product_item',$event.target.value)" multiple>
            <option value=""></option>
            @foreach ($values as $item)
                <option value="{{ $item->name }}">
                    <span>{{ $item->name }}</span></option>
            @endforeach
        </select>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            window.initSelectDrop = () => {
                $('#productLists').select2({
                    placeholder: 'Select Items',
                    // theme: "classic",
                    closeOnSelect: false,
                    allowClear: true,
                    hidden: true
                });
            }
            initSelectDrop();

            // $('#productLists').select2({
            //     placeholder: 'Inside/Outside Valley?',
            //     // theme: "classic",
            //     closeOnSelect: false,
            //     allowClear: true,
            //     hidden: true
            // });
            $('#productLists').on('change', function(e) {
                livewire.emit('product_item', e.target.value);
                // var data = $('#productLists').select2("val");
                // console.log(data);
                @this.set('vals', data);
            });

            window.livewire.on('select2',()=>{
                initSelectDrop();
            });
        });
    </script>
@endpush
