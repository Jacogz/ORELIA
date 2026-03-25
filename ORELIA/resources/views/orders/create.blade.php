@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <form action="{{ route('orders.store') }}" method="POST" class="card p-4">
    @csrf

    <div class="mb-3">
      <label for="total" class="form-label">Total</label>
      <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}" min="0" required>
      @error('total')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="creation_date" class="form-label">Creation Date</label>
      <input type="datetime-local" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date" name="creation_date" value="{{ old('creation_date') }}" required>
      @error('creation_date')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}" required>
      @error('status')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="client_id" class="form-label">Client ID</label>
      <input type="number" class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{ old('client_id') }}" min="1" required>
      @error('client_id')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="payment_method" class="form-label">Payment Method</label>
      <input type="text" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" value="{{ old('payment_method') }}" required>
      @error('payment_method')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="payment_status" class="form-label">Payment Status</label>
      <input type="text" class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" value="{{ old('payment_status') }}" required>
      @error('payment_status')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection
