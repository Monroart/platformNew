<?php

namespace App\Http\Controllers\Profile;

use App\Models\Course;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController
{
    private $nice_extenstions = [
        'jpg', 'jpeg', 'png', 'gif'
    ];

    public function changeImage(Request $request){
        if($request->input('user_id')!=null)
            $user = User::find($request->input('user_id'));
        else
            $user = $request->user();
        $file = $request->image;
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, $this->nice_extenstions)) {
            return [
                'status' => 'error',
                'message' => 'wrong file extension - ' . $extension
            ];
        }
        $extension = ($extension == 'jpg' ? 'jpeg' : $extension);
        $func_name = 'imagecreatefrom' . $extension;
        $func_image = 'image' . $extension;
        $image = $func_name($file);
        $size = min(imagesx($image), imagesy($image));
        $image = imagecrop($image, ['x' => (imagesx($image) - $size) / 2, 'y' => (imagesy($image) - $size) / 2,
            'width' => $size, 'height' => $size]);
        $func_image($image, fopen($file, 'w'));
//        Storage::put('public/profile_images', $image);
        $path = $file->store('public/profile_images');
        $profile = Profile::where('user_id',$user->id)->first();
        $path = "storage/".$path;
        $path = str_replace('/public','', $path);
        $profile->profile_image = $path;
        $profile->save();
        return [
            'status' => 'ok',
            'url' => $path
        ];
    }

        public function getImage(Request $request){
        if($request->input('user_id')!=null)
            $user = User::find($request->input('user_id'));
        else
            $user = $request->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $pathImage = $profile->profile_image;
        return[
            'path_to_image' => $pathImage,
            'status' => 'ok'];
    }

    public function deleteImage(Request $request){
        if($request->input('user_id')!=null)
            $user = User::find($request->input('user_id'));
        else
            $user = $request->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $profile->profile_image = null;
        $profile->save();
        return[
            'status' => 'ok'
        ];
    }

    public function saveInfo(Request $request){
        if($request->input('user_id')!=null)
            $user = User::find($request->input('user_id'));
        else
            $user = $request->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $name = $request->input('name');
        $phone = $request->input('phone');
        $about = $request->input('about');
        $age = $request->input('age');
        $location = $request->input('location');
        $education = $request->input('education');
        if($name !== null){
            $user->name = $name;
        }   if($phone !== null){
            $user->phone = $phone;
        }   if($about !== null){
            $profile->about = $about;
        }   if($education !== null){
            $profile->education = $education;
        }   if($age !== null){
            $profile->age = $age;
        }   if($location !== null){
            $profile->location = $location;
        }
        $profile->save();
        $user->save();
        return[
            'status' => 'ok'
        ];
    }
    public function getInfoProfile(Request $request){
        if($request->input('user_id')!=null)
            $user = User::find($request->input('user_id'));
        else
            $user = $request->user();
        $profile = Profile::where('user_id', $user->id)->first();
        return[
            'profile' => $profile,
            'user' => $user,
            'status' => 'ok'
        ];
    }

    public function getCourses(Request $request){
        return(['courses' => Course::find($request->input('user_id'))]);
    }
}
