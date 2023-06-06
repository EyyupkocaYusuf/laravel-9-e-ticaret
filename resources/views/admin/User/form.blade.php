@extends('admin.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')
    <h1 class="page-header">Kullanıcı Yönetimi</h1>
    <form method="post" action="{{route('admin.user.save',@$entry->id)}}">
       @csrf
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                {{@$entry->id > 0 ? "Güncelle" : "Kaydet" }}
            </button>
        </div>
        <h2 class="sub-header">
            Kullanıcı {{@$entry->id >0 ? "Düzenle":"Ekle"}}
        </h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name_surname">Ad Soyad</label>
                    <input type="text" class="form-control" id="name_surname" placeholder="Name Surname" name="name_surname" value="{{old('name_surname',$entry->name_surname)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email',$entry->email)}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" id="address" placeholder="Address"  name="address" value="{{old('address',$entry->detail->address)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone"  name="phone" value="{{old('phone',$entry->detail->phone)}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mobile_phone">Cep Telefonu</label>
                    <input type="text" class="form-control" id="mobile_phone" placeholder="Mobile Phone"  name="mobile_phone" value="{{old('mobile_phone',$entry->detail->mobile_phone)}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active"{{old('is_active',$entry->is_active) ? "checked":""}}> Aktif Mi
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" name="is_admin" {{old('is_admin',$entry->is_admin )? "checked":""}}> Yönetici Mi
            </label>
        </div>
    </form>
@endsection
