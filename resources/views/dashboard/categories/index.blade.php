@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="md-5">
    <a href="{{route('dashboard.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
</div>

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
@endif
@if(session()->has('info'))
    <div class="alert alert-info">
        {{ session('info')}}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th colspan = "3"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' .$category->image) }} " alt="" height="50"></td>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{ route('dashboard.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.destroy', $category->id )}}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                     <input type="hidden" name="_method" value="delete">
                     <!-- or -->
                     @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                </form>
            </td>
            <td>
                <a href="{{ route('dashboard.show', $category->id) }}" class="btn btn-sm btn-outline-success">see all</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No categories defined</td>
        </tr>

        @endforelse


    </tbody>
</table>

@endsection
