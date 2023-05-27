<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('users.update', $user) }}" class="flex flex-col gap-6" method="post">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <div class="space-y-2">
                <x-label for="name" :value="__('Name')" />
                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input autofocus withicon id="name" class="block w-full" type="text" name="name"
                        :value="old('name', $user->name)" autofocus placeholder="{{ __('Name') }}" />
                </x-input-with-icon-wrapper>
            </div>

            <!-- Email Address -->
            <div class="space-y-2">
                <x-label for="email" :value="__('Email')" />
                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-heroicon-o-envelope aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="email" class="block w-full" type="email" name="email"
                        :value="old('email', $user->email)" placeholder="{{ __('Email') }}" />
                </x-input-with-icon-wrapper>
            </div>

            <div class="">
                <x-button class="justify-center gap-2 w-max" type="submit">
                    <x-grommet-update class="w-4" aria-hidden="true" />
                    <span>{{ __('Update') }}</span>
                </x-button>
            </div>
        </form>
    </div>

    <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Roles') }}
        </h2>
    </div>
    <div class="mt-4 flex gap-2 flex-wrap">
        @if ($user->roles)
            @foreach ($user->roles as $var)
                <form action="{{ route('users.revoke.role', [$user->id, $var->id]) }}" method="post" class="flex items-center text-sm shrink-0 bg-gradient-to-tr from-violet-900 via-violet-800 to-violet-600 rounded-lg h-auto">
                @csrf
                @method('delete')
                
                    <button type="submit" @if (auth()->user()->id == $user->id && $var->name == 'admin') disabled @endif class="border-r hover:bg-red-600 smooth rounded-l-lg peer disabled:hover:bg-gray-600">
                        <x-heroicon-o-x-mark class="w-8 h-8 p-1"/>
                    </button>
                
                <div class="@if (auth()->user()->id == $user->id && $var->name == 'admin') peer-hover:bg-gray-600 @else peer-hover:bg-red-700 @endif pr-4 pl-2 smooth rounded-r-lg h-full flex items-center" title="Revoke permission">
                    <span class="">{{ $var->name }}</span>
                </div>
                </form>
            @endforeach
        @endif
    </div>
    <div class="mt-4 p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('users.assign.role', $user) }}" class="max-w-sm" method="post">
            @csrf
            <div class="space-y-2">
                <x-label for="roles" :value="__('Add Roles')" />
                <select name="roles[]" id="roles" class="w-full" multiple>
                    <option value="" hidden></option>
                    @foreach ($roles as $var)
                    <option value="{{ $var->name }}" @if ($user->hasRole($var->name)) disabled @endif>{{ $var->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <script>
                $(document).ready(function() {
                    $('#roles').select2({
                        placeholder: 'Select an option',
                        // theme: "classic",
                        closeOnSelect: false,
                        allowClear: true,
                        hidden: true
                    });
                });
            </script>
            <div class="mt-4">
                <x-button class="justify-center gap-2 w-max" type="submit">
                    <x-typ-tick-outline class="w-4" aria-hidden="true" />
                    <span>{{ __('Assign') }}</span>
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>