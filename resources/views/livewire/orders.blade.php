<div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Orders') }}
            </h2>
            <div>
                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-search aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="fullName" class="block w-full" type="number" name="search"
                        placeholder="{{ __('Search order') }}" autofocus="true" wire:model.debounce.500ms="search" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
            </div>
            <a href="{{ route('orders.create') }}" class="primary-btn">Create order</a>
        </div>
    </div>
    <div class="flex-col mt-10">
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-500 shadow sm:rounded-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="!bg-slate-600">
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-200 uppercase border-b border-gray-200 w-1/12">
                                Order ID</th>
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
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200 hidden lg:table-cell">
                                Placed at</th>
                            <th
                                class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200">
                                Order Status</th>
                            <th class="py-3 text-sm font-bold text-gray-200 border-b border-gray-200 text-center">
                                Action</th>
                        </tr>
                    </thead>

                    <tbody x-data="{ order: false }">
                        @if ($orders->count() == 0)
                            <tr>
                                <td colspan="100%" class="!text-black dark:!text-white text-center py-4 w-full"><span>No items
                                        found!</span></td>
                            </tr>
                        @endif
                        @foreach ($orders as $var)
                            <tr class="table-rows"">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                    <div class="text-right">
                                        {{ $var->id }}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 w-44 hidden lg:table-cell">
                                    <div class="text-sm leading-5">
                                        {{ $var->getUser->name }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 hidden lg:table-cell">
                                    <div class="text-sm leading-5">{{ $var->fullName }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 hidden lg:table-cell">
                                    <div class="text-sm leading-5" title="{{ $var->address }}">{{ $var->address }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 hidden lg:table-cell">
                                    <p class="text-sm leading-5 max-w-xs line-clamp-[3]"
                                        title="{{ $var->created_at->format('jS M, Y | H:i A') }}">
                                        {{ $var->created_at->diffForHumans() }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500">
                                    @can ('update order') 
                                        <form action="" method="post">
                                            @csrf
                                            <select name="status" id="status"
                                                class="bg-gray-300 dark:bg-gray-800 rounded-lg border-0 outline-none focus:ring-0">
                                                <option value="">Null</option>
                                                <option value="pending" @if ($var->order_status == 'pending') selected @endif>
                                                    Pending</option>
                                            </select>
                                        </form>
                                    @else 
                                    <div class="text-sm leading-5 capitalize">{{ $var->order_status }}
                                    </div>
                                    @endcan
                                </td>

                                <td
                                    class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-500 mx-auto">
                                    <div class="flex gap-2 justify-center">

                                        @can ('edit order') 
                                            <a href="{{ route('orders.edit', $product = $var->id) }}"
                                                class="text-lime-500 hover:text-lime-700 flex justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        @endcan
                                        {{-- <a href="{{ route('product.show', $var->id) }}"
                                                class="text-cyan-500 hover:text-cyan-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a> --}}
                                        @can ('delete order') 
                                            <form action="{{ route('orders.destroy', $var->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this product?')"><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-6 h-6 text-red-500 hover:text-red-700" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                        <x-fas-eye class="w-5 text-cyan-500 hover:text-cyan-700"
                                            @click="order = {{ $var->id }}"
                                            x-show="order != {{ $var->id }}">View</x-fas-eye>
                                        <x-fas-eye-slash class="w-5" @click="order = false"
                                            x-show="order == {{ $var->id }}">x</x-fas-eye-slash>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="100%">
                                    <div class="relative overflow-hidden transition-all max-h-0 duration-700 flex justify-between w-full px-16"
                                        style="" x-ref="container{{ $var->id }}"
                                        x-bind:style="order == {{ $var->id }} ? 'max-height: ' + $refs
                                            .container{{ $var->id }}.scrollHeight +
                                            'px; display: flex; margin-bottom: 1rem; margin-top: 1rem;' : ''">
                                        <div class="grid grid-cols-1 lg:grid-cols-4 space-x-2 w-full">
                                            <div class="w-full flex items-center gap-2">
                                                <x-fas-user class="w-4" /><span>{{ $var->fullName }}</span>
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
