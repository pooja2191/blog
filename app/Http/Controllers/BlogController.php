<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Role;

class BlogController extends Controller
{
   
    public function index()
    {
        $role = Role::where('id',\Illuminate\Support\Facades\Auth::user()->role)->pluck('name')->first();
        if($role == "admin")
        {
            $list = Blog::with('user')->get();
        }
        else
        {
            $list = Blog::with('user')->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
        }  
        
        return view('blogs.blog',compact('list'));
    }
    
    public function create()
    {
      return view('blogs.create');
    }
    
    public function store(Request $request)
    {
        if(isset($request['image']))
        {
            $this->validate($request, [
                'input_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'blogImages';
            $image->move($destinationPath, $name);
            
            $imageUrl = env('APP_URL').'/'.$destinationPath.'/'.$name;
            $data = [
                'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'is_active' => $request['is_active'],
                'image' =>$imageUrl,
                ];
        }
        else
        {
            $data = [
                'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'is_active' => $request['is_active']
                ];
        }
        Blog::create($data);
        return redirect('/blogs');
    }
    public function edit($id)
    {
        $role = Role::where('id',\Illuminate\Support\Facades\Auth::user()->role)->pluck('name')->first();
        if($role == "admin")
        {
            $blogData = Blog::where('id',$id)->first(); 
            return view('blogs.edit',compact('blogData'));
        }
        else
        {
            $blogData = Blog::where('id',$id)->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first();
            if( $blogData != null) 
            {
                return view('blogs.edit',compact('blogData'));
            }
            else
            {
                return redirect('/blogs');
            }
        }   
       
    }

    public function update(Request $request,$id)
    {
        if(isset($request['image']))
        {
            $this->validate($request, [
                'input_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'blogImages';
            $image->move($destinationPath, $name);
            
            $imageUrl = env('APP_URL').'/'.$destinationPath.'/'.$name;
            $data = [
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'is_active' => $request['is_active'],
                'image' =>$imageUrl,
                ];
        }
        else
        {
            $data = [
                'title' => $request['title'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'is_active' => $request['is_active']
                ];
        }
        Blog::where('id',$id)->update($data);
        return redirect('/blogs');
    }

    public function destroy(Request $request,$id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/blogs');
    }
}
