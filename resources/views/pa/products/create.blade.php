@extends('pa.layouts.app')
@section('content')
    @include('pa.products._form', [
        'action' => route('pa.products.store'),
        'method' => 'POST',
        'product' => null,
        'categories' => $categories,
    ])
@endsection
