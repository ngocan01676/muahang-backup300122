<?php

namespace Admin\Http\Controllers;
use Admin\Http\Models\EmailTemplateModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class EmailTemplateController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb($url = "")
    {

        $this->breadcrumb(z_language("Email Template"), (empty($url)?'backend:email_template:list':$url));
        return $this;
    }
    public function ajax(Request $request){
        return response()->json([]);
    }
    public function list(Request $request)
    {
        $group = isset($request->route()->defaults['group']) ? $request->route()->defaults['group'] : 'backend';
        $id_key = isset($request->route()->defaults['id_key']) ? $request->route()->defaults['id_key'] : 'default';
        $option = isset($request->route()->defaults['option']) ? $request->route()->defaults['option'] : 'core:module:admin:email-template';

        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $date = $request->query('date', "");

        $config = config_get('option', $id_key);
        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $models = DB::table('email_template');
        if (!empty($search)) {
            $models->where('name', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        if($id_key !="default"){
            $models->where('id_key',  $id_key);
        }
        $models->orderBy('id', 'desc');

        $urlCurrentName = request()->route()->getName();
        $arr = explode(':',$urlCurrentName);
        $this->getcrumb($urlCurrentName);
        unset($arr[count($arr)-1]);
        $url = implode(':',$arr);

        $configs = [
            'config'=>[
                'pagination'=>[
                    'router'=>[
                        'edit' => ['name' => $url.':edit'],
                        'trash' => [ 'name' => $url.':delete'],
                        'preview'=>false,

                    ]
                ]
            ]
        ];

        return $this->render(
            'email-template.list',[
                    'url'=>$url,
                    'option'=>$option,
                    'configs'=>$configs,
                    'id_key'=>$id_key,
                    'models' => $models->paginate($item),
                    'urlCurrentName'=>$urlCurrentName,
                    'callback'=>[
                        "func_slug"=>function($model){
                            $url = url($model->slug);
                            return "<a href='".$url."'>".$url."</a>";
                        }
                    ]
                 ],
        $group);
    }
    public function create(Request $request)
    {

        $group = isset($request->route()->defaults['group']) ? $request->route()->defaults['group'] : 'backend';
        $id_key = isset($request->route()->defaults['id_key']) ? $request->route()->defaults['id_key'] : 'default';
        $option = isset($request->route()->defaults['option']) ? $request->route()->defaults['option'] : 'core:module:admin:email-template';
        $sidebar = isset($request->route()->defaults['sidebar']) ? $request->route()->defaults['sidebar'] : '';

        $this->sidebar($sidebar);
        $this->getcrumb($sidebar);
        $this->getcrumb()->breadcrumb(z_language('Create'), false);
        $configs = isset($this->app->getConfig()->configs['controllers'][get_class($this)][$id_key])?$this->app->getConfig()->configs['controllers'][get_class($this)][$id_key]:[];
        return $this->render('email-template.create', [
            'configs'=>$configs,'id_key'=>$id_key
        ],$group);
    }
    public function edit(Request $request)
    {
        $this->getcrumb()->breadcrumb(z_language('Edit'), false);
        $model = EmailTemplateModel::find($request->id);

        $group = isset($request->route()->defaults['group']) ? $request->route()->defaults['group'] : 'backend';
        $id_key = isset($request->route()->defaults['id_key']) ? $request->route()->defaults['id_key'] : 'default';
        $option = isset($request->route()->defaults['option']) ? $request->route()->defaults['option'] : 'core:module:admin:email-template';
        $sidebar = isset($request->route()->defaults['sidebar']) ? $request->route()->defaults['sidebar'] : '';
        $this->getcrumb($sidebar);
        $this->sidebar($sidebar);


        $configs = isset($this->app->getConfig()->configs['controllers'][get_class($this)][$id_key])?$this->app->getConfig()->configs['controllers'][get_class($this)][$id_key]:[];
        return $this->render('email-template.edit', [
            "model" => $model,
            'configs'=>$configs,'id_key'=>$id_key
        ],$group);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $ref = $request->ref;
        $sidebar = isset($request->route()->defaults['sidebar']) ? $request->route()->defaults['sidebar'] : '';
        $model = EmailTemplateModel::find($id);
        if($model){
            $model->delete();
        }
        if($ref){
            return redirect($ref);
        }else{
            return redirect(route($sidebar, []));
        }
    }

    public function status()
    {

    }

    public function store(Request $request)
    {
        $items = $request->all();
        $filter = [
            'name' => 'required|max:255',
            'content' => 'required',
        ];
        $type = "create";
        if (isset($items) && isset($items['id'])) {
            $model = EmailTemplateModel::find($items['id']);
            $type = "edit";
        } else {
            $model = new EmailTemplateModel();
        }
        $validator = Validator::make($items,$filter, [
            'name.required' => z_language('The title field is required.'),
            'content.required' => z_language('The content field is required.'),
        ]);
        if (!$validator->fails()) {
            try {
                $model->name = $items['name'];
                $model->content = htmlspecialchars_decode($items['content']);
                $model->status = $items['status'];
                $model->parameters = $items['parameters'];
                $model->config = '[]';
                $model->data = '[]';
                $model->id_key =  $items['id_key'];
                $model->save();
                $request->session()->flash('success', $type == "create"?z_language('Email Template is added successfully'):z_language('Email Template is updated successfully'));
                return back();
            }catch (\Exception $ex){
                $validator->getMessageBag()->add('name', $ex->getMessage());
            }
        }
        return back()
            ->withErrors($validator)
            ->withInput();

    }
}