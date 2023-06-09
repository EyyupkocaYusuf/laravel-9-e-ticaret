<div class="list-group">
    <a href="{{route('admin.home')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Giriş
    </a>
    <a href="{{route('admin.product.index')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Ürünler
        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_urun']}}</span>
    </a>
    <a href="{{route('admin.category.index')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Kategoriler
        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_kategori']}}</span>
    </a>
   <!-- <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse" data-parent="#sidebar"><span class="fa fa-fw fa-dashboard"></span>Ürün  Kategoriler<span class="caret arrow"></span></a>
    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div> -->
    <a href="{{route('admin.user.')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Kullanıcılar
        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['toplam_kullanici']}}</span>
    </a>
    <a href="{{route(('admin.order.index'))}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Siparişler
        <span class="badge badge-dark badge-pill pull-right">{{ $istatistikler['bekleyen_siparis']}}</span>
    </a>
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Ayarlar
        <span class="badge badge-dark badge-pill pull-right"></span>
    </a>
</div>
