<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- NIM -->
        <div id="nim-field" class="mt-4">
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" autocomplete="nim" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <!-- NIDN -->
        <div id="nidn-field" class="mt-4" style="display: none;">
            <x-input-label for="nidn" :value="__('NIDN')" />
            <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" autocomplete="nidn" />
            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

                <!-- Confirm Password -->

                <div class="mt-4">

                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"

                                    type="password"

                                    name="password_confirmation" required autocomplete="new-password" />

        

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>

        

                <!-- Role -->

                <div class="mt-4">

                    <x-input-label for="role" value="Status"/>

                    <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                        <option selected disabled>Pilih Status</option>
                        <option value="mahasiswa">Mahasiswa</option>

                        <option value="dpa">DPA</option>

                    </select>

                    <x-input-error :messages="$errors->get('role')" class="mt-2" />

                </div>

        

                <div class="flex items-center justify-end mt-4">

                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">

                        {{ __('Already registered?') }}

                    </a>

        

                    <x-primary-button class="ms-4">

                        {{ __('Register') }}

                    </x-primary-button>

                </div>

            </form>

        

            <script>

                document.getElementById('role').addEventListener('change', function () {
                    var nimField = document.getElementById('nim-field');
                    var nidnField = document.getElementById('nidn-field');
                    var emailInput = document.getElementById('email');
                    var emailValue = emailInput.value;
                    var username = emailValue.split('@')[0];

                    if (this.value === 'mahasiswa') {
                        nimField.style.display = 'block';
                        nidnField.style.display = 'none';
                        emailInput.value = username + '@mahasiswa.com';
                    } else if (this.value === 'dpa') {
                        nimField.style.display = 'none';
                        nidnField.style.display = 'block';
                        emailInput.value = username + '@admin.com';
                    }
                });

            </script>

        </x-guest-layout>
