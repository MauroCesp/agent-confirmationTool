@extends('layouts.app')

@section('content')

<style>
    .wk-field {
    font-size: 1.35rem;

}
</style>
<div class="wk-page-container-fluid">
    <div class="wk-row">
        <div class="wk-col-4"></div>
        <div class="wk-col-4">

            
            <div class="wk-docs-example-card-container">
                <section class="wk-card-container">
                    <header class="wk-card-container-header" >
                        <h3>{{ __('Login') }}</h3>
                    </header>
                    <div class="wk-card-container-body">
                        <div class="wk-page-container-fluid" style="width: 100%">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="wk-row">
                                <div class="wk-col-12">
                                    <div class="wk-field">
                                        <div class="wk-field-header">
                                            <label class="wk-field-label" for="id-lQdqFq">{{ __('Email Address') }}</label>
                                        </div>
                                        <div class="wk-field-body">
                                            <input id="email" type="email" name="email" class="wk-field-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <div class="wk-field-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>        
                                </div>
                            </div>
                            <div class="wk-row">
                                <div class="wk-col-12">
                                    <div class="wk-field wk-field-password">
                                        <div class="wk-field-header">
                                            <label class="wk-field-label">{{ __('Password') }}</label>
                                        </div>
                                        <div class="wk-field-body">
                                            <input type="password" name="password" placeholder="" class="wk-field-input @error('password') is-invalid @enderror" required autocomplete="current-password">
                                            @error('password')
                                            <div class="wk-field-error" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wk-row">
                                <div class="wk-col-12">
                                    <div class="wk-field docs-checkbox-radio">
                                        <div class="wk-field-body">
                                            <label class="wk-field-choice-label">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="wk-field-choice">
                                                <span class="wk-field-choice-text">{{ __('Remember Me') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wk-row">
                                <div class="wk-col-6">
                                    <button type="submit" class="wk-button wk-button-icon-right" style="font-size: 1.45rem;">
                                        {{ __('Login') }} <span class="wk-icon-arrow-right" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="wk-col-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" style="font-size: 13px; color: #007ac3; text-decoration: none" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </form>
                        </div>


                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
