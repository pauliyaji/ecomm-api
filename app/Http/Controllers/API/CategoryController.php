<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status'=>200,
            'category'=>$categories,
        ]);
    }

    public function allcategory()
    {
        $categories = Category::where('status', 0)->get();
        return response()->json([
            'status'=>200,
            'category'=>$categories,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meta_title'=> 'required',
            'slug'=> 'required|max:191',
            'name'=> 'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'validation_errors'=> $validator->messages(),
            ]);
        }else{
            $category = new Category;
            $category->meta_title = $request->input('meta_title');
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_description = $request->input('meta_description');
            $category->slug = $request->input('slug');
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == true ? 1 : 0;
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/category/', $filename);
                $category->image = 'uploads/category/'.$filename;
            }
            $category->save();

            return response()->json([
                'status'=>201,
                'message'=> 'Category added successfully',
            ]);

        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json([
                'status'=>200,
                'category'=>$category,
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'No Category with ID: ' . $id . ' Found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required',
            'slug' => 'required|max:191',
            'name' => 'require|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'validation_errors'=> $validator->messages(),
            ]);
        }else{
            $category = Category::find($id);
            if($category){
                $category->meta_title = $request->input('meta_title');
                $category->meta_keyword = $request->input('meta_keyword');
                $category->meta_description = $request->input('meta_description');
                $category->slug = $request->input('slug');
                $category->name = $request->input('name');
                $category->description = $request->input('description');
                $category->status = $request->input('status') == true ? 1 : 0;
                if($request->hasFile('image')){
                    $path = $category->image;
                    if(file_exists($path)){
                        @unlink($path);  // then delete previou image
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/product/', $filename);
                        $category->image = 'uploads/product/' . $filename;
                    }else{
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/product/', $filename);
                        $category->image = 'uploads/product/' . $filename;
                    }
                }
                $category->update();

                return response()->json([
                    'status'=> 200,
                    'message'=> 'Category updated successfully',
                ]);
            }
            else {
                return response()->json([
                    'status'=>404,
                    'message'=> 'No Category ID found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json([
                'status'=>200,
                'message'=> 'Category Deleted Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Category ID Not Found',
            ]);
        }
    }
}
