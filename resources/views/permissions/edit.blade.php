<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Permission') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('permission.update', $permission) }}" class="max-w-sm" method="post">
            @csrf
            @method('PATCH')
            <div class="space-y-2">
                <x-label for="name" :value="__('Permission Name')" />

                <x-input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-fas-user-shield aria-hidden="true" class="w-5 h-5" />
                    </x-slot>
                    <x-input withicon id="name" class="block w-full" type="text" name="name"
                    :value="old('name', $permission->name)" placeholder="{{ __('Type role name here...') }}" autofocus="true" />
                </x-input-with-icon-wrapper>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-button class="justify-center gap-2 w-max" type="submit">
                    <x-grommet-update class="w-4" aria-hidden="true" />
                    <span>{{ __('Update') }}</span>
                </x-button>
            </div>
        </form>

    </div>
</x-app-layout>