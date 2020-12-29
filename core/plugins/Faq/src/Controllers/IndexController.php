<?php
namespace PluginFaq\Controllers;

use PluginFaq\Models\FaqModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PluginFaq\Plugin;
use Validator;

class IndexController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->sidebar(\PluginFaq\Plugin::$configRouter.':list');
        $this->breadcrumb(z_language("Faq Manager"), (\PluginFaq\Plugin::$configRouter.':list'));
        return $this;
    }
    public function list(Request $request)
    {
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', \PluginFaq\Plugin::$configOption);
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('plugin_faq');
        if (!empty($search)) {
            $models->where('title', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        $models->orderBy('id', 'desc');

        return $this->render('index.list', [
            'models' => $models->paginate($item),
            'callback'=>[
                "func_slug"=>function($model){
                    $url = url($model->slug);
                    return "<a href='".$url."'>".$url."</a>";
                }
            ]
        ],'PluginContact');
    }
    public function create(){
        $this->getcrumb()->breadcrumb(z_language("Create Faq"), false);
        return $this->render('index.create', []);
    }
    public function edit($id){
        $this->getcrumb()->breadcrumb(z_language("Edit Faq"), false);
        $model = FaqModel::find($id);
        return $this->render('index.edit', ["model" => $model]);
    }
    public function store(Request $request)
    {
        $items = $request->all();
        $filter = [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
        $type = "create";
        if (isset($items) && isset($items['id'])) {
            $page = FaqModel::find($items['id']);
            $type = "edit";
        } else {
            $page = new FaqModel();
        }
        $validator = Validator::make($items,$filter, [
            'title.required' => z_language('The title field is required.'),
            'content.required' => z_language('The content field is required.'),
            'content.description' => z_language('The description field is required.'),
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $page->title = $items['title'];
            $page->content = $items['content'];
            $page->status = $items['status'];
            $page->order = isset($items['order'])?(int)($items['order']):0;



            $page->save();
            $request->session()->flash('success', $type == "create"?z_language('Faq is added successfully'):z_language('Faq is updated successfully'));
            return back();
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('title', $ex->getMessage());
        }
        return back()
            ->withErrors($validator)
            ->withInput();

    }
}