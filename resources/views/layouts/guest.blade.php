<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      body {
        background: linear-gradient(135deg, #7dd3fc 0%, #3b82f6 100%);
        min-height: 100vh;
        margin: 0;
      }
    </style>
  </head>

  <body class="font-sans text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center py-6">
      <div>
        <a href="/" class="inline-block">
          <h3 class="flex items-center text-3xl font-bold text-indigo-600 hover:text-purple-700 transition-colors duration-300 select-none cursor-default">
            
            <!-- Image Logo -->
            <img src="/images/your-background.jpg" alt="Logo" class="w-10 h-10 mr-3 rounded-full object-cover" />

            <!-- E-Commerce Text with Circle Background -->
            <span class="inline-block bg-indigo-600 text-white rounded-full px-6 py-2">
            
            </span>
            
          </h3>
        </a>
      </div>

      <div class="w-full sm:max-w-md mt-8 px-6 py-4 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
        {{ $slot }}
      </div>
    </div>
  </body>
</html>
