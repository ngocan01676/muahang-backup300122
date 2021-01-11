<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests\FormDataPostRequest;
use  \Blog\Http\Models\Post\PostModel;
use  \Blog\Http\Models\Post\PostTranslationModel;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
class PostController extends \Zoe\Http\ControllerBackend
{

    public function init()
    {
        $this->data['nestables'] = config_get("category", "blog:category");
        $this->data['language'] = config('zoe.language');
        $this->data['configs'] = config_get("config", "system");
        $this->data['current_language'] =
            isset($this->data['configs']['core']['site_language']) ?
                $this->data['configs']['core']['site_language'] :
                config('zoe.default_lang');
    }

    public function getCrumb()
    {
        $this->sidebar('backend:blog:post:list');
        $this->breadcrumb("Post", ('backend:blog:post:list'));
        return $this;
    }

    public function list(Request $request)
    {

        $search = $request->query('search', "");
        $status = $request->query('status', "");

        $config = config_get('option', "core:user:list");
        $data = $request->query();

        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;

        $route = [];

        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;

        $select = ['rt.title','post.category_id','post.id', 'post.image', 'post.status', 'post.views', 'post.created_at', 'post.updated_at'];
        $models = DB::table('blog_post as post');

        if (isset($search) && !empty($search) || isset($parameter["filter"]['name']) && !empty($parameter['filter']['name']) && $search = $parameter['filter']['name']) {

            $models->where('rt.title', 'like', '%' . $search . '%');
            $select['rt.title'] = 'rt.title';
        }
        if (isset($parameter["filter"]['type']) && !empty($parameter['filter']['type'])) {
            $models->where('type', $parameter['filter']['type']);
        }
        if (!empty($status) || $status != "") {
            $models->where('status', $status);
        }
        if (!isset($parameter['order_by'])) {
            $parameter['order_by']['col'] = 'id';
            $parameter['order_by']['type'] = 'desc';

        } else {
            if (isset($parameter['action'])) {
                $parameter['order_by']['type'] = isset($parameter['order_by']['type']) && $parameter['order_by']['type'] == "desc" ? "asc" : "desc";
            }

        }
        if (isset($parameter['action'])) {
            unset($parameter['action']);
        }


        if ($parameter['order_by']['col'] == "title") {
            if (!isset($select['rt.title'])) {
                $select['rt.title'] = 'rt.title';
            }
            $models->orderBy("post." . $parameter['order_by']['col'], $parameter['order_by']['type']);
        } else {
            $models->orderBy($parameter['order_by']['col'], $parameter['order_by']['type']);
        }

        $lang = $this->data['current_language'];
        $models->join('blog_post_translation as rt', 'rt._id', '=', 'post.id');
        $models->where('rt.lang_code', $lang);

        $models->select($select);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        return $this->render('post.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "category" => function ($model) use ($lang) {

                    $rs = DB::table('categories_translation as t')->where('_id', $model->category_id)->where('lang_code', $lang)->get('name');
                    return $rs && count($rs) > 0 ? $rs[0]->name : "Empty";
                }
            ],
        ]);

    }

    public function create()
    {
        $this->getCrumb()->breadcrumb('Post Create', ('backend:blog:post:create'));
        return $this->render('post.create', ['item' => []], 'blog');
    }

    public function edit($id)
    {

        $this->getCrumb()->breadcrumb('Post Edit', ('backend:blog:post:create'));
        $item = PostModel::find($id);
        if (isset($this->data['configs']['core']['language']['multiple'])) {
            $trans = PostTranslationModel::where(['_id' => $id])->get();
            foreach ($trans as $tran) {
                $item->offsetSet("title_" . $tran->lang_code, $tran->title);
                $item->offsetSet("description_" . $tran->lang_code, $tran->description);
                $item->offsetSet("content_" . $tran->lang_code, $tran->content);
            }
        }
        $item->offsetSet("tag", implode( ',',$item->getTag()));
        //$item->offsetSet("category", $item->getCategory());

        return $this->render('post.edit', ["item" => $item, "lang_active" => $this->data['current_language']], 'blog');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $filter = [
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
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
        $filter = array_merge($filter,[
//            'image' => 'required',
            'category_id' => 'required',
        ]);
        $validator = Validator::make($data, $filter, [
            'image.required' => 'The Image is Required.',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model = PostModel::find($data['id']);
        } else {
            $model = new PostModel();
        }

        $model->image = $data['image'];
        $model->status = $data['status'];
        $model->user_id = 1;
        $model->featured = $data['featured'];
        $model->category_id = $data['category_id'];

        $model->title = isset($data['title'])?$data['title']:"";

        $slug = empty($model->title)?"": Str::slug($model->title, '-');
        $model->slug = $slug;

        $model->description = isset($data['description'])?$data['description']:"";
        $model->content = isset($data['content'])?$data['content']:"";


        DB::beginTransaction();


        try {
            $model->save();

            foreach ($this->data['language'] as $lang => $_language) {
                if (isset($data['title_' . $lang])) {
                    $model->table_translation()->updateOrInsert(
                        [
                            '_id' => $model->id,
                            'lang_code' => $lang
                        ],
                        [
                            'title' => $data['title_' . $lang],
                            'slug' =>  Str::slug($data['title_' . $lang], '-'),
                            'description' => $data['description_' . $lang],
                            'content' => $data['content_' . $lang]
                        ]
                    );
                }
            }

            \Actions::do_action("tag_add", "blog:post", $model->id, $data['tag'], $model->getTag());

            if (isset($data['category'])) {
                $category_old = $model->getCategory();
                foreach ($data['category'] as $cate) {
                    $model->table_category()->updateOrInsert(
                        [
                            'post_id' => $model->id,
                            'category_id' => $cate,
                        ],
                        [

                        ]
                    );
                    unset($category_old[$cate]);
                }
                foreach ($category_old as $cate => $value) {
                    $model->table_category()->where(['category_id' => $cate, 'post_id' => $model->id])->delete();
                }
            }
            DB::commit();
            return redirect(route('backend:blog:post:edit', ['id' => $model->id]));
        } catch (\Exception $ex) {
            $validator->getMessageBag()->add('id', $ex->getMessage());
            DB::rollBack();
        }
        return back();
    }

    public function delete()
    {

    }
}