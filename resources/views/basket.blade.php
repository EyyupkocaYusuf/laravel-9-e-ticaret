@extends('layouts.master')
@section('title','Sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet fiyatı</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $productCartItem)

                <tr>
                    <td> <img src="https://picsum.photos/150/150"></td>
                    <td>
                        <a href="{{route('product.index',$productCartItem->options->slug)}}">
                            {{$productCartItem->name}}
                        </a>
                        <form action="{{route('basket.remove',$productCartItem->rowId)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır">
                        </form>
                    </td>
                    <td>{{$productCartItem->price}} £</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default">-</a>
                        <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>
                        <a href="#" class="btn btn-xs btn-default">+</a>
                    </td>
                    <td class="text-right">
                        {{$productCartItem->subtotal}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt toplam</th>
                    <td class="text-right">{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <td class="text-right">{{\Gloudemans\Shoppingcart\Facades\Cart::tax() }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam</th>
                    <td class="text-right">{{\Gloudemans\Shoppingcart\Facades\Cart::total() }}</td>
                </tr>
            </table>
                <div>
                    <a href="#" class="btn btn-info pull-left">Sepeti Boşalt</a>
                    <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>
            @else
                <p>Sepetinizde ürün yok !</p>
            @endif
        </div>
    </div>
@endsection
