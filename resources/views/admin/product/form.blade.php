@extends('admin.layouts.master')
@section('title', 'Ürün Yönetimi')
@section('content')
    <h1 class="page-header">Ürün Yönetimi</h1>

    <form method="post" action="{{ route('admin.product.save', $entry->id) }}" enctype="multipart/form-data">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Ürün Adı</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Ürün Adı" value="{{ old('product_name', $entry->product_name) }}">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="slug" value="{{ old('slug', $entry->slug) }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug', $entry->slug) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="explanation">Ürün Açıklaması</label>
                    <textarea class="form-control" id="explanation" name="explanation">{{ old('explanation', $entry->explanation) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Ürün Fiyatı</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Ürün Fiyatı" value="{{ old('price', $entry->price) }}">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="show_slider" value="0">
                <input type="checkbox" name="show_slider" value="1" {{ old('show_slider', $entry->details->show_slider) ? 'checked' : '' }}> Slider'da Göster
            </label>
            <label>
                <input type="hidden" name="show_opportunity_day" value="0">
                <input type="checkbox" name="show_opportunity_day" value="1" {{ old('show_opportunity_day', $entry->details->show_opportunity_day) ? 'checked' : '' }}> Günün Fırsatında Göster
            </label>
            <label>
                <input type="hidden" name="show_featured" value="0">
                <input type="checkbox" name="show_featured" value="1" {{ old('show_featured', $entry->details->show_featured) ? 'checked' : '' }}> Öne Çıkan Alanında Göster
            </label>
            <label>
                <input type="hidden" name="show_bestseller" value="0">
                <input type="checkbox" name="show_bestseller" value="1" {{ old('show_bestseller', $entry->details->show_bestseller) ? 'checked' : '' }}> Çok Satan Ürünlerde Göster
            </label>
            <label>
                <input type="hidden" name="show_discount" value="0">
                <input type="checkbox" name="show_discount" value="1" {{ old('show_discount', $entry->details->show_discount) ? 'checked' : '' }}> İndirimli Ürünlerde Göster
            </label>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="categories">Kategoriler</label>
                    <select name="kategoriler[]" class="form-control" id="kategoriler" multiple>
                        @foreach($kategoriler as $kategori)
                            <option value="{{ $kategori->id }}" {{ collect(old('kategoriler', $urun_kategoriler))->contains($kategori->id) ? 'selected': '' }}>{{ $kategori->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            @if ($entry->details->product_image!=null)
                <img src="/uploads/urunler/{{ $entry->details->product_image }}" style="height: 100px; margin-right: 20px;" class="thumbnail pull-left">
            @endif
            <label for="product_image">Ürün Resmi</label>
            <input type="file" id="product_image" name="product_image">
        </div>
    </form>
@endsection

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('footer')
    <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/plugins/autogrow/plugin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function () {
            $('#kategoriler').select2({
                placeholder: 'Lütfen kategori seçiniz'
            });

        });
    </script>
@endsection
