<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload Section -->
        <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
            <x-input-label for="avatar" :value="__('Foto Profil')" />
            <div class="mt-3 flex items-center gap-4">
                <!-- Current Avatar Preview -->
                <div class="flex-shrink-0">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-4 border-blue-500 shadow-lg">
                    @else
                        <div class="w-24 h-24 bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-semibold border-4 border-blue-500 shadow-lg">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <!-- Upload Button -->
                <div class="flex-1">
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/jpg" class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700" onchange="previewAvatar(event)">
                    <p class="mt-2 text-xs text-gray-600">
                        <i class="bi bi-info-circle"></i> JPG, JPEG, PNG. Maksimal 2MB.
                    </p>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />

                    @if($user->avatar)
                        <button type="button" onclick="document.getElementById('remove_avatar').value='1'; this.form.submit();" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-red-600 border border-red-500 rounded hover:bg-red-50 transition-colors">
                            <i class="bi bi-trash mr-1"></i> Hapus Foto
                        </button>
                        <input type="hidden" id="remove_avatar" name="remove_avatar" value="0">
                    @endif
                </div>
            </div>

            <!-- Preview Image (Hidden, akan muncul saat pilih foto) -->
            <div id="avatar-preview" class="mt-4 hidden">
                <p class="text-sm font-medium text-gray-700 mb-2">Preview Foto:</p>
                <img id="avatar-preview-img" src="" alt="Preview" class="w-24 h-24 rounded-full object-cover border-4 border-green-500 shadow-lg">
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').classList.remove('hidden');
                    document.getElementById('avatar-preview-img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</section>
