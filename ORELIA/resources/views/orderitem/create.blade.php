@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('orderitems.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="unit_price" class="form-label">Unit Price</label>
      <input type="number" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price') }}" required>
      @error('unit_price')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
      @error('quantity')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="order_id" class="form-label">Order ID</label>
      <input type="number" class="form-control @error('order_id') is-invalid @enderror" id="order_id" name="order_id" value="{{ old('order_id') }}" required>
      @error('order_id')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="piece_id" class="form-label">Piece ID</label>
      <input type="number" class="form-control @error('piece_id') is-invalid @enderror" id="piece_id" name="piece_id" value="{{ old('piece_id') }}" required>
      @error('piece_id')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Order Item</button>
    <a href="{{ route('orderitems.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection