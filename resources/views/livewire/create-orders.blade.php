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
            <form action="{{ route('orders.store') }}" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-4"
                wire:submit.prevent="submit">
                @csrf
                <input type="hidden" name="user_id" wire:model="form.user_id">
                <input type="hidden" name="delivery_status" wire:model="form.delivery_status" class="text-black">
                <input type="hidden" name="order_status" wire:model="form.order_status">
                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="fullName" class="block w-full" type="text" name="fullName"
                            :value="old('fullName')" placeholder="{{ __('Type customer name here...') }}" autofocus="true"
                            wire:model="form.name" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
                </div>

                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-location-dot aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="address" class="block w-full" type="text" name="address"
                            :value="old('address')" placeholder="{{ __('Type customer address here...') }}" autofocus="true"
                            wire:model="form.address" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.address')" />
                </div>

                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-envelope aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="email" class="block w-full" type="email" name="email"
                            :value="old('email')" placeholder="{{ __('Type customer email here...') }}" autofocus="true"
                            wire:model="form.email" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.email')" />
                </div>

                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="phone" class="block w-full" type="number" name="phone"
                            :value="old('phone')" placeholder="{{ __('Main phone number') }}" autofocus="true"
                            wire:model="form.phone" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.phone')" />
                </div>

                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="alt-phone" class="block w-full" type="number" name="alt-phone"
                            :value="old('alt-phone')" placeholder="{{ __('Alternative phone number') }}" autofocus="true"
                            wire:model="form.alt-phone" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.alt-phone')" />
                </div>

                
                <div>
                    <livewire:select2-dropdown />
                    <x-input-error class="mt-2" :messages="$errors->get('form.location')" />
                </div>

                {{-- <div>
                    <livewire:product-dropdown />
                    <x-input-error class="mt-2" :messages="$errors->get('form.location')" />
                </div> --}}

                {{-- <div>
                    <select name="products[]" id="products" class="w-full">
                        @foreach ($products as $var)
                            <option value="{{ $var->name }}">{{ $var->name }}</option>
                        @endforeach
                    </select>
                </div> --}}


                <div class="">
                    <x-button class="justify-center gap-2 w-max" type="submit">
                        <x-heroicon-o-plus-circle class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Create') }}</span>
                    </x-button>
                </div>

            </form>
            <div class="mt-2">
                {{ $orderCreated }}
            </div>
        </div>
    @endif
</div>
