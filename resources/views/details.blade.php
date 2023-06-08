@extends('layouts.master')
@section('title','Sipariş Detayı')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{ route('order.index') }}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"></i> Siparişlere Dön
            </a>
            <h2>Sipariş (SP-{{$order->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Ürün</th>
                    <th>Ürün Adı</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($order->basket->basket_products as $basket_product)
                <tr>
                    <td style="width: 120px">
                        <a href="{{route('product.index',$basket_product->product->slug)}}">
                            <img src="{{ $basket_product->product->details->product_image !=null ? asset('uploads/urunler/' . $basket_product->product->details->product_image) : 'http://via.placeholder.com/120x100?text=UrunResmi' }}">
                        </a>
                    </td>
                    <td>
                        <a href="{{route('product.index',$basket_product->product->slug)}}">
                        {{$basket_product->product->product_name}}
                        </a>
                    </td>
                    <td>{{$basket_product->amount}}</td>
                    <td>{{$basket_product->piece}}</td>
                    <td>{{$basket_product->amount * $basket_product->piece}}</td>
                    <td>{{$basket_product->situation}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar</th>
                    <td colspan="2">{{$order->order_amount}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV' li)</th>
                    <td colspan="2">{{$order->order_amount * ((100+config('cart.tax'))/100 ) }} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Siparişin Durumu</th>
                    <td colspan="2">{{$order->status }} </td>
                </tr>

            </table>
        </div>
    </div>
@endsection
