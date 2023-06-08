@extends('admin.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')
    <h1 class="page-header">Ürün Yönetimi</h1>
    <h1 class="sub-header">Ürün Listesi</h1>
    <div class="well">
        <div class="btn-group pull-right" >
            <a href="{{route('admin.product.add')}}" class="btn btn-primary">Yeni</a>
        </div>
        <form method="post" action="{{route('admin.product.index')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Ara</label>
                <input name="wanted" type="text" class="form-control form-control-sm" id="wanted" placeholder="Ürün Ara" value="{{old('wanted')}}">
                <button type="submit" class="btn btn-primary">Ara</button>
                <a href="{{route('admin.product.index')}}" class="btn btn-primary">Temizle</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Resim</th>
                <th>Slug</th>
                <th>Ürün Adı</th>
                <th>Fiyatı</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($list) == 0)
                <tr><td colspan="7" class="text-center">Kayıt bulunamadı!</td></tr>
            @endif
            @foreach($list as $entry)
                <tr>
                    <td>{{$entry->id}}</td>
                    <td>
                        <img src="{{ $entry->details->product_image !=null ? asset('uploads/urunler/' . $entry->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="width: 100px;">

                    </td>
                    <td>{{$entry->slug}}</td>
                    <td>{{$entry->product_name}}</td>
                    <td>{{$entry->price}}</td>
                    <td>{{$entry->created_at}}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.product.edit',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.product.delete',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$list->appends('wanted',old('wanted'))->links()}}
    </div>
@endsection
