@extends('admin.layouts.master')
@section('title', 'Kategori Yönetimi')
@section('content')
    <h1 class="page-header">Kategori Yönetimi</h1>

    <form method="post" action="{{ route('admin.category.save', $entry->id) }}">
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ $entry->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h3 class="sub-header">
            Kategori {{ $entry->id > 0 ? "Düzenle" : "Ekle" }}
        </h3>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ust_id">Üst Kategori</label>
                    <select name="top_id" id="top_id" class="form-control">
                        <option value="">Ana Kategori</option>
                        @foreach($kategoriler as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == old('top_id', $entry->top_id) ? 'selected' : '' }}>{{ $kategori->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_name">Kategori Adı</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Kategori Adı" value="{{ old('category_name', $entry->category_name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{ old('slug', $entry->slug) }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug', $entry->slug) }}">
                </div>
            </div>
        </div>
    </form>
@endsection
