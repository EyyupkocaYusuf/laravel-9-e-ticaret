@extends('admin.layouts.master')
@section('title', 'Kategori Yönetimi')
@section('content')
    <h1 class="page-header">Kategori Yönetimi</h1>

    <h3 class="sub-header">Kategori Listesi</h3>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('admin.category.add') }}" class="btn btn-primary">Yeni</a>
        </div>
        <form method="post" action="{{ route('admin.category.index') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="aranan">Ara</label>
                <input type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Kategori Ara..." value="{{ old('aranan') }}">
                <label for="main_categories">Üst Kategori</label>
                <select name="top_id" id="top_id" class="form-control">
                    <option value="">Seçiniz</option>
                    @foreach($main_categories as $category)
                        <option value="{{$category->id}}" {{old('top_id') == $category->id ? 'selected': ''}}>{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Temizle</a>
        </form>
    </div>



    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Üst Kategori</th>
                <th>Slug</th>
                <th>Kategori Adı</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($list) == 0)
                <tr><td colspan="6" class="text-center">Kayıt bulunamadı!</td></tr>
            @endif
            @foreach ($list as $entry)
                <tr>
                    <td>{{ $entry->id }}</td>
                    <td>{{$entry->top_category->category_name}}</td>
                    <td>{{ $entry->slug }}</td>
                    <td>{{ $entry->category_name }}</td>
                    <td>{{ $entry->created_at }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.category.edit', $entry->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.category.delete', $entry->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
@endsection
