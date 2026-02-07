@extends('layouts.app')

@section('title', 'Communautés')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold text-rose-600 mb-6">Communautés</h1>
    @livewire('community-list')
</div>
@endsection
