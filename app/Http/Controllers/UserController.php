<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
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
    public function index()
    {
        return view('users.index')->with('users', DB::table('users')->orderBy('username')->get());
    }
    public function getID($username = '')
    {
        return ($username == '')?(Auth::user()->id):(DB::table('users')->where('username', $username)->value('id'));
        //Returns the userID corresponding to the supplied username, else returns the userID of the user making the request.
    }
    public function displayPosts($userID)
    {
        return DB::table('posts')->where('user_id', $userID)->orderBy('created_at')->paginate(5);
        //Returns all posts belonging to the user corresponding to $userID.
    }
    public function page($username)
    {
        return view('users.page')->with
            ([
                'posts' => displayPosts(getID($username)),
                'username' => $username
            ]);
        //Returns all posts belonging to the user corresponding to $username.
    }
    public function search($string)     //Returns all usernames prefixed by $string.
    {

    }
}
