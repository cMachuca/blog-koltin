<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create Personal Token
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            You can create a personal token with your credentials to make a sandbox API Requests
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-personal-token')"
    >Create Personal Token</x-danger-button>

    <x-modal name="confirm-user-personal-token" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('users.create.token') }}" class="p-6">
            @csrf
            @method('POST')

            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to create a personal token for your account?
            </h2>

            <div class="mt-6">

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    Create Personal Token
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
