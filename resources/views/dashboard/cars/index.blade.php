@extends('layouts.dashboard')

@section('title', 'Cars')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Cars</li>
@endsection

@section('content')

    {{--    <div class="md-5">--}}
    {{--        <a href="{{route('car.create') }}" class="btn btn-sm btn-outline-primary">Create</a>--}}
    {{--    </div>--}}

    <div class="md-5">
        <a href="{{route('cars.create') }}" class="btn btn-sm btn-outline-primary">New Car</a>
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

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
        {{--        <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
    </head>
    <body>

    <div class="table">
        @if(count($cars) > 0)
            <table>
                <thead>
                <tr>
                    <th>image</th>
                    <th>brand</th>
                    <th>model</th>
                    <th>year</th>
                    <th>color</th>
                    <th>price</th>
                    <th>category_id</th>

                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td><img src="{{ asset('storage/' .$car->image) }} " alt="" height="50"></td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model}}</td>
                        <td>{{ $car->year}}</td>
                        <td>{{ $car->color}}</td>
                        <td>{{ $car->price}}</td>
                        <td>{{ $car->category_id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    </body>
    </html>

@endsection
