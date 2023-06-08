@extends('admin.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')
    <h1 class="page-header">Sipariş Yönetimi</h1>
    <h1 class="sub-header">Sipariş Listesi</h1>
    <div class="well">
        <form method="post" action="{{route('admin.order.index')}}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search">Ara</label>
                <input name="wanted" type="text" class="form-control form-control-sm" id="wanted" placeholder="Siparis Ara" value="{{old('wanted')}}">
                <button type="submit" class="btn btn-primary">Ara</button>
                <a href="{{route('admin.order.index')}}" class="btn btn-primary">Temizle</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Sipariş Kodu</th>
                <th>Kullanıcı</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th>Sipariş Tarihi</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($list) == 0)
                <tr><td colspan="6" class="text-center">Kayıt bulunamadı!</td></tr>
            @endif
            @foreach($list as $entry)
                <tr>
                    <td>SP-{{$entry->id}}</td>
                    <td>{{$entry->basket->User->id}}</td>
                    <td>{{$entry->order_amount * ((100+config('cart_tax')) / 100 ) }}</td>
                    <td>{{$entry->status}}</td>
                    <td>{{$entry->created_at}}</td>
                    <td style="width: 100px">
                        <a href="{{route('admin.order.edit',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{route('admin.order.delete',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
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
