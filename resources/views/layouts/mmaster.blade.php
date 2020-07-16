@extends('adminlte::page')

@push('css')
    <link href="{{ mix('css/admin-app.css', 'build') }}" rel="stylesheet">

    @livewireStyles
@endpush

@push('js')
    <script src="{{ mix('js/admin-app.js', 'build') }}"></script>
    @livewireScripts
@endpush
