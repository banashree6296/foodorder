<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\view;
use Illuminate\Support\Facades\DB;

class formController extends Controller
{
    public function form_page():View{
        return view('form');
    }
    // submit
    public function submit_page(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required'
        ]);

        $name=$request->input('name');
        // dd($name);
        $description=$request->input('description');
        // dd($description);
        $price=$request->input('price');
        // dd($price);
        $image=$request->file('image');
        // dd($image);
        $fileName=time()."_".$image->getClientOriginalName();
        // dd($fileName);
        $location='upload';
        $image->move($location,$fileName);


        $affected_row=DB::table('food')->insert(['name'=>$name,
        'description'=>$description,
        'price'=>$price,
        'image'=>$fileName
    
    ]);

    if($affected_row){
        return view('form')->with(['message'=>'successfully submitted']);
        // return redirect('/getall')->with(['message'=>'successfully updated']);
    }else{
        return view('form')->with(['message'=>'not submitted']);
        // return redirect('/getall')->with('message','successfully updated');   
     }
    }
    //new food
    public function new_food_data(Request $request){
        $name=$request->input('food_name');
        // dd($name);
        $description=$request->input('food_desc');
        // dd($description);
        $price=$request->input('food_price');
        // dd($price);
        $image=$request->file('food_image');
        // dd($image);
        $fileName=time()."_".$image->getClientOriginalName();
        // dd($fileName);
        $location='upload';
        $image->move($location,$fileName);


        $affected_row=DB::table('food')->insert(['food_name'=>$name,
        'food_desc'=>$description,
        'food_price'=>$price,
        'food_image'=>$fileName
    
    ]);

    if($affected_row){
        return response()->json(['message'=>'successfully added']);
    }else{
        return response()->json(['message'=>'not added']);  
     }
    }
    //fetch data

    public function fetch_data(){

        $alldata=DB::table('food')->get();
        // dd($alldata);
        // return view('index')->with(['details'=>$alldata]);
        return response()->json($alldata);
    }
    

    
// Geeting Particular Food item :
    // public function edit_data($id){
    //     $edit_id=$id;
    //     $edit_data=DB::table('food')->where('id',$edit_id)->get();
    //     // dd($edit_data);
    //     return view('edit')->with(['edit_details'=>$edit_data[0]]);
    // }
    // update
    public function update_page(Request $request, $id){
        // dd($request->all());
        $name=$request->input('food_name');
        $price=$request->input('food_price');
        $description=$request->input('food_desc');
        // $update_id=$request->input('hidden_id');
        $update_id=$id;
        // dd($update_id);
        $image=$request->file('food_image');
        if($image!=''){
            $fileName=time()."_".$image->getClientOriginalName();
            $location="upload";
            $image->move($location,$fileName);
            $affected_row=DB::table('food')->where('_id',$id)->update(['food_name'=>$name,'food_price'=>$price,'food_desc'=>$description,'food_image'=>$fileName]);
        }else{
            $affected_row=DB::table('food')->where('_id',$id)->update(['food_name'=>$name,'food_price'=>$price,'food_desc'=>$description]);
        }
        // return response()->json(['message'=>$name]);

        if($affected_row){
            // return redirect('/getall')->with(['message'=>'successfully updated']);
            return response()->json(['message'=>'successfully Updated']);
  }else{
    // return redirect('/getall')->with('message','successfully updated');
    return response()->json(['message'=> 'not updated']);
        }


    }

    //delete
    public function delete_data($id){
        $user_id=$id;
       $image_row= DB::table('food')->where('_id', $user_id)->get();
     //  dd($image_row);
       $image_name=$image_row[0]->food_image;
       //dd($image_name);
       $affected_row= DB::table('food')->where('_id',$user_id)->delete();
       if($affected_row){
        unlink('upload/'.$image_name);
        // return redirect('/getall')->with('message','successfully deleted');
        return response()->json(['message'=>'Successfully deleted']);
       }else{
        // return redirect('/getall')->with('message','not deleted');
        return response()->json(['message'=>'Not deleted']);
       }

}
    


    
//signup
    public function signup_page(){
        return view('signup');
    }

    // signup submit
    public function form_submit_page(Request $request){
        // dd($request->all());
        $name=$request->input('name');
        $phone=$request->input('phone');
        $email=$request->input('email');
        $password=$request->input('pass1');
       
        $affected_row= DB::table('student')->insert(['name'=>$name,
               'phone'=>$phone,
               'email'=>$email,
               'password'=>$password,
               
                  ]);
        if($affected_row){
            return response()->json(['message'=>'successfully registered']);

        }else{
            return response()->with(['message'=>'Not registered']);
        }
    }


    public function search_food($lim1,$lim2){
       $data=DB::table('food')->whereBetween('food_price',[$lim1,$lim2])->get();
       return response()->json($data);
        
    }

    // public function login_page(){

    //     return view('signin');   //signin.blade.php
    //   }
  
      public function login_data(Request $request){
       //dd($request->all());
  
      $user_name= $request->input('email');
      $user_password= $request->input('pass1');
      $data=DB::table('student')->where('email',$user_name)->orWhere('phone',$user_name)->get();
  
  //dd($data);
  if(empty($data[0])){
    // return redirect('/login')->with('message','user not exist');
    return response()->json(['message'=>'user not exist']);
  }else{
  
  $db_password=$data[0]->password;
  $db_email=$data[0]->email;
  $db_role=$data[0]->role;

  //$output_verify=password_verify($user_password,$db_password);
  //dd($output_verify);
  //$output_verify=($db_password===$user_password);
  //return response()->json(['message'=>'Successfully login']);
  if($db_password==$user_password){  
    
    // $request->session()->put('login_user',$data[0]->name);
    // $request->session()->put('login_id',$data[0]->id);
  
    // $request->session()->put('login_ip',$_SERVER['REMOTE_ADDR']);
    // date_default_timezone_set('Asia/Kolkata');
    // $request->session()->put('login_time',date('d-m-y h:i:sA'));
    return response()->json(['message'=>'Successfully login','activeUser'=>$db_email,'role'=>$db_role]);
    //return redirect('/getall');
  }else{
    // return redirect('/login')->with('message','password not matched');
    return response()->json(['message'=>'password not matched']);
  }
  }
      }
  
  
  
//       public function logout_page(Request $request){
//   $request->session()->forget('login_user');
//   $request->session()->flush();
//   return redirect('/login');
//       }
 
  
    public function newfood_data(Request $request){

    $name=$request->input('food_name');
    $description=$request->input('food_desc');
    $price=$request->input('food_price');
    // $image=$request->input('image');
    $image=$request->file('food_image');
        //dd($image);

        $fileName=time()."_".$image->getClientOriginalName();
        //dd($fileName);
        $location='upload';
        $image->move($location,$fileName);
$affected_rows=DB::table('food')->insert(['food_name'=>$name,'food_desc'=>$description,'food_price'=>$price,'food_image'=>$fileName]);
// return response()->json($name);

if($affected_rows){
return response()->json(['message'=>'successfully added']);
}
else{
return response()->json(['message'=>'not added']);
}


}

    
    }

