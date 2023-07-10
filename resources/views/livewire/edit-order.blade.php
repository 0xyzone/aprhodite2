<div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="lg:flex gap-4 w-full">
            <div class="lg:w-8/12">
                <div class="space-y-2 mb-4">
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-fas-search aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="search_items" class="block w-full" type="text" name="search_items"
                            :value="old('search_items')" placeholder="{{ __('Search items...') }}" autocomplete="off"
                            wire:model.debounce.350ms="search_items" autofocus />
                    </x-input-with-icon-wrapper>
                    @if ($search_items)
                        <p class="pt-4 text-sm">Searching for <span class="text-lime-600">{{ $search_items }}</span>
                        </p>
                        <div class="flex gap-2 flex-wrap">
                            @forelse ($products as $var)
                                {{-- @if ($cart->where('id', $var->id)->count())
                                    <div
                                        class="mt-2 p-4 bg-gray-300 dark:bg-gray-600 dark:text-white rounded-lg w-full lg:w-4/12 flex justify-between items-center shrink-0">
                                        <span class="shrink-0">{{ $var->name }}</span>
                                        <span class="text-xs text-gray-400">Added!</span>
                                    </div>
                                @else --}}
                                    <div
                                        class="mt-2 p-4 bg-lime-600 text-white rounded-lg w-full lg:w-4/12 flex justify-between items-center shrink-0">
                                        <span>{{ $var->name }}</span>
                                        <button wire:click="addNewItem({{ $var->id }})">
                                            <x-fas-plus-circle class="w-6" />
                                        </button>
                                    </div>
                                {{-- @endif --}}
                            @empty
                                <span class="text-gray-500">No customers found!</span>
                            @endforelse
                        </div>
                    @endif
                </div>
                <form wire:submit.prevent="updateOrder" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-4"
                    id="order">
                    @csrf
                    <div class="space-y-2">
                        <x-input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-fas-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
                            <x-input withicon id="fullName" class="block w-full" type="text" placeholder="{{ __('Type customer name here...') }}"
                                wire:model.lazy="form.name" />
                        </x-input-with-icon-wrapper>
                        <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-fas-location-dot aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
                            <x-input withicon id="address" class="block w-full" type="text" placeholder="{{ __('Type customer address here...') }}" wire:model.lazy="form.address" />
                        </x-input-with-icon-wrapper>
                        <x-input-error class="mt-2" :messages="$errors->get('form.address')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-fas-envelope aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
                            <x-input withicon id="email" class="block w-full" type="email" placeholder="{{ __('Type customer email here...') }}" wire:model.lazy="form.email" />
                        </x-input-with-icon-wrapper>
                        <x-input-error class="mt-2" :messages="$errors->get('form.email')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
                            <x-input withicon id="phone" class="block w-full" type="number" placeholder="{{ __('Main phone number') }}" wire:model.lazy="form.phone" />
                        </x-input-with-icon-wrapper>
                        <x-input-error class="mt-2" :messages="$errors->get('form.phone')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-fas-phone aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
                            <x-input withicon id="alt-phone" class="block w-full" type="number" placeholder="{{ __('Alternative phone number') }}" wire:model.lazy="form.alt-phone" />
                        </x-input-with-icon-wrapper>
                        <x-input-error class="mt-2" :messages="$errors->get('form.alt-phone')" />
                    </div>
                    <div>
                        <select name="location" id="location"
                            class="text-gray-600 bg-gray-100 dark:text-gray-800 rounded-lg" wire:model="location">
                            <option value="inside">Inside Valley</option>
                            <option value="outside">Outside Valley</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>
                </form>
            </div>

            <div class="lg:w-4/12">
                    <div class="pt-6 mt-4 lg:mt-0 bg-gray-300 dark:bg-gray-600/20 rounded-lg p-2 w-full max-w-md">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="text-sm">
                                    <th class="w-1/12">
                                        #
                                    </th>
                                    <th class="pl-2 text-left">
                                        Item
                                    </th>
                                    <th class="w-2/12 text-left pl-3">
                                        Price
                                    </th>
                                    <th class="w-2/12 text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $var)
                                    <tr class="text-xs 3xl:text-lg">
                                        <td class="text-center w-1/12 py-4">{{ $loop->iteration }}</td>
                                        <td class="pl-2">
                                            {{ $var->product->name }} (x{{ $var->quantity }})
                                        </td>
                                        <td>
                                            <div class="inline-flex gap-2 items-center pl-2">
                                                <span>{{ $var->price * $var->quantity }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center flex gap-1 items-center justify-center py-4">

                                            <input type="hidden" name="quantity" id="qty"
                                                wire:model.debounce.500ms="quantity.{{ $var->id }}" disabled
                                                class="bg-transparent max-w-16 w-10 text-center rounded-full p-1 ">
                                            <button wire:click="decreament('{{ $var->rowId }}')">
                                                <x-heroicon-m-minus-circle class="w-4" />
                                            </button>
                                            <button wire:click="increament('{{ $var->rowId }}')">
                                                <x-heroicon-m-plus-circle class="w-4" />
                                            </button>
                                            <button wire:click="removeItem('{{ $var->rowId }}')"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <x-fas-circle-xmark class="w-4 text-red-500" />
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="mx-2 text-xs">
                                <tr class="border-t-2 border-dashed border-gray-400 dark:border-gray-500">
                                    <td colspan="3" class="text-right pr-4 pt-2 font-bold">SubTotal</td>
                                    <td class="pt-2 pl-3">{{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right pr-4 pt-2 font-bold">Discount</td>
                                    <td class="pt-2"><input type="number" name="discount" id="discount"
                                            wire:model.lazy="discount"
                                            class="bg-transparent rounded-lg w-20 p-1 px-1 pl-3 text-xs">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right pr-4 pt-2 font-bold">Delivery</td>
                                    <td class="pt-2 pl-3">{{ $deliveryRate }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right pr-4 pt-2 font-bold">Total</td>
                                    <td class="pt-2 pl-3">{{ $total }}</td>
                                </tr>
                                @if ($gateway != '')
                                    <tr>
                                        <td colspan="3" class="text-right pr-4 pt-2 font-bold">Advance</td>
                                        <td class="pt-2"><input type="number" name="adv" id="adv"
                                                wire:model.lazy="adv"
                                                class="bg-transparent rounded-lg w-20 p-1 px-1 pl-3 text-xs">
                                        </td>
                                    </tr>
                                @endif
                                <tr class="pb-6">
                                    <td colspan="3" class="text-right pr-4 pt-2 font-bold">Grand Total</td>
                                    <td class="pt-2 pl-3">{{ $grandTotal }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <textarea name="note" id="note" wire:model.lazy="note"
                        class="bg-gray-300 dark:bg-gray-600 rounded-lg resize-none mt-2 w-full border-none ring-0 dark:placeholder:text-gray-400"
                        placeholder="Type something...">{{ $note }}</textarea>

                    <div class="mt-2 flex flex-col gap-4 lg:flex-row">
                        <select name="gateway" id="gateway"
                            class="text-gray-600 bg-gray-100 dark:text-gray-800 rounded-lg" wire:model="gateway">
                            <option value="">Choose gateway</option>
                            <option value="cash">Cash</option>
                            <option value="eSewa">eSewa</option>
                            <option value="Khalti">Khalti</option>
                            <option value="IME Pay">IME Pay</option>
                            <option value="Bank">Bank</option>
                        </select>
                        <div class="flex gap-2">
                            <x-button class="justify-center gap-2 w-max" type="submit" form="order">
                                <x-fas-circle-up class="w-6 h-6" aria-hidden="true" />
                                <span>{{ __('Update') }}</span>
                            </x-button>
                            <div class="px-4 py-2 rounded-lg border border-lime-600 capitalize w-max">
                                <p>{{ $payment_status }}</p>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
