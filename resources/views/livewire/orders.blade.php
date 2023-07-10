<div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Orders') }}
            </h2>
            <a href="{{ route('orders.create') }}" class="primary-btn">Create order</a>
        </div>
        <div class="mt-4 flex flex-col gap-4 w-full" x-data="{ filter: false }">
            <div class="flex gap-2 w-full">
                <x-secondary-button x-on:click="filter = ! filter">
                    <x-fas-filter class="w-4" />
                </x-secondary-button>
            </div>
            {{-- Filters --}}
            <div class="flex gap-2 text-xs w-full flex-wrap" x-show="filter"
                x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                <div class="flex gap-2 items-center">
                    <p>Show</p>
                    <select wire:model="paginate" class="dark:bg-gray-800 rounded-lg text-xs">
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                    <p>Order Status</p>
                    <select wire:model="orderStatus" class="dark:bg-gray-800 rounded-lg text-xs">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="ncm">NCM</option>
                        <option value="delivered">Delivered</option>
                        <option value="dispatched">Dispatched</option>
                        @role('admin')
                            <option value="canceled">Canceled</option>
                        @endrole
                    </select>
                </div>
                @role('admin')
                    <div class="flex gap-2 items-center">
                        <p>User</p>
                        <select wire:model="userId" class="dark:bg-gray-800 rounded-lg text-xs">
                            <option value="">All</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endrole
            </div>
            {{-- end Filters --}}
        </div>
    </div>
    <div class="flex-col mt-4">
        <div class="overflow-x-auto sm:-mx-6 sm:px-6">
            <div class="inline-block min-w-full overflow-hidden align-middle shadow sm:rounded-t-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="!bg-slate-600">
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-200 uppercase border-b border-gray-200 w-10">
                                #</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200 hidden lg:table-cell">
                                Placed by</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200 hidden lg:table-cell">
                                Customer Name</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200 hidden lg:table-cell">
                                Customer Address</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-200 uppercase border-b border-gray-200 hidden lg:table-cell">
                                Customer Phone</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-gray-200 uppercase border-b border-gray-200 text-center">
                                Order Status</th>
                            <th class="py-3 text-xs font-bold text-gray-200 border-b border-gray-200 text-center">
                                Action</th>
                        </tr>
                    </thead>

                    <tbody x-data="{ data: null }">
                        @if ($orders->count() == 0)
                            <tr>
                                <td colspan="100%" class="!text-black dark:!text-white text-center py-4 w-full"><span>No
                                        items
                                        found!</span></td>
                            </tr>
                        @endif
                        @foreach ($orders as $var)
                            <tr class="text-xs lg:text-sm">
                                <td class="pl-2 py-4 whitespace-no-wrap relative"
                                    @click="data = data == {{ $var->id }} ? null : {{ $var->id }}">
                                    <div
                                        class="w-1 {{ $bgColor[$var->order_status] }} mr-1 h-full absolute left-0 top-0">
                                    </div>
                                    <div class="text-right">
                                        ADB#{{ $var->id }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap w-44 hidden lg:table-cell text-xs lg:text-sm"
                                    @click="data = data == {{ $var->id }} ? null : {{ $var->id }}">
                                    <div class=" leading-5">
                                        {{ $var->getUser->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap hidden lg:table-cell text-xs lg:text-sm"
                                    @click="data = data == {{ $var->id }} ? null : {{ $var->id }}">
                                    <div class=" leading-5">{{ $var->fullName }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap hidden lg:table-cell text-xs lg:text-sm"
                                    @click="data = data == {{ $var->id }} ? null : {{ $var->id }}">
                                    <div class=" leading-5" title="{{ $var->address }}">{{ $var->address }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap hidden lg:table-cell text-center text-xs lg:text-sm"
                                    @click="data = data == {{ $var->id }} ? null : {{ $var->id }}">
                                    {{-- <p class="text-sm leading-5 max-w-xs line-clamp-[3]"
                                        title="{{ $var->created_at->format('jS M, Y | H:i A') }}">
                                        {{ $var->created_at->diffForHumans() }}
                                    </p> --}}
                                    {{ $var->phone }} {{ $var['alt-phone'] ? ' | ' . $var['alt-phone'] : '' }}
                                </td>

                                <td class="px-6 py-4 leading-5 whitespace-no-wrap text-center">
                                    @can('update order')
                                        <form wire:submit.prevent="changeStatus({{ $var->id ?? '' }})">
                                            @csrf
                                            <select name="status" id="status"
                                                class="bg-gray-300 dark:bg-gray-800 rounded-lg border-0 outline-none focus:ring-0 text-xs lg:text-sm"
                                                wire:model="order_status.{{ $var->id }}">
                                                <option value="pending">Pending</option>
                                                <option value="confirmed">Confirmed</option>
                                                <option value="ncm">NCM</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="dispatched">Dispatched</option>
                                                <option value="canceled"
                                                    @hasrole('admin') @else disabled @endrole>Canceled
                                            </option>
                                        </select>
                                    </form>
                                        @if (isset($updated[$var->id]))
                                            <x-fas-check-circle class="w-4 inline" id="updated{{ $var->id }}"
                                                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 1000)"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-90" />
                                        @endif
                                    @else
                                        <div class="text-sm leading-5 capitalize">{{ $var->order_status }}
                                        </div>
                                    @endcan
                                </td>

                                <td class="text-sm font-medium text-center whitespace-no-wrap mx-auto">
                                    <div class="pr-4 grid grid-cols-3 gap-2 w-max mx-auto">

                                        @can('edit order')
                                            <a href="{{ route('orders.edit', $product = $var->id) }}">
                                                <x-heroicon-m-pencil-square
                                                    class="w-5 h-5 text-lime-500 hover:text-lime-700" />
                                            </a>
                                        @endcan
                                        @can('delete order')
                                            <form action="{{ route('orders.destroy', $var->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <x-heroicon-m-trash class="w-5 h-5 text-red-500 hover:text-red-700" />
                                                </button>
                                            </form>
                                        @endcan
                                        <x-fas-angle-down
                                            class="w-5 h-5 text-gray-500 hover:text-gray-600 transform duration-500 transition-all cursor-pointer"
                                            x-bind:class="data == {{ $var->id }} &&
                                                'rotate-180'"
                                            @click="data = data == {{ $var->id }} ? null : {{ $var->id }}" />
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-rows">
                                <td colspan="100%">
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-700 flex justify-between w-full px-4 h-full"
                                        style="" x-ref="container{{ $var->id }}"
                                        x-bind:style="data == {{ $var->id }} ? 'max-height: calc(' + $refs.container{{ $var->id }}.scrollHeight + 'rem * 4); margin-bottom: 1.1rem; margin-top: 1rem; padding-bottom: 2rem;' : ''">
                                        <div class="flex text-xs lg:text-sm gap-2 -p-8 w-full flex-wrap">
                                            <div
                                                class="grid grid-cols-2 gap-2 rounded-lg bg-gray-300/20 max-w-md w-full p-4 shrink-0 h-max shadow-2xl">
                                                <h1
                                                    class="font-bold text-lime-600 dark:text-lime-500 transform duration-700 col-span-2">
                                                    Customer Details</h1>
                                                <div class="w-full flex items-center gap-2">
                                                    <x-fas-user
                                                        class="w-2 lg:w-3 text-lime-600 dark:text-lime-500 transform duration-700" />
                                                    <span>{{ $var->fullName }}</span>
                                                </div>
                                                <div class="w-full lg:flex items-center gap-2 hidden">
                                                    <x-fas-phone
                                                        class="w-2 lg:w-3 text-lime-600 dark:text-lime-500 transform duration-700 shrink-0" />
                                                    <span>{{ $var->phone }}{{ $var['alt-phone'] ? ' | ' . $var['alt-phone'] : '' }}</span>
                                                </div>
                                                <div class="w-full flex items-center gap-2 col-span-2">
                                                    <x-fas-location-dot
                                                        class="w-2 lg:w-3 text-lime-600 dark:text-lime-500 transform duration-700 shrink-0" />
                                                    <span>{{ $var->address }}</span>
                                                </div>
                                                <div class="w-full flex items-center gap-2 col-span-2">
                                                    <x-fas-envelope
                                                        class="w-2 lg:w-3 text-lime-600 dark:text-lime-500 transform duration-700" />
                                                    <span>{{ $var->email }}</span>
                                                </div>
                                                <div class="w-full flex items-center gap-2">
                                                    <x-fas-map-marked-alt
                                                        class="w-2 lg:w-3 text-lime-600 dark:text-lime-500 transform duration-700" />
                                                    <span class="capitalize">{{ $var->location }} Valley</span>
                                                </div>
                                                <div class="col-span-2 flex gap-2 lg:hidden">
                                                    <a href="tel:{{ $var->phone }}"
                                                        class="w-max inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-100 hover:dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white dark:focus:text-black active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 gap-2">
                                                        <x-fas-phone class="w-3" />
                                                        <span>{{ $var->phone }}</span>
                                                    </a>
                                                    @if ($var['alt-phone'] != null)
                                                        <a href="tel:{{ $var['alt-phone'] }}"
                                                            class="w-max inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-100 hover:dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white dark:focus:text-black active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 gap-2">
                                                            <x-fas-phone class="w-3" />
                                                            <span>{{ $var['alt-phone'] }}</span>
                                                        </a>
                                                    @endif
                                                    </div>
                </div>
                <div class="rounded-lg bg-gray-500/20 max-w-sm w-full p-4 shrink-0 shadow-2xl">
                    <h1 class="font-bold text-lime-600 dark:text-lime-500 transform duration-700">
                        Items</h1>

                    <table class="table-auto w-full">
                        <tbody class="pb-2">
                            @foreach ($orderItems[$var->id] as $item)
                                <tr class="">
                                    <td class="pb-2">{{ $item->product->name }}
                                        (x{{ $item->quantity }})
                                    </td>
                                    <td class="w-[20%]">रु
                                        {{ $item->price * $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-t border-t-gray-500 dark:border-t-gray-800 border-dashed">
                            <tr>
                                <td class="pt-2">Sub Total</td>
                                <td class="w-[20%]">
                                    <p class="w-full">रु
                                        <span>{{ $var->total_price - ($var->location == 'inside' ? 100 : 150) + $var->discount + $var->advance }}</span>
                                    </p>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="">Discount</td>
                                <td class="{{ $var->discount == 0 ? '' : 'text-red-600 dark:text-rose-400' }}">
                                    {{ $var->discount == 0 ? '-' : 'रु ' . $var->discount }}
                                </td>
                            </tr>
                            <tr class="">
                                <td class="">Delivery Charge</td>
                                <td>
                                    {{ $var->location == 'inside' ? 'रु 100' : 'रु 150' }}
                                </td>
                            </tr>
                            <tr class="">
                                <td class="">Net. Total</td>
                                <td> रु
                                    {{ $var->total_price + $var->advance }}
                                </td>
                            </tr>
                            <tr class="">
                                <td class="pb-2">Advance</td>
                                <td> रु
                                    {{ $var->advance }}
                                </td>
                            </tr>
                            <tr class="font-bold text-md border-t border-t-gray-500 dark:border-t-gray-600 border-dashed">
                                <td class="py-2 ">Grand Total</td>
                                <td class="text-lime-600 dark:text-lime-500">रु
                                    {{ $var->total_price }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="rounded-lg bg-gray-700/20 max-w-sm w-full flex-shrink p-4 shadow-lg">
                    <div class="w-full h-full flex-1">
                        <h1 class="font-bold text-lime-600 dark:text-lime-500 transform duration-700">
                            Notes</h1>
                        <div title="{{ $var->note ?? 'No notes recorded...' }}"
                            class="{{ $var->note ? 'line-clamp-3 lg:line-clamp-5' : 'text-gray-500 dark:text-gray-400 lg:flex justify-center items-center w-full h-full' }}">
                            <span>{{ $var->note ? $var->note : 'No notes recorded...' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $orders->links() }}
    </div>
    </div>
    </div>
    </div>
