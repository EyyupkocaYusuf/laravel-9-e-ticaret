@extends('layouts.master')
@section('title',$category->category_name)
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">Anasayfa</a></li>
            <li><a href="#">{{$category->category_name}}</a></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategori Adı</div>
                    <div class="panel-body">
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($under_categories as $under_category)
                            <a href="{{route('category.index',$under_category->slug)}}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i>{{$under_category->category_name}}</a>
                                @endforeach
                        </div>
                        <h3>Fiyat Aralığı</h3>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 100-200
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 200-300
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    Sırala
                    <a href="#" class="btn btn-default">Çok Satanlar</a>
                    <a href="#" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
