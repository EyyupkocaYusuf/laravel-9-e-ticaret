<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validate = Validator::make($request->post(),$rules);
            if($validate->fails())
            {
                return redirect()->route('users.register')->withErrors($validate)->withInput();
            }
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'is_admin'=> 1,
                'is_active'=>1,
            ];
            if(Auth::guard('administrator')->attempt($credentials,$request->has('meremember')))
            {
                return redirect()->route('admin.home')->with('success','Giriş Başarılı');
            }
            else{
                return back()->withInput()->withErrors(['email' => 'Giriş Hatalı!']);
            }
        }
        return view('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('administrator')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        toastr()->success('Çıkış Yapıldı', 'Success');
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $list = User::orderByDesc('created_at')->paginate(8);
        return view('admin.User.index',compact('list'));
    }

    public function form($id = 0)
    {
        $entry= new User;
        if($id>0)
        {
            $entry=User::find($id);
        }
        return view('admin.User.form',compact('entry'));
    }

    public function save($id = 0)
    {
        $this->validate(request(),[
           'name_surname'=>'required',
            'email'=>'required|email'
        ]);
        $data = request()->only('name_surname','email');
        if(request()->filled('password'))
        {
            $data['password'] = Hash::make(request('password'));
        }
        $data['is_active'] = request()->has('is_active') && request('is_active') ? 1:0;
        $data['is_admin'] = request()->has('is_admin') && request('is_admin')? 1:0;
        if ($id>0)
        {
            $entry = User::where('id',$id)->firstOrFail();
            $entry->update($data);
        }
        else
        {
            $entry = User::create($data);
        }
        User_Detail::updateOrCreate(
            ['user_id'=>$entry->id],
            [
                'address'=>request('address'),
                'phone'=>request('phone'),
                'mobile_phone'=>request('mobile_phone')

            ]
        );
        return redirect()
            ->route('admin.user.update',$entry->id)
            ->with('success',($id>0?'Güncellendi':'kaydedildi'));
    }
    public function delete($id)
    {
        User::destroy($id);
        return redirect()
            ->route('admin.user.')
            ->with('success','Kayıt silindi');
    }
}
