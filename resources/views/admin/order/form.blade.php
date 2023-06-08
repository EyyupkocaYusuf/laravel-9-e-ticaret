@extends('admin.layouts.master')
@section('title', 'Sipariş Yönetimi')
@section('content')
    <h1 class="page-header">Sipariş Yönetimi</h1>

    <form method="post" action="{{ route('admin.order.save', $entry->id) }}" >
        @csrf

        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{ $entry->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h3 class="sub-header">
            Sipariş {{ $entry->id > 0 ? "Düzenle" : "Ekle" }}
        </h3>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name_surname">Ad Soyad</label>
                    <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Ad Soyad" value="{{ old('name_surname', $entry->name_surname) }}">
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="{{ old('phone', $entry->phone) }}">
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="mobile_phone">Telefon</label>
                    <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Cep Telefon" value="{{ old('mobile_phone', $entry->mobile_phone) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <<div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address', $entry->address) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select name="status" class="form-control" id="status" >
                        <option {{old('status',$entry->status)=='Siparişiniz Alındı'?'selected':''}}>Siparişiniz Alındı</option>
                        <option {{old('status',$entry->status)=='Ödeme Onaylandı'?'selected':''}}>Ödeme Onaylandı</option>
                        <option {{old('status',$entry->status)=='Kargoya Verildi '?'selected':''}}>Kargoya Verildi</option>
                        <option {{old('status',$entry->status)=='Sipariş Tamamlandı'?'selected':''}}>Sipariş Tamamlandı</option>

                    </select>
                </div>
            </div>
        </div>
    </form>
    <h2>Sipariş (SP-{{$entry->id}})</h2>
    <table class="table table-bordererd table-hover">
        <tr>
            <th>Ürün</th>
            <th>Ürün Adı</th>
            <th>Tutar</th>
            <th>Adet</th>
            <th>Ara Toplam</th>
            <th>Durum</th>
        </tr>
        @foreach($entry->basket->basket_products as $basket_product)
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
            <td colspan="2">{{$entry->order_amount}} ₺</td>
        </tr>
        <tr>
            <th colspan="4" class="text-right">Toplam Tutar (KDV' li)</th>
            <td colspan="2">{{$entry->order_amount * ((100+config('cart.tax'))/100 ) }} ₺</td>
        </tr>
        <tr>
            <th colspan="4" class="text-right">Siparişin Durumu</th>
            <td colspan="2">{{$entry->status }} </td>
        </tr>

    </table>
@endsection
