<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$user->name_surname}}. Kaydınız Başarılı Bir Şekilde Yapıldı.</p>
<p>Kaydınızı aktifleştirmek için <a href="{{ config('app.url') }}/kullanici/aktiflestir/{{ $user->activation_key }}">tıklayın</a> veya aşağıdaki bağlantıyı tarayıcınızda açın.</p>
<p>{{ config('app.url') }}/kullanici/aktiflestir/{{ $user->activation_key }}</p>
