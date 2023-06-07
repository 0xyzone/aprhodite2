<div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-6">
        @if ($customer == 'existing') 
            <x-primary-button wire:click="newCustomer">New Customer</x-primary-button>
        @endif
        @if ($customer == 'new') 
            <x-primary-button type="none" wire:click="existingCustomer">Existing Customer</x-primary-button>
        @endif
    </div>

    @if ($customer == 'new') 
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <form action="{{ route('orders.store') }}" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-4" wire:submit.prevent="submit">
    
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->name }}">
    
                <div class="space-y-2">
                    {{-- <x-label for="fullName" :value="__('Customer Name')" /> --}}
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="fullName" class="block w-full" type="text" name="fullName"
                            :value="old('fullName')" placeholder="{{ __('Type customer name here...') }}" autofocus="true" wire:model="form.name" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
                </div>
    
                <div class="space-y-2">
                    {{-- <x-label for="address" :value="__('Customer Address')" /> --}}
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-location-dot aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="address" class="block w-full" type="text" name="address"
                            :value="old('address')" placeholder="{{ __('Type customer address here...') }}" autofocus="true" wire:model="form.address" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.address')" />
                </div>
    
                <div class="space-y-2">
                    {{-- <x-label for="email" :value="__('Customer Email')" /> --}}
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-eos-email aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="email" class="block w-full" type="email" name="email"
                            :value="old('email')" placeholder="{{ __('Type customer email here...') }}" autofocus="true" wire:model="form.email" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.email')" />
                </div>
                {{-- <x-label for="phone" :value="__('Customer Phone')" /> --}}
    
                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="phone" class="block w-full" type="number" name="phone"
                            :value="old('phone')" placeholder="{{ __('Main phone number') }}" autofocus="true" wire:model="form.phone" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.phone')" />
                </div>
    
                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="alt-phone" class="block w-full" type="number" name="alt-phone"
                            :value="old('alt-phone')" placeholder="{{ __('Alternative phone number') }}" autofocus="true" wire:phone="form.alt-phone" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.alt-phone')" />
                </div>
    
                <div class="">
                    {{-- <x-input withicon id="alt-phone" class="block w-full" type="select" name="alt-phone" :value="old('alt-phone')"
                        placeholder="{{ __('Alternative phone number') }}" autofocus="true" /> --}}
                    <select name="location" id="location" class="w-full !h-full dark:!text-white" wire:model="form.location" >
                        <option value=""></option>
                        <option value="inside" @if (old('location') == 'inside') selected @endif>Inside Valley</option>
                        <option value="outside" @if (old('location') == 'outside') selected @endif>Outside Valley</option>
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
                    <x-input-error class="mt-2" :messages="$errors->get('form.location')" />
                </div>
    
                <div class="">
                    <x-button class="justify-center gap-2 w-max" type="submit">
                        <x-heroicon-o-plus-circle class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Create') }}</span>
                    </x-button>
                </div>
            </form>
        </div>
    @endif
</div>
