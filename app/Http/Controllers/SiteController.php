<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    function home(Request $request)
    {

        $search = $request->input('search');

        if (!empty($search)) {
            $all_blog = Blog::with('category.postCategory')
                ->where('blog_title', 'like', '%' . $search . '%')
                ->orWhere('details', 'like', '%' . $search . '%')
                ->get();

        } else {
            $all_blog = Blog::with('category.postCategory')->get();
        }
        return view('home', ['all_blog' => $all_blog]);

    }
    function About(){
        return view('about');
   }
    function Contact(){
        return view('contact');
   }
    function Details(Request $request){
        $id = $request->id;
        $blog_details = Blog::with(['comments'=>function($query){
            $query->select('id','post_id','user_id','parent_id','comment','created_at')
                ->with(['user'=>function($query){
                    $query->select('id','name');
                },'childComment'=>function($query){
                    $query->select('id','parent_id','comment','created_at','user_id')
                        ->with(['user'=>function($query){
                            $query->select('id','name');
                        }]);
                }]);
        }])->where('id', $id)->first();

        return view('details',['blog_details'=>$blog_details ]);
   }

   function Registation(){
    return view('registation');
   }

   function Login(){
    return view('login');
   }
   function Payment(){
    return view('payment');
   }

  

    public function orderProduct(Request $request,$id)
    {

        $placeOrder = ProductOffer::create([
            'product_id'=>$id,
            'quantity'=>$request->post('quantity'),
            'price'=>$request->post('quantity') * $request->post('offerPrice'),
            'address'=>$request->post('address'),
            'phone'=>$request->post('phoneNumber'),
            
            'orderId'=>$this->generateOrderId(),
        ]);

        $productDetails = Blog::where('id',$placeOrder->product_id)->first();

        if ($placeOrder){
            $this->sendEmail($request->post('email'),$placeOrder->phone,$productDetails,$request->post('quantity'),$placeOrder->price);
        }

        if ($placeOrder){
            return redirect()->back()->with(['success'=>'Product Ordered Successfully. Your order id is '.$placeOrder->orderId]);
        }
    }

    private function generateOrderId(){
        $timestamp = now()->format('ym');
        $randomString = Str::random(3);
        $orderId = $timestamp.'-'. $randomString;
        return $orderId;
    }

    public function sendEmail($email, $phone, $projectDetails, $qty, $price)
    {
        $defaultEmail = 'shakibahmedshakibahmed2@gmail.com';
        $defaultName = 'Ecommerce';

        // Ensure $projectDetails is not null and set default values if needed
        $productName = isset($projectDetails->blog_title) ? $projectDetails->blog_title : 'Unknown Product';
        $productDescription = !empty($projectDetails->details) ? $projectDetails->details : 'No Description';
        $productActualPrice = isset($projectDetails->product_actual_price) ? $projectDetails->product_actual_price : 0;

        Mail::send('orderConfirmation', [
            'company' => 'Company Name',
            'sendingInformation' => [
                'name' => !empty(Auth::user()->name) ? Auth::user()->name : 'Guest',
                'email' => $email,
                'phone' => $phone,
                'productName' => $productName,
                'productDescription' => $productDescription,
                'product_actual_price' => $productActualPrice,
                'qty' => $qty,
                'price' => $price,
                'defaultEmail' => $defaultEmail,
                'defaultName' => $defaultName
            ]
        ], function ($message) use ($defaultEmail, $defaultName, $email) {
            $message->to($email)->subject(__('Your Order Has Placed'))->from(
                $defaultEmail,
                $defaultName
            );
        });
    }


//    this is admin function

   function Admin_Home(){
    $all_blog = Blog::get();
    return view('admin.admin',['all_blog'=>$all_blog]);
   }

    function Add_blog()
    {
        $data['allCategories'] = Category::all();
        return view('admin.add_blog', $data);
    }
   function update_blog(Request $request){
    $all_blog = Blog::get();
    return view('admin.update_blog',['all_blog'=>$all_blog]);
   }


    public function showOrderDetails()
    {
        $data['allOrderDetails']= ProductOffer::with(['getProduct'])->orderBy('id','DESC')->get();

        return view('admin.order',$data);
   }

    public function removeOrder(Request $request)
    {
        $id = $request->input('id');

        $responce = ProductOffer::where('id', $id)->delete();

        if($responce == 1){
            return 1;
        }

   }

   function update_form_submit(Request $request){
    $id = $request->id;
    $blog_details = Blog::where('id', $id)->with(['category'])->first();
       $allCategories =Category::all() ;

    return view('admin.update_form',['blog_details'=>$blog_details,
        'allCategories'=>$allCategories
        ]);
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

    function add_blog_submit(Request $request)
    {
        $blog_title = $request->input('blog_title');
        $details = $request->input('details');
        $product_offer_price = $request->input('product_offer_price');
        $product_actual_price = $request->input('product_actual_price');

// start in blog image
        $blog_image = $request->file('blog_image')->store('/public/blog_image');

        $blog_image = (explode('/', $blog_image))[2];

        $host = $_SERVER['HTTP_HOST'];
        $blog_image = "http://" . $host . "/storage/blog_image/" . $blog_image;
// end in blog image

        $responce = Blog::create([
            'blog_title' => $blog_title,
            'details' => $details,
            'blog_image' => $blog_image,
            'product_offer_price' => $product_offer_price,
            'product_actual_price' => $product_actual_price,

        ]);

        if ($request->post('parentCategoryId')) {
            DB::table('post_categories')->insert([
                'post_id' => $responce->id,
                'category_id' => $request->post('parentCategoryId'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        if ($responce) {
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
    $blog_image=null;
    $blog = Blog::where('id',$blog_edit_id)->first();

// start in blog image
    if ($request->file('blog_image')){
        $blog_image =  $request->file('blog_image')->store('/public/blog_image');

        $blog_image=(explode('/',$blog_image))[2];

        $host=$_SERVER['HTTP_HOST'];
        $blog_image="http://".$host."/storage/blog_image/".$blog_image;
    }else{
        $blog_image =$blog->blog_image;
    }

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
