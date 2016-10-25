<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Soc_users;
use Validator;
use Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use App\Events;
use App\Tours;
use App\Tour_reviews;
use App\Event_reviews;
use App;
use Carbon\Carbon;
use Auth;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','redirectToProvider','handleProviderCallback','authVK']]);
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToProvider(Request $request)
    {

        $red = "http://geotourist.ge/". App::getLocale() ."/callback/";
        //$red = "http://leri.com:8000/". App::getLocale() ."/callback/";

        $request->session()->put('services.facebook.redirect', $red);

        config(["services.facebook.redirect" => $red]);

        return Socialite::with('facebook')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {

        config(["services.facebook.redirect" => session('services.facebook.redirect')]);

        $user = Socialite::with('facebook')->user();
          
        $soc_user = Soc_users::create([
            "user_id" => $user->id, "name" => $user->name,"email" => $user->email,
            "avatar" => $user->avatar,  "password" => $user->token
        ]);

        $request->session()->put('user', $soc_user);
        $request->session()->put('soc_type', "fb");

        $rate = session("rate");
        $id = session("data_id");
        $comment = session("comment");
        $belong = session("bel_to");

        $request->session()->forget('rate');
        $request->session()->forget('data_id');
        $request->session()->forget('comment');
        $request->session()->forget('bel_to');

        if($belong == "tour")
        {
            $tour = Tours::findOrFail($id);
            $rew = Tour_reviews::create([
                "tour_id" => $tour->id,
                "user_id" => $soc_user->id,
                "rate" => $rate,
                "comment" => $comment,
                "time_added" => Carbon::now()
            ]);

            return redirect()->action('ToursController@show', ["id" => $tour->id]);
        }

        elseif($belong == "event")
        {
            $event = Events::findOrFail($id);
            $rew = Event_reviews::create([
                "event_id" => $event->id,
                "user_id" => $soc_user->id,
                "rate" => $rate,
                "comment" => $comment,
                "time_added" => Carbon::now()
            ]);

            return redirect()->action('EventsController@show', ["id" => $event->id]);
        }
    }



    public function handleComment(Request $request)
    {
        if ($request->session()->has('user') and $request->session()->has('soc_type')) {
            if(session("soc_type") == "fb")
            {
               $belong = $request->bel_to;
                $user = session("user");
                if($belong == "tour")
                {
                    $tour = Tours::findOrFail($request->data_id);
                    $rew = Tour_reviews::create([
                        "tour_id" => $tour->id,
                        "user_id" => $user->id,
                        "rate" => $request->user_rate,
                        "comment" => $request->user_comment,
                        "time_added" => Carbon::now()
                    ]);
                    return response()->json(["add" => 1]);
                    //return redirect()->action('ToursController@show', ["id" => $tour->id]);
                }
                elseif($belong == "event")
                {
                    $event = Events::findOrFail($request->data_id);
                    $rew = Event_reviews::create([
                        "event_id" => $event->id,
                        "user_id" => $user->id,
                        "rate" => $request->user_rate,
                        "comment" => $request->user_comment,
                        "time_added" => Carbon::now()
                    ]);
                    return response()->json(["add" => 1]);
                    //return redirect()->action('EventsController@show', ["id" => $event->id]);
                }
            }
            elseif(session("soc_type") == "vk")
            {
                $belong = $request->bel_to;
                $user = session("user");
                if($belong == "tour")
                {
                    $tour = Tours::findOrFail($request->data_id);
                    $rew = Tour_reviews::create([
                        "tour_id" => $tour->id,
                        "user_id" => $user->id,
                        "rate" => $request->user_rate,
                        "comment" => $request->user_comment,
                        "time_added" => Carbon::now()
                    ]);
                    return response()->json(["add" => 1]);
                    //return redirect()->action('ToursController@show', ["id" => $tour->id]);
                }
                elseif($belong == "event")
                {
                    $event = Events::findOrFail($request->data_id);
                    $rew = Event_reviews::create([
                        "event_id" => $event->id,
                        "user_id" => $user->id,
                        "rate" => $request->user_rate,
                        "comment" => $request->user_comment,
                        "time_added" => Carbon::now()
                    ]);
                    return response()->json(["add" => 1]);
                    //return redirect()->action('EventsController@show', ["id" => $event->id]);
                }
            }
        }

       else{
           session([
               'rate' => $request->user_rate,
               "comment" => $request->user_comment,
               "bel_to" => $request->bel_to,
               "data_id" => $request->data_id
           ]);
       }
        /*
        $validator = Validator::make($request->all(), [
            'user_rate' => 'required|integer|between:1,5',
            'user_comment' => 'required',
        ], [
            "user_rate.integer" => trans('errors.rate-required'),
            "user_rate.between" => trans('errors.rate-required'),
            "user_rate.required" => trans('errors.rate-required'),
            "user_comment.required" => trans('errors.com-required'),

        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        session([
            'rate' => $request->user_rate,
            "comment" => $request->user_comment,
            "bel_to" => $request->bel_to,
            "data_id" => $request->data_id
        ]);

        return view("auth.soc_login");
        */
    }


    public function authVK(Request $request)
    {
     
        $token = json_decode(file_get_contents("https://oauth.vk.com/access_token?client_id=5304987&client_secret=tzHfCb5GCvOFbAqIECkX&redirect_uri=http://geotourist.ge/".App::getLocale()."/vk-callback&code=".$request->code), true);

        if (isset($token['access_token'])) {
            $params = array(
                'uids'         => $token['user_id'],
                'fields'       => 'uid,first_name,last_name,screen_name,photo,photo_rec,hash',
                'access_token' => $token['access_token']
            );

            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

            if(isset($userInfo["response"][0]))
            {
                $user = $userInfo["response"][0];

                $soc_user = Soc_users::create([
                    "user_id" => $user["uid"], "name" => $user["first_name"] ." ". $user["last_name"] ,"email" => "",
                    "avatar" => $user["photo"],  "password" => ""
                ]);
                
                $rate = session("rate");
                $id = session("data_id");
                $comment = session("comment");
                $belong = session("bel_to");

                $request->session()->put('user', $soc_user);
                $request->session()->put('soc_type', "vk");

                $request->session()->forget('rate');
                $request->session()->forget('data_id');
                $request->session()->forget('comment');
                $request->session()->forget('bel_to');

                if($belong == "tour")
                {
                    $tour = Tours::findOrFail($id);
                    $rew = Tour_reviews::create([
                        "tour_id" => $tour->id,
                        "user_id" => $soc_user->id,
                        "rate" => $rate,
                        "comment" => $comment,
                        "time_added" => Carbon::now()
                    ]);

                    return redirect()->action('ToursController@show', ["id" => $tour->id]);
                }

                elseif($belong == "event")
                {
                    $event = Events::findOrFail($id);
                    $rew = Event_reviews::create([
                        "event_id" => $event->id,
                        "user_id" => $soc_user->id,
                        "rate" => $rate,
                        "comment" => $comment,
                        "time_added" => Carbon::now()
                    ]);

                    return redirect()->action('EventsController@show', ["id" => $event->id]);
                }
            }


        }
    }

}