<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use App\Http\Controllers\Controller;
use App\Models\FlightBookingTravelsInfo;

class HomeController extends Controller
{
    public function index()
    {
        $title ="Dashboard";
        $titles = [
            'title' => "Dashboard",
            //'subTitle' => "Add offer",
        ];//dd(auth()->user()->hasRole('admin'));
        //auth()->user()->givePermissionsTo('role-view');
         //dd(auth()->user());
        if (!auth()->user()->can('dashboard-view')) {
            return view('admin.abort',compact('titles'));
        }
        
        // $appCustomers = User::whereUserType("app")->whereBackEndUser(0)->count();
        // $webCustomers = User::whereUserType("web")->whereBackEndUser(0)->count();
        // $guestCustomers = GuestUser::count();
        // $totalCustomers = ($appCustomers + $webCustomers + $guestCustomers);

        // $totalBookings = $confirmedBookings =FlightBooking::whereIn('booking_status',['booking_completed','payment_successful'])->count();

        // $websales = FlightBooking::whereIn('booking_status',['booking_completed','payment_successful'])->whereIn('user_type',['web','web_guest'])->sum('total_amount');
        // $appsales = FlightBooking::whereIn('booking_status',['booking_completed','payment_successful'])->whereIn('user_type',['app','app_guest'])->sum('total_amount');
        // $totalSales = ($websales+ $appsales);

        // // $bookings = FlightBooking::with('User')->whereIn('booking_status',['booking_completed','payment_successful','payment_failure','payment_exipre','travelport_failure'])->orderBy('id')->get();

        // if (!auth()->user()->can('booking-view')) {
        //     $bookings = [];
        // }
        // else{
        //     $bookings = FlightBooking::with('TravelersInfo','Customercountry')->whereDate('created_at', '=', date('Y-m-d'))->orderBy('id','DESC')->get();
        // }

        $categoryActiveCount = count(Category::where('status' , 'Active')->get());
        $categoryInActiveCount = count(Category::where('status' , 'InActive')->get());
        $categoryCount = $categoryActiveCount + $categoryInActiveCount;

       


        $dashboardDetails = array(
            'categoryActiveCount' => $categoryActiveCount,
            'categoryInActiveCount' => $categoryInActiveCount,
            'categoryCount' => $categoryCount,
            'totalCustomers' => 0,
            'totalBookings' => 0,
            'confirmedBookings' => 0,
            'canceled' => 0,
            'websales' => 0,
            'appsales' => 0,
            'totalSales' => 0,
            'bookings' => []
        );



        
        return view('admin.dashboard',compact('title','dashboardDetails'));
    }


   
}
