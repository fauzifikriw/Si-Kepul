@extends('layouts.app') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<div class="container">
    <h1>Perbarui Biaya Limbah</h1>

    <form action="{{ route('waste-price-cost.update', $wastePriceCost->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="waste_id" class="form-label">Kategori Limbah</label>
            <select name="waste_id" id="waste_id" class="form-select" required>
                <option value="">Pilih Kategori Limbah</option>
                @foreach($wasteCategories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $wastePriceCost->waste_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('waste_id') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $wastePriceCost->amount) }}" required>
            @error('amount') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Satuan</label>
            <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit', $wastePriceCost->unit) }}" required>
            @error('unit') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price_cost" class="form-label">Harga Biaya</label>
            <input type="number" name="price_cost" id="price_cost" class="form-control" value="{{ old('price_cost', $wastePriceCost->price_cost) }}" required>
            @error('price_cost') <!-- Menampilkan pesan error jika ada -->
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
