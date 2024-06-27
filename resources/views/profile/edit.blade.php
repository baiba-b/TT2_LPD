<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Profile Picture') }}</h3>
                @if(Auth::user()->profile_picture)
                    <img src="public\default_profile_picture.png" alt="Profile Picture" class="rounded-full w-35px h-35px">
                @else
                    <img src="{{public\default_profile_picture.png}}" alt="Default Profile Picture" class="rounded-full w-35px h-35px">
                @endif
            </div>
            @include('profile.partials.update-profile-picture-form')
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
