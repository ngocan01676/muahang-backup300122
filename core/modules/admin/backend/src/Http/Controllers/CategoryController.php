<?php

namespace Admin\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Admin\Http\Models\Categories;
use Illuminate\Support\Str;
class CategoryController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        return $this;
    }
    public function ajax(Request $request){
        $post = $request->all();
        if(isset($post['act'])){
            if($post['act'] == "info"){
                $data = $post['data'];
                $validator = Validator::make($data, [
                    'name' => 'required',
                    'description' => 'required',
                ]);
                if ($validator->passes()) {
                    if(isset($data) && isset($data['id'])){
                        $category = Categories::find($data['id']);
                    }else{
                        $category = new Categories();
                    }
                    $slug = Str::slug($data['name'], '-');
                    $category->name = $data['name'];
                    $category->slug = $slug;
                    $category->parent_id = $data['parent_id'];
                    $category->description = $data['description'];
                    $category->status = $data['status'];
                    $category->type = $data['type'];
                    $category->icon = "";
                    $category->featured = $data['featured'];
                    $category->order = 0;
                    $category->is_default = 0;
                    $category->save();
                    return response()->json(['success'=>$data]);
                }
                return response()->json(['error'=>$validator->errors()]);
            }else if($post['act'] == "position"){
                $data = $post['data'];
                config_set("category", $data['type'],$data['pos']);
                return response()->json(['success'=>$data]);
            }
        }
    }
    public function list(Request $request)
    {

        $type = isset($request->route()->defaults['type'])?$request->route()->defaults['type']:'category';
        $this->data['category'] = get_category_type($type);

        $this->data['type'] = $type;
        return $this->render('category.list',[]);
    }
}