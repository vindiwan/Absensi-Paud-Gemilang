@extends('layouts.app')

@section('title', 'Nilai Rapot - PAUD Gemilang')

@section('content')
<div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

    @php
    $page = request()->query('page', 'dbrapor');
    @endphp

    {{-- Navigation Tabs --}}
    <div class="flex gap-4 mb-6 border-b dark:border-gray-600">
        <a href="{{ url('/rapor?page=dbrapor') }}"
            class="{{ $page == 'dbrapor' ? 'border-b-2 border-indigo-500 text-indigo-600 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:text-indigo-600' }} py-2 px-4">
            Daftar Kelas
        </a>
        <a href="{{ url('/rapor?page=siswa') }}"
            class="{{ $page == 'siswa' ? 'border-b-2 border-indigo-500 text-indigo-600 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:text-indigo-600' }} py-2 px-4">
            Data Siswa
        </a>
        <a href="{{ url('/rapor?page=form') }}"
            class="{{ $page == 'form' ? 'border-b-2 border-indigo-500 text-indigo-600 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:text-indigo-600' }} py-2 px-4">
            Form Rapor
        </a>
        <a href="{{ url('/rapor?page=view') }}"
            class="{{ $page == 'view' ? 'border-b-2 border-indigo-500 text-indigo-600 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:text-indigo-600' }} py-2 px-4">
            Lihat Rapor
        </a>
    </div>

    {{-- Content Rendering --}}
    @if($page === 'dbrapor')
    @include('rapor.partials.dbrapor')
    @elseif($page === 'siswa')
    @include('rapor.partials.siswa')
    @elseif($page === 'form')
    @include('rapor.partials.form')
    @elseif($page === 'view')
    @include('rapor.partials.view')
    @else
    <div class="text-center text-gray-600 dark:text-gray-300">
        Halaman tidak ditemukan.
    </div>
    @endif
</div>
@endsection