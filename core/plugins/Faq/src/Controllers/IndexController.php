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
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->data['language'] = config('zoe.language');

        $this->data['configs'] = config_get("config", "system");
        $this->data['current_language'] =
            isset($this->data['configs']['core']['site_language']) ?
                $this->data['configs']['core']['site_language'] :
                config('zoe.default_lang');
    }

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
            $models->where('plugin_faq.title', 'like', '%' . $search);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }

        $lang = $this->data['current_language'];
        $models->join('plugin_faq_translation as rt', 'rt._id', '=', 'plugin_faq.id');
        $models->where('rt.lang_code', $lang);

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

        if (isset($this->data['configs']['core']['language']['multiple'])) {
            $trans = $model->table_translation()->where(['_id' => $id])->get();
            foreach ($trans as $tran) {
                $model->offsetSet("title_" . $tran->lang_code, $tran->title);
                $model->offsetSet("content_" . $tran->lang_code, $tran->content);
            }
        }
        return $this->render('index.edit', ["model" => $model]);
    }
    public function store(Request $request)
    {
        $items = $request->all();
        $filter = [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
        if(isset($this->data['configs']['core']['language']['multiple'])){
            $newFilter = [];
            foreach ($this->data['language'] as $lang => $_language) {
                if(
                    isset($this->data['configs']['core']['language']['lists']) &&
                    (is_string($this->data['configs']['core']['language']['lists']) &&
                        $this->data['configs']['core']['language']['lists'] == $_language['lang']||
                        is_array($this->data['configs']['core']['language']['lists']) &&  in_array($_language['lang'],$this->data['configs']['core']['language']['lists'])) ){
                    foreach ($filter as $col=>$value){
                        $newFilter[$col.'_'.$lang] = $value;
                    }
                }

            }
            $filter = $newFilter;

        }
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

            $page->title = isset($items['title'])?"":"";
            $page->content =isset($items['content'])?"":"";
            $page->status = $items['status'];
            $page->order = isset($items['order'])?(int)($items['order']):0;
            DB::beginTransaction();
            try {
                $page->save();
                foreach ($this->data['language'] as $lang => $_language) {
                    if (isset($items['title_' . $lang])) {

                        $page->table_translation()->updateOrInsert(
                            [
                                '_id' => $page->id,
                                'lang_code' => $lang
                            ],
                            [
                                'title' => $items['title_' . $lang],
                                'content' => $items['content_' . $lang]
                            ]
                        );
                    }
                }
                DB::commit();
                $request->session()->flash('success', $type == "create"?z_language('Faq is added successfully'):z_language('Faq is updated successfully'));
            } catch (\Exception $ex) {
                $validator->getMessageBag()->add('id', $ex->getMessage());
                DB::rollBack();
            }
            return back();
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('title', $ex->getMessage());
        }
        return back()
            ->withErrors($validator)
            ->withInput();

    }
}