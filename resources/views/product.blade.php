@extends('layouts.master')
@section('title',$product->product_name)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Anasayfa</a></li>
            @foreach($categories as $category)
            <li><a href="{{route('category.index',$category->slug)}}">{{$category->category_name}}</a></li>
            @endforeach
            <li class="active">{{$product->product_name}}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ $product->details->product_image !=null ? asset('uploads/urunler/' . $product->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="min-width: 90%;">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"> <img src="{{ $product->details->product_image !=null ? asset('uploads/urunler/' . $product->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="min-width: 90%;"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"> <img src="{{ $product->details->product_image !=null ? asset('uploads/urunler/' . $product->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="min-width: 90%;"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"> <img src="{{ $product->details->product_image !=null ? asset('uploads/urunler/' . $product->details->product_image) : 'http://via.placeholder.com/400x485?text=UrunResmi' }}" class="img-responsive" style="min-width: 90%;"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$product->product_name}}</h1>
                    <p class="price">{{$product->price}} ₺</p>
                    <form action="{{route('basket.add.product')}}" method="post">
                       @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                    </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">{{$product->explanation}}</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Henüz bir yorum yok</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">t1</div>
                    <div role="tabpanel" class="tab-pane" id="t2">t2</div>
                </div>
            </div>

        </div>
    </div>
@endsection
