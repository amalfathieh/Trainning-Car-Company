@extends('layouts.dashboard')

@section('title', 'Cars')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Cars</li>
@endsection

@section('content')
    <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.cars._form')
    </form>
@endsection
