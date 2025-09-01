<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wallet') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    @if(!$user->blockchain_address)
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Wallet Creation') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Create your wallet by clicking the create button below:") }}
                                </p>
                            </header>

                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <form method="post" action="{{ route('wallet.store') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('post')
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    @else
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Wallet Address') }}  
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $user->blockchain_address }}
                                </p>
                            </header>

                            
                        </section>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
