<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Roles') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <!-- Index Post -->

        <div class="mb-4">
            <div class="flex justify-end">
                <a href="{{ route('role.create') }}" class="px-4 py-2 rounded-md bg-violet-500 text-violet-100 hover:bg-violet-600 smooth">Create Role</a>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-500 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr class="!bg-slate-600">
                                <th
                                    class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200">
                                    Title</th>
                                    <th
                                    class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200">
                                    Permissions</th>
                                <th
                                    class="px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-200 uppercase border-b border-gray-200">
                                    Created_At</th>
                                <th class="px-6 py-3 text-sm font-bold text-center text-gray-200 border-b border-gray-200">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($roles as $var)
                                <tr class="even:bg-slate-600 odd:bg-slate-700">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            {{ ($loop->iteration) }}
                                        </div>
    
                                    </td>
    
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5">{{ $var->name }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 max-w-[10rem]">
                                        <div class="text-sm leading-5 flex gap-2 flex-wrap">
                                            @if ($var->permissions)
                                                @foreach ($var->permissions as $perm)
                                                <form action="{{ route('role.revoke.perm', [$var->id, $perm->id]) }}" method="post" class="flex items-center text-sm shrink-0 bg-gradient-to-tr from-violet-900 to-violet-600 rounded-lg h-auto peer-hover:bg-red-700">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="border-r hover:bg-red-600 smooth rounded-l-lg peer">
                                                        <x-heroicon-o-x-mark class="w-6 h-6 p-1"/>
                                                    </button>
                                                    <div class="pr-4 pl-2 peer-hover:bg-red-700 smooth rounded-r-lg h-full flex items-center" title="Revoke permission">
                                                        <span class="">{{ $perm->name }}</span>
                                                    </div>
                                                    </form>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
    
                                    <td
                                        class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500">
                                        <span>{{ $var->created_at->format('jS M, Y') }}</span>
                                    </td>
    
                                    <td
                                        class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-500 mx-auto">
                                        <a href="{{ route('role.edit', $role = $var->id) }}" class="text-indigo-600 hover:text-indigo-900 flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
    
                                    {{-- <td
                                        class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                        <a href="#" class="text-gray-600 hover:text-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
    
                                    </td>
    
                                    </td>
                                    <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-red-600 hover:text-red-800" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg></a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
