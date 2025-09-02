@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            {{-- Carteira --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if(!$user->blockchain_address)
                        <section>
                            <h5 class="card-title fw-semibold">{{ __('Wallet Creation') }}</h5>
                            <p class="text-muted small mb-4">
                                {{ __("Create your wallet by clicking the create button below:") }}
                            </p>

                            <form method="POST" action="{{ route('wallet.store') }}">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </form>
                        </section>
                    @else
                        <section>
                            <h5 class="card-title fw-semibold">{{ __('Wallet Address') }}</h5>
                            <p class="text-muted">{{ $user->blockchain_address }}</p>

                            <h5 class="card-title fw-semibold mt-3">{{ __('Balance') }}</h5>
                            <p class="text-muted">Total: {{ $balance }} S</p>
                        </section>
                    @endif
                </div>
            </div>

            {{-- Transferência --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">{{ __('Transfer Tokens') }}</h5>
                    <p class="text-muted small mb-4">
                        {{ __("Transfira os seus Tokens Sonic para outra carteira:") }}
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('wallet.transfer') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="to_address" class="form-label">{{ __('Endereço da carteira de destino') }}</label>
                            <input type="text" name="to_address" id="to_address"
                                   class="form-control @error('to_address') is-invalid @enderror"
                                   value="{{ old('to_address') }}" required autofocus>
                            @error('to_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">{{ __('Quantidade (Sonic)') }}</label>
                            <input type="text" name="amount" id="amount"
                                   class="form-control @error('amount') is-invalid @enderror"
                                   value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Confirme com sua senha') }}</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
