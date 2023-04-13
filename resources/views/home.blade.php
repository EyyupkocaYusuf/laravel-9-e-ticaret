@extends('layouts.master')
@section('title','Anasayfa')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @else
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{session('warning')}}
                        </div>
                    @endif
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($categories as $category)
                            <a href="{{route('category.index',$category->slug)}}" class="list-group-item"><i class="fa fa-television"></i> {{$category->category_name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0;$i<count($product_slider);$i++)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($product_slider as $index => $product)
                            <a href="#" class="item {{ $index == 0 ? 'active' : '' }}">
                                <img src="http://lorempixel.com/640/400/food/1" alt="...">
                                <div class="carousel-caption">
                                    {{ $product->product_name }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <img src="http://lorempixel.com/640/400/food/1" alt="...">
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="#">
                            <img src="http://lorempixel.com/400/485/food/1" class="img-responsive">
                            {{$product_day->product_name}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($show_featured as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product.index',$product->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                                <p><a href="{{route('product.index',$product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($show_bestseller as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product.index',$product->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                                <p><a href="{{route('product.index',$product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($show_discount as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product.index',$product->slug)}}"><img src="http://lorempixel.com/400/400/food/1"></a>
                                <p><a href="{{route('product.index',$product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
