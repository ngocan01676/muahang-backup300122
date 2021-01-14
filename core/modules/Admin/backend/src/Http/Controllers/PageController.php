<?php

namespace Admin\Http\Controllers;

use Admin\Http\Models\PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class PageController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->sidebar('backend:page:list');
        $this->breadcrumb(z_language("Page"), ('backend:page:list'));
        return $this;
    }
    public function ajax(Request $request){
        $key = base64_decode($request->header('KEY'));
        if(Auth::user()->IsAcl()){

        }
        return response()->json([]);
    }
    public function list(Request $request)
    {
        $this->getcrumb();
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");
        $config = config_get('option', "core:page");
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $models = DB::table('page');
        if (!empty($search)) {
            $models->where('title', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');
        return $this->render('page.list', [
            'models' => $models->paginate($item),
            'callback'=>[
                "func_slug"=>function($model){
                    $url = url($model->slug);
                    return "<a href='".$url."'>".$url."</a>";
                }
            ]
        ]);
    }
    public function create(Request $request)
    {
        $this->getcrumb()->breadcrumb("Create Page", false);
        return $this->render('page.create', []);
    }

    public function edit($id)
    {
        $this->getcrumb()->breadcrumb("Edit Page", false);
        $page = PageModel::find($id);
        return $this->render('page.edit', ["page" => $page]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $ref = $request->ref;
        $model = PageModel::find($id);
        if($model){
            $model->delete();
        }
        if($ref){
            return redirect($ref);
        }else{
            return redirect(route("backend:page:list", []));
        }
    }

    public function status()
    {

    }

    public function store(Request $request)
    {
        $items = $request->all();
        $filter = [
            'title' => 'required|max:255',
            'router' => 'required',
            'description' => 'required',
        ];
        $type = "create";
        if (isset($items) && isset($items['id'])) {
            $page = PageModel::find($items['id']);
            if($page->slug != $items['slug']){
                $filter['slug'] = 'required|max:255|unique:page';
            }
            $type = "edit";
        } else {
            $page = new PageModel();
            $filter['slug'] = 'required|max:255|unique:page';
        }

        $validator = Validator::make($items,$filter, [
            'title.required' => z_language('The title field is required.'),
            'router.required' => z_language('The title field is required.'),
//            'content.required' => z_language('The content field is required.'),
//            'content.description' => z_language('The description field is required.'),
            'slug.required' => z_language('The slug field is required.'),
            'slug.unique' => z_language('The slug has already been taken.'),
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = Str::slug($items['title'], '-');
            $page->title = $items['title'];

            $page->slug = isset($items['slug'])?trim($items['slug'],"/"):$slug;
            $page->router =  Str::slug($items['router'], '_');;
            if($page->router == "home" && empty($page->slug)){
                $page->slug = "/";
            }
            $page->description = $items['description'];

            $page->content = htmlspecialchars_decode($items['content']);
            $page->status = $items['status'];
            $page->save();
            $file = new \Illuminate\Filesystem\Filesystem();
            $path = storage_path('app/views/pages/');
            if (!$file->isDirectory($path)) {
                $file->makeDirectory($path);
            }
            $file->put($path . '/' . $page->router  . '.blade.php', html_entity_decode($page->content));
            $request->session()->flash('success', $type == "create"?z_language('Page is added successfully'):z_language('Page is updated successfully'));
            return back();
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('name', $ex->getMessage());
        }
        return back()
            ->withErrors($validator)
            ->withInput();

    }
}