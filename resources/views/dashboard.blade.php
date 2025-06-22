{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Top Bar -->
<div class="flex justify-end items-center gap-4 mb-6">
    <!-- Toggle Button -->
    <div class="flex items-center bg-gray-200 dark:bg-gray-700 rounded-full p-1 transition cursor-pointer">
        <div id="lightIcon" class="p-1 rounded-full hover:bg-white" onclick="setLightMode()">🌞</div>
        <div id="darkIcon" class="p-1 rounded-full hover:bg-white" onclick="setDarkMode()">🌙</div>
    </div>

    <!-- Teks Info -->
    <div class="text-right">
        <p class="text-base font-semibold leading-4">Paud <br /><span class="font-bold">Gemilang</span></p>
        <p class="text-sm text-gray-500 dark:text-gray-300">Admin</p>
    </div>

    <!-- Foto Profil -->
    <img src="images/logo.jpg" alt="Foto Profil"
        class="h-10 w-10 object-cover rounded-full border-2 border-white dark:border-gray-600 shadow" />
</div>

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<!-- Date Picker -->
<div class="mb-6">
    <input id="dateInput" type="text" placeholder="dd/mm/yyyy"
        class="p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white" />
</div>

<!-- Info Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Card 1 -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow flex flex-col items-center text-center">
        <div class="bg-orange-500 rounded-full p-2 mb-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
            </svg>
        </div>
        <p class="text-gray-500 dark:text-gray-300 text-sm">Total Siswa</p>
        <h2 class="text-2xl font-bold my-1">{{ $totalSiswa }}</h2>
        <div class="relative w-12 h-12">
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="16" stroke="#E5E7EB" stroke-width="4" fill="none" />
                <circle cx="18" cy="18" r="16" stroke="#6366F1" stroke-width="4" fill="none" stroke-dasharray="100"
                    stroke-dashoffset="0" stroke-linecap="round" />
            </svg>
        <span class="absolute inset-0 flex items-center justify-center text-xs font-semibold">100%</span>

        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Last 24 Hours</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow flex flex-col items-center text-center">
        <div class="bg-rose-400 rounded-full p-2 mb-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
            </svg>
        </div>
        <p class="text-gray-500 dark:text-gray-300 text-sm">Total Hadir</p>
        <h2 class="text-2xl font-bold my-1">{{ $totalHadir }}</h2>
        <div class="relative w-12 h-12">
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="16" stroke="#E5E7EB" stroke-width="4" fill="none" />
                <circle cx="18" cy="18" r="16" stroke="#6366F1" stroke-width="4" fill="none" stroke-dasharray="100"
                    stroke-dashoffset="20" stroke-linecap="round" />
            </svg>
            <span class="absolute inset-0 flex items-center justify-center text-xs font-semibold">
                {{ round(($totalHadir / max($totalSiswa, 1)) * 100) }}%
            </span>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Last 24 Hours</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow flex flex-col items-center text-center">
        <div class="bg-green-400 rounded-full p-2 mb-2">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
            </svg>
        </div>
        <p class="text-gray-500 dark:text-gray-300 text-sm">Total Tidak Hadir</p>
        <h2 class="text-2xl font-bold my-1">{{ $totalTidakHadir }}</h2>
        <div class="relative w-12 h-12">
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="16" stroke="#E5E7EB" stroke-width="4" fill="none" />
                <circle cx="18" cy="18" r="16" stroke="#10B981" stroke-width="4" fill="none" stroke-dasharray="100"
                    stroke-dashoffset="80" stroke-linecap="round" />
            </svg>
            <span class="absolute inset-0 flex items-center justify-center text-xs font-semibold">
                {{ round(($totalTidakHadir / max($totalSiswa, 1)) * 100) }}%
            </span>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Last 24 Hours</p>
    </div>
</div>
@endsection