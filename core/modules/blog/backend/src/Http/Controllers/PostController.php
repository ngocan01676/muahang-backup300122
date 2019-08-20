<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests\FormDataPostRequest;
use  \Blog\Http\Models\Post\PostModel;
use  \Blog\Http\Models\Post\PostTranslationModel;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['current_language'] = 'en';

    }

    public function getCrumb()
    {
        $this->breadcrumb("Post", route('backend:blog:post:list'));
        return $this;
    }

    public function list()
    {
        $this->getCrumb();
        return $this->render('post.list', [], "blog");
    }

    public function create()
    {
        $this->getCrumb()->breadcrumb('Create post', route('backend:blog:post:create'));
        return $this->render('post.create', ['item' => []], 'blog');
    }

    public function edit($id)
    {
        $this->getCrumb();

        $item = PostModel::find($id);

        $trans = PostTranslationModel::where(['post_id' => $id])->get();
        foreach ($trans as $tran) {
            $item->offsetSet("title_" . $tran->lang_code, $tran->title);
            $item->offsetSet("description_" . $tran->lang_code, $tran->description);
            $item->offsetSet("content_" . $tran->lang_code, $tran->content);
        }
        $item->offsetSet("tag", implode($item->getTag(),','));
        return $this->render('post.edit', ["item" => $item], 'blog');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'image' => 'required',
        ], [
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
        $model->slug = "demo";
        $model->image = $data['image'];
        $model->status = $data['status'];
        $model->user_id = 1;
        $model->featured = $data['featured'];
        $model->save();
        foreach ($this->data['language'] as $lang => $_language) {
            if (isset($data['title_' . $lang])) {
                $model->table_translation()->updateOrInsert(
                    [
                        'post_id' => $model->id,
                        'lang_code' => $lang
                    ],
                    [
                        'title' => $data['title_' . $lang],
                        'description' => $data['description_' . $lang],
                        'content' => $data['content_' . $lang]
                    ]
                );
            }
        }
        $tags = explode(',', $data['tag']);
        foreach ($tags as $tag) {

        }
        $model->table_translation()->updateOrInsert(
            [
                'post_id' => $model->id,
                'lang_code' => $lang
            ],
            [
                'title' => $data['title_' . $lang],
                'description' => $data['description_' . $lang],
                'content' => $data['content_' . $lang]
            ]
        );
        \Actions::do_action("tag_add", "blog:post", $model->id, $data['tag'],$model->getTag());
        return redirect(route('backend:blog:post:edit', ['id' => $model->id]));
    }
}