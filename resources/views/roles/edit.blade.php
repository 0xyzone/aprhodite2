<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Role') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('role.update', $role) }}" class="max-w-sm" method="post">
            @csrf
            @method('PATCH')
            <div class="space-y-2">
                <x-label for="name" :value="__('Role Name')" />

                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-id-badge aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="name" class="block w-full" type="text" name="name"
                        :value="old('name', $role->name)" placeholder="{{ __('Type role name here...') }}" autofocus="true" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-button class="justify-center gap-2 w-max" type="submit">
                    <x-fas-cloud-upload-alt class="w-4" aria-hidden="true" />
                    <span>{{ __('Update') }}</span>
                </x-button>
            </div>
        </form>
    </div>

    <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Permissions') }}
        </h2>
    </div>
    <div class="mt-4 flex gap-2 flex-wrap">
        @if ($role->permissions)
            @foreach ($role->permissions as $var)
                <form action="{{ route('role.revoke.perm', [$role->id, $var->id]) }}" method="post" class="pill2">
                    @csrf
                    @method('delete')
                    <button type="submit" class="border-r hover:bg-red-600 smooth rounded-l-lg peer">
                        <x-heroicon-o-x-mark class="w-8 h-8 p-1" />
                    </button>
                    <div class="pr-4 pl-2 peer-hover:bg-red-700 smooth rounded-r-lg h-full flex items-center"
                        title="Revoke permission">
                        <span class="">{{ $var->name }}</span>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
    <div class="mt-4 p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('role.assign.perm', $role) }}" class="max-w-sm" method="post">
            @csrf
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            <div class="space-y-2">
                <x-label for="permission" :value="__('Add Permissions')" />
                <select name="permission[]" id="permission" class="w-full" multiple>
                    <option value="" hidden></option>
                    @foreach ($permissions as $var)
                        <option value="{{ $var->name }}" @if ($role->hasPermissionTo($var->name)) disabled @endif>
                            {{ $var->name }}</option>
                    @endforeach
                </select>
            </div>
            <script>
                $(document).ready(function() {
                    $('#permission').select2({
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
                    <x-fas-check class="w-4" aria-hidden="true" />
                    <span>{{ __('Assign') }}</span>
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
