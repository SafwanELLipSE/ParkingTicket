<?php

namespace App\Http\Controllers;

use App\Ticket_user;
use App\Parking_location;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\sendOtpNotification;
use Nexmo\Laravel\Facade\Nexmo;


class ParkTicketController extends Controller
{
    public function index()
    {
       $users = Ticket_user::all();
       $getParkingLocation = Ticket_user::pluck('parking_location');
       $parking_areas = Parking_location::whereNotIn('id',$getParkingLocation)->get();
       return view('crud',[
            'users' => $users,
            'parking_areas' => $parking_areas,
       ]);
    }
    public function createTicket(Request $request)
    {
          $validator = Validator::make($request->all(), [
                'name'   => 'required|min:3',
                'mobile' => 'required',
                'car_number' => 'required',
                'parking_location' => 'required',
                'time' => 'required',
                'cost' => 'required',
          ]);

          if ($validator->fails()){
              alert()->warning('Error occured',$validator->errors()->all()[0]);
              return redirect()->back()->withInput()->withErrors($validator);
          }
          else
          {
              $user_otp = rand(100000, 999999);

              $hours = $request->post('time');
              $cost = $request->post('cost');
              $user = new Ticket_user();
              $user->name = $request->post('name');
              $user->car_number = $request->post('car_number');
              $user->parking_location = $request->post('parking_location');
              $user->mobile = $request->post('mobile');
              $user->otp = $user_otp;
              $user->status = 0;
              $user->time = $hours;
              $user->total_cost = $hours*$cost;
              $user->save();

              $basic  = new \Nexmo\Client\Credentials\Basic('f8935336', 'VAp5TjNghDQBdZ5e');
              $client = new \Nexmo\Client($basic);

              $message = $client->message()->send([
                  'to' => $request->post('mobile'),
                  'from' => 'Vonage APIs',
                  'text' => 'Car Number: '. $request->post('car_number') .
                  ', Your Validation Code: '.$user_otp. ', Parking Location: '. $user->park->name
                  .', Your Total Price: '.$hours*$cost
              ]);


              Alert::success('Success', 'Successfully Created A Ticket');
              return redirect()->route('home');
          }
    }
    public function addParkingLocation(Request $request)
    {
          $validator = Validator::make($request->all(),[
                'name'   => 'required|min:3',
          ]);

          if ($validator->fails()){
              alert()->warning('Error occured',$validator->errors()->all()[0]);
              return redirect()->back()->withInput()->withErrors($validator);
          }
          else
          {
              $parking = new Parking_location();
              $parking->name = $request->post('name');
              $parking->save();

              Alert::success('Success', 'Successfully Created A Parking Location');
              return redirect()->route('home');
          }
    }
    public function approveTicket(Request $request)
    {
          $validator = Validator::make($request->all(),[
                'otp_number'   => 'required|min:5',
          ]);

          if ($validator->fails()){
              alert()->warning('Error occured',$validator->errors()->all()[0]);
              return redirect()->back()->withInput()->withErrors($validator);
          }

          $userID = $request->post('user_id');
          $user = Ticket_user::find($userID);
          $otpUser = $user->otp;

          if($request->post('otp_number') == $user->otp)
          {
              $user->status = 1;
              $user->save();
              Alert::success('Success', 'Match the Current Otp');
              return redirect()->route('home');
          }
          else
          {
              Alert::warning('Error occured', 'The Current Otp didnot Match');
              return redirect()->route('home');
          }
    }
    public function deleteTicket(Request $request)
    {
        $userID = $request->post('user_id');
        $delete_user = Ticket_user::where('id',$userID)->delete();

        Alert::success('Success', 'Successfully Removed');
        return redirect()->route('home');
    }
}
