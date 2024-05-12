<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    function home(){
        $all_blog = Blog::get();
        return view('home',['all_blog'=>$all_blog]);
   }
    function About(){
        return view('about');
   }
    function Contact(){
        return view('contact');
   }
    function Details(Request $request){
        $id = $request->id;
        $blog_details = Blog::where('id', $id)->first();
        return view('details',['blog_details'=>$blog_details ]);
   }

   function Registation(){
    return view('registation');
   }

   function Login(){
    return view('login');
   }

//    this is admin function

   function Admin_Home(){
    $all_blog = Blog::get();
    return view('admin.admin',['all_blog'=>$all_blog]);
   }

   function Add_blog(){
    return view('admin.add_blog');
   }
   function update_blog(Request $request){
    $all_blog = Blog::get();
    return view('admin.update_blog',['all_blog'=>$all_blog]);
   }
   function update_form_submit(Request $request){
    $id = $request->id;
    $blog_details = Blog::where('id', $id)->first();
    return view('admin.update_form',['blog_details'=>$blog_details]);
   }

//    admin registation
   function admin_registaion(Request $request){
    $admin_name = $request->input('admin_name');
    $admin_email = $request->input('admin_email');
    $admin_password = $request->input('admin_password');

        // Validate password strength start
        $uppercase = preg_match('@[A-Z]@', $admin_password);
        $lowercase = preg_match('@[a-z]@', $admin_password);
        $number    = preg_match('@[0-9]@', $admin_password);
        $specialChars = preg_match('@[^\w]@', $admin_password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($admin_password) < 8){
            return "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
           // Validate password strength end

           $admin_password = md5($admin_password);

           $already_have_email = Admin::where('email', $admin_email)->count();
           $name = Admin::where('name', $admin_name)->count();


           if($name){
            return "Alreday have this Name";
            }


        if($already_have_email){
            return "Already have this Email";
        }

        if(filter_var($admin_email, FILTER_VALIDATE_EMAIL) == false){
            return "Please Enter Valid Email";
        }

        $responce = Admin::insert([
            'name' => $admin_name,
            'email' => $admin_email,
            'password' => $admin_password,

        ]);

        if($responce == 1){
            return 1;
        }


   }

   function admin_login(Request $request){
    $admin_email_login = $request->input('admin_email_login');
    $admin_password_login = $request->input('admin_password_login');

    $admin_password_login = md5($admin_password_login);

    $responce = Admin::where('email', $admin_email_login)->where('password', $admin_password_login)->count();
    if($responce == 1){
        cookie::queue('admin',$admin_email_login, 1296000 );
         return 1;

     }



   }

   function admin_logout(){
    cookie::queue(cookie::forget('admin'));
    return 1;
   }


//  add blog

function add_blog_submit(Request $request){
    $blog_title = $request->input('blog_title');
    $details = $request->input('details');

// start in blog image
    $blog_image =  $request->file('blog_image')->store('/public/blog_image');

       $blog_image=(explode('/',$blog_image))[2];

       $host=$_SERVER['HTTP_HOST'];
       $blog_image="http://".$host."/storage/blog_image/".$blog_image;
// end in blog image

    $responce = Blog::insert([
         'blog_title' => $blog_title,
         'details' => $details,
         'blog_image' => $blog_image,

     ]);

     if($responce == 1){
         return 1;
     }

}

function remove_blog(Request $request){
    $id = $request->input('id');

    $responce = Blog::where('id', $id)->delete();

     if($responce == 1){
         return 1;
     }
}

function update_blog_submit_form(Request $request){
    $blog_title = $request->input('blog_title');
    $details = $request->input('details');
    $blog_edit_id = $request->input('blog_edit_id');


// start in blog image
    $blog_image =  $request->file('blog_image')->store('/public/blog_image');

       $blog_image=(explode('/',$blog_image))[2];

       $host=$_SERVER['HTTP_HOST'];
       $blog_image="http://".$host."/storage/blog_image/".$blog_image;
// end in blog image

$responce = Blog::where('id',$blog_edit_id)->update([
    'blog_title' => $blog_title,
    'details' => $details,
    'blog_image' => $blog_image,
]);

if($responce == 1){
    return 1;
}


}

}
