@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Produk</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-2">
                <img src="{{ Storage::url($product->thumbnail) }}" width="100" class="img-thumbnail">
            </div>
        </div>

        <div class="mb-3">
            <label for="product" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" name="product" value="{{ old('product', $product->product) }}" required>
            @error('product')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category', $product->category) }}" required>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
