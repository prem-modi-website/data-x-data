<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Package;


class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::where('is_active',1)->get();
        $packages = Package::where('is_active',1)->get();
        return view('frontend.index',compact('categories','packages'));
        
    }
    public function about()
    {
        return view('frontend.about');
        
    }
    public function completeOrder()
    {
        return view('frontend.order_complete');
        
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function privacyPolicy()
    {
        return view('frontend.privacy_policy');
    }
    public function termAndCondition()
    {
        return view('frontend.terms_condition');
    }
    public function packages()
    {
        
        $packages = Package::where('is_active',1)->get();
    
        return view('frontend.packages',compact('packages'));
    }
    public function getCategory()
    {
        $categories = Category::where('is_active',1)->get();

        return view('frontend.category',compact('categories'));
    }
}
