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
                        @if(count($under_categories)>0)
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($under_categories as $under_category)
                            <a href="{{route('category.index',$under_category->slug)}}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i>{{$under_category->category_name}}</a>
                                @endforeach
                        </div>
                        @else
                            <div class="col-md-12">Bu kategoryde alt kategory bulunmamamkta</div>
                        @endif
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
                    @if(count($products)>0)
                    Sırala
                    <a href="?order=bestseller" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=new" class="btn btn-default">Yeni Ürünler</a>
                    <hr>
                    @endif
                    <div class="row">
                        @if(count($products)==0)
                            <div class="col-md-12">Bu kategoryde ürün bulunmamakta</div>
                        @endif
                        @foreach($products as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product.index',$product->slug)}}"> <img src="{{ $product->details->product_image !=null ? asset('uploads/urunler/' . $product->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="min-width: 90%;">
                                <p><a href="{{route('product.index',$product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}}</p>
                                <form action="{{route('basket.add.product')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                                </form>
                            </div>
                        @endforeach
                    </div>
                        {{ request()->has('order') ? $products->appends(['order' => request('order')])->links() : $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
