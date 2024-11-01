@extends('layouts.app') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<div class="container">
    <h1>Buat Biaya Limbah</h1>

    <form action="{{ route('waste-price-cost.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="waste_id" class="form-label">Kategori Limbah</label>
            <select name="waste_id" id="waste_id" class="form-select" required>
                <option value="">Pilih Kategori Limbah</option>
                @foreach($wasteCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('waste_id') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah</label>
            <input type="number" name="amount" id="amount" class="form-control" required value="{{ old('amount') }}">
            @error('amount') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Satuan</label>
            <input type="text" name="unit" id="unit" class="form-control" required value="{{ old('unit') }}">
            @error('unit') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price_cost" class="form-label">Harga Biaya</label>
            <input type="number" name="price_cost" id="price_cost" class="form-control" required value="{{ old('price_cost') }}">
            @error('price_cost') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
