<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image as Image;

use App\User;
use Illuminate\Support\Facades\Hash;




class ProfileController extends Controller
{
public function index()
{
    return view('profile.prof');
}

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->with('error', sprintf('Please fill in all fields.'));
        }

        $user = \Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $file=$request->image;

        if($request->password!=null)
        {
            $validator = Validator::make($request->all(), [
                'password' => 'confirmed'
            ]);
            if ($validator->fails()) {

                return redirect()->back()->with('error', sprintf('Wrong password confirmation.'));
            }

            $user->password=bcrypt($request->password);
        }
        // if(isset($request->image))
        // {
        //     $file=$request->image;
        //     $file->move(public_path(), $file);
        //    // ->store('toPath', ['disk' => 'public']);

        //     $user->photo=$request->image;
        // }


        if (Input::hasFile('image')) {//lexoj imazhin
            list($width, $height) = getimagesize($file);
            $extension = $file->getClientOriginalExtension();//png or jpg
            $final_filename = $file->getFilename() . '.' . $extension;
            Storage::disk('public')->put($final_filename, File::get($file));//e ruan ne nje disk ,i cili eshte i aksesueshem nga te gjithe



            //banner_real
            $thumbs_real = Image::make($file->getRealPath());
            $thumbs_real->save(storage_path('app/public') . '/' . $final_filename, 80);//80-size

            $user->photo = $final_filename;

        }



        if ($user->save()) {
            return redirect()->back()->with('success', sprintf('You profile was saved successfully'));
        } else {
            return redirect()->back()->with('error', sprintf('An error has ocurred. Please try again later'));
        }
    }




    public function create()
    {
        return view('profile.change_password');
    }


    public function change_password(Request$request)
{
    $validator = Validator::make($request->all(),
        [
            'password' => 'confirmed',
            'old_password' => 'required',
        ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->with('error', sprintf( $validator->errors()->all()[0]));
    }

        $user = User::find(Auth::user()->id);
        $oldPassword  = $request->old_password;
        $newPassword = $request->password;


        $hashedPassword = $user->password;

        if (Hash::check($oldPassword, $hashedPassword))
        {
            $user->password = Hash::make($newPassword);
        }
        else
        {
            return redirect()->back()->with('warning', sprintf('Please enter correct your old password'));
        }

        if($user->save())
        {

            return redirect()->back()->with('success', sprintf('Password changed sucessfully.'));
        }
        else
        {
            return redirect()->back()->with('error', sprintf('An error has ocurred. Please try again later'));
        }




    }


}
