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
                wire:submit.prevent="submit" id="order">
                @csrf
                <input type="hidden" name="user_id" wire:model.lazy="form.user_id">
                <input type="hidden" name="delivery_status" wire:model.lazy="form.delivery_status" class="text-black">
                <input type="hidden" name="order_status" wire:model.lazy="form.order_status">
                <div class="space-y-2">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="fullName" class="block w-full" type="text" name="fullName"
                            :value="old('fullName')" placeholder="{{ __('Type customer name here...') }}" autofocus="true"
                            wire:model.lazy="form.name" />
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
                            wire:model.lazy="form.address" />
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
                            wire:model.lazy="form.email" />
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
                            wire:model.lazy="form.phone" />
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
                            wire:model.lazy="form.alt-phone" />
                    </x-input-with-icon-wrapper>
                    <x-input-error class="mt-2" :messages="$errors->get('form.alt-phone')" />
                </div>


                <div>
                    <livewire:select2-dropdown />
                    <x-input-error class="mt-2" :messages="$errors->get('form.location')" />
                </div>

            </form>

            <div class="space-y-2 mt-4">
                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-search aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="search_items" class="block w-full" type="text" name="search_items"
                        :value="old('search_items')" placeholder="{{ __('Search items...') }}" autofocus="true"
                        wire:model.debounce.350ms="search_items" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('search_items')" />
                @if ($search_items)
                    <p class="py-4 text-sm">Searching for <span class="text-lime-600">{{ $search_items }}</span></p>
                    <div class="flex gap-2 flex-wrap">
                        @forelse ($products as $var)
                            @if ($cart->where('id', $var->id)->count())
                                {{-- @continue --}}
                                <div
                                    class="p-4 bg-gray-300 dark:bg-gray-600 dark:text-white rounded-lg w-full lg:w-3/12 flex justify-between items-center shrink-0">
                                    <span>{{ $var->name }}</span>
                                    <span class="text-xs text-gray-400">Added!</span>
                                </div>
                            @else
                                <div
                                    class="p-4 bg-lime-600 text-white rounded-lg w-full lg:w-3/12 flex justify-between items-center shrink-0">
                                    <span>{{ $var->name }}</span>
                                    <button wire:click="addNewItem({{ $var->id }})">
                                        <x-fas-plus-circle class="w-6" />
                                    </button>
                                </div>
                            @endif
                        @empty
                            <span class="text-gray-500">No products found!</span>
                        @endforelse
                    </div>
                @endif
            </div>

            <div class="mt-4 bg-gray-300 dark:bg-gray-600/20 rounded-lg p-2 w-full">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-sm">
                            <th class="w-1/12">
                                #
                            </th>
                            <th class="pl-2 text-left">
                                Item
                            </th>
                            <th class="w-2/12 text-center">
                                Qty.
                            </th>
                            <th class="w-2/12 text-left">
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $var)
                            <tr class="text-xs lg:text-lg">
                                <td class="text-center w-1/12 py-4">{{ $loop->iteration }}</td>
                                <td class="pl-2">{{ $var->name }}</td>
                                <td class="text-center flex gap-2 items-center justify-center py-4">
                                    <button wire:click="decreament('{{ $var->rowId }}')">
                                        <x-heroicon-m-minus-circle class="w-5" />
                                    </button>
                                    <input type="number" name="quantity" id="qty"
                                        wire:model="quantity.{{ $var->id }}" disabled
                                        class="bg-transparent w-10 text-center rounded-lg">
                                    <button wire:click="increament('{{ $var->rowId }}')">
                                        <x-heroicon-m-plus-circle class="w-5" />
                                    </button>
                                </td>
                                <td>{{ $var->price * $quantity[$var->id] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">SubTotal</td>
                            <td class="pt-2">{{ $subtotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">Discount</td>
                            <td class="pt-2"><input type="number" name="discount" id="discount"
                                    wire:model="discount" class="bg-transparent rounded-lg"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">Delivery</td>
                            <td class="pt-2">{{ $deliveryRate }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">Total</td>
                            <td class="pt-2">{{ $total }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">Advance</td>
                            <td class="pt-2"><input type="number" name="adv" id="adv" wire:model="adv"
                                    class="bg-transparent rounded-lg"></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pr-4 pt-2 font-bold">Grand Total</td>
                            <td class="pt-2">{{ $grandTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-2 float-right">
                <x-button class="justify-center gap-2 w-max" type="submit" form="order">
                    <x-heroicon-o-plus-circle class="w-6 h-6" aria-hidden="true" />
                    <span>{{ __('Create') }}</span>
                </x-button>
            </div>
            <div class="mt-2">
                {{ $orderCreated }}
            </div>
        </div>
    @endif
</div>
