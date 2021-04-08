@extends('layouts.base')
@section('title', 'Register')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 style="
            font-family: 'Baloo Tamma', cursive;
            text-align: center;
            width: 100%;
            margin: 0px auto;
            font-size: 80px;
            letter-spacing: 5px;
        ">REGISTER</h1>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input style="height: 50px;" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-2">
                <x-label for="email" :value="__('Email')" />
                <x-input style="height: 50px;" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!--Phone Number -->
             <div class="mt-2">
                <x-label for="phonenumber" :value="__('Phone number')" />
                <x-input style="height: 50px;" id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" :value="old('phonenumber')" required autofocus />
            </div>

            <!--Address -->
             <div class="mt-2">
                <x-label for="address" :value="__('Address')" />
                <x-input style="height: 50px;" id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-2">
                <x-label for="password" :value="__('Password')" />
                <x-input style="height: 50px;" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-2">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input style="height: 50px;" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection
