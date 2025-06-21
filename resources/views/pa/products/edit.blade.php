@extends('pa.layouts.app')
@section('content')
    @include('pa.products._form', [
        'action' => route('pa.products.update', $product->id),
        'method' => 'POST',
        'product' => $product,
        'categories' => $categories,
    ])
@endsection
