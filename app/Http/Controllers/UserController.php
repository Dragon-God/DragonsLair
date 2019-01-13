<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $username = DB::table('users')->where('email', Auth::user()->email)->value('username');     //Extracts the username of the currently logged in user.
        return view('home.dashboard')->with(['username' => $username, 'foo' => Auth::user()->email]);
    }
    public function register(Request $request)
    {
        /* $user = new User();
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->password = bcrypt($request['password']);
        $user->save(); */
        $this->validate($request,
        [
            'email' => 'required|email|unique:users|max:250',
            'username' => 'required|unique:users|max:80',
            'password' => 'required|max:250|min:8'
        ]);
        $data = ['email' => $request['email'], 'username' => $request['username'], 'password' => bcrypt($request['password'])];
        $user = new User($data);
        if($user->save())
        {
            Auth::login($user);
            return redirect()->route('registrationSuccess');
        }
        else
        {
            return redirect()->route('welcome');
        }
    }
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|max:250',
                'password' => 'required|max:250'
            ]
        );
        return Auth::attempt(['email' => $request['email'], 'password' => $request['password']])?(redirect()->route('dashboard')):(redirect()->route('incorrectCredentials'));
        /* return Auth::attempt()?(redirect()->route('dashboard')):(function(){
            print('<br>The email address or password or incorrect.<br>');
            return redirect()->back();
        }); */
    }
}
