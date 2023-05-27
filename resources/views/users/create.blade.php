<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="grid gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <x-label for="name" :value="__('Name')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input autofocus withicon id="name" class="block w-full" type="text" name="name"
                            :value="old('name')" autofocus placeholder="{{ __('Name') }}" />
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
                            :value="old('email')" placeholder="{{ __('Email') }}" />
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-label for="password" :value="__('Password')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="password" class="block w-full" type="password" name="password"
                            autocomplete="new-password" placeholder="{{ __('Password') }}" />
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="password_confirmation" class="block w-full" type="password"
                            name="password_confirmation" placeholder="{{ __('Confirm Password') }}" />
                    </x-input-with-icon-wrapper>
                </div>


                <div class="space-y-2">
                    <x-label for="roles" :value="__('Assign Roles')" />
                    <select name="roles[]" id="roles" class="w-full" multiple>
                        <option value="" hidden></option>
                        @foreach ($roles as $var)
                            <option value="{{ $var->name }}">{{ $var->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
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

                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-plus class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
