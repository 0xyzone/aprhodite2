<div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <form action="{{ route('orders.store') }}" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->name }}">

        <div class="space-y-2">
            {{-- <x-label for="fullName" :value="__('Customer Name')" /> --}}
            <x-input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-fas-user aria-hidden="true" class="w-5 h-5" />
                </x-slot>
                <x-input withicon id="fullName" class="block w-full" type="text" name="fullName" :value="old('fullName')"
                    placeholder="{{ __('Type customer name here...') }}" autofocus="true" />
            </x-input-with-icon-wrapper>
            <x-input-error class="mt-2" :messages="$errors->get('fullName')" />
        </div>

        <div class="space-y-2">
            {{-- <x-label for="address" :value="__('Customer Address')" /> --}}
            <x-input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-fas-location-dot aria-hidden="true" class="w-5 h-5" />
                </x-slot>
                <x-input withicon id="address" class="block w-full" type="text" name="address" :value="old('address')"
                    placeholder="{{ __('Type customer address here...') }}" autofocus="true" />
            </x-input-with-icon-wrapper>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="space-y-2">
            {{-- <x-label for="email" :value="__('Customer Email')" /> --}}
            <x-input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-eos-email aria-hidden="true" class="w-5 h-5" />
                </x-slot>
                <x-input withicon id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    placeholder="{{ __('Type customer email here...') }}" autofocus="true" />
            </x-input-with-icon-wrapper>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        {{-- <x-label for="phone" :value="__('Customer Phone')" /> --}}

        <div class="space-y-2">
            <x-input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                </x-slot>
                <x-input withicon id="phone" class="block w-full" type="number" name="phone" :value="old('phone')"
                    placeholder="{{ __('Main phone number') }}" autofocus="true" />
            </x-input-with-icon-wrapper>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="space-y-2">
            <x-input-with-icon-wrapper>
                <x-slot name="icon">
                    <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                </x-slot>
                <x-input withicon id="alt-phone" class="block w-full" type="number" name="alt-phone" :value="old('alt-phone')"
                    placeholder="{{ __('Alternative phone number') }}" autofocus="true" />
            </x-input-with-icon-wrapper>
            <x-input-error class="mt-2" :messages="$errors->get('alt-phone')" />
        </div>

        <div class="">
            {{-- <x-input withicon id="alt-phone" class="block w-full" type="select" name="alt-phone" :value="old('alt-phone')"
                    placeholder="{{ __('Alternative phone number') }}" autofocus="true" /> --}}
            <select name="location" id="location" class="w-full !h-full dark:!text-white">
                <option value=""></option>
                <option value="inside">Inside Valley</option>
                <option value="outside">Outside Valley</option>
            </select>
            <script>
                $(document).ready(function() {
                    $('#location').select2({
                        placeholder: 'Inside/Outside Valley?',
                        // theme: "classic",
                        closeOnSelect: false,
                        allowClear: true,
                        hidden: true
                    });
                });
            </script>
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>


    </form>
</div>
