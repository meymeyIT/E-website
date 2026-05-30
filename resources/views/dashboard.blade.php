<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-700 dark:text-indigo-300 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-100 via-indigo-200 to-indigo-300 dark:from-indigo-900 dark:via-indigo-800 dark:to-indigo-700 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-indigo-50 dark:bg-indigo-900/70 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-indigo-900 dark:text-indigo-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
