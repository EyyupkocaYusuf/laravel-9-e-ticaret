@extends('admin.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <h1 class="page-header">Kullanıcı Yönetimi</h1>
    <h1 class="sub-header">Kullanıcı Listesi</h1>
       <div class="well">
            <div class="btn-group pull-right" >
                <a href="{{route('admin.user.new')}}" class="btn btn-primary">Yeni</a>
            </div>
           <form method="post" action="{{route('admin.user.')}}" class="form-inline">
               @csrf
               <div class="form-group">
                   <label for="search">Ara</label>
                   <input name="wanted" type="text" class="form-control form-control-sm" id="wanted" placeholder="Ad , Email Ara" value="{{old('wanted')}}">
                   <button type="submit" class="btn btn-primary">Ara</button>
                   <a href="{{route('admin.user.')}}" class="btn btn-primary">Temizle</a>
               </div>
           </form>
       </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Ad Soyad</th>
                <th>Email</th>
                <th>Aktif Mi</th>
                <th>Yönetici Mi</th>
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
                <td>{{$entry->name_surname}}</td>
                <td>{{$entry->email}}</td>
                <td>
                    @if($entry->is_active)
                        <span class="label label-success">Aktif</span>
                    @else
                        <span class="label label-warning">Pasif</span>
                    @endif
                </td>
                <td>
                    @if($entry->is_admin)
                        <span class="label label-success">Yönetici</span>
                    @else
                        <span class="label label-warning">Müşteri</span>
                    @endif
                </td>
                <td>{{$entry->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('admin.user.update',$entry->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('admin.user.delete',$entry->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Emin misin?')">
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
