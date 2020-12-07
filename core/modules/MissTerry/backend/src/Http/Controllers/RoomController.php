<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\Room\RoomModel;
class RoomController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "blog:category");
        $this->data['configs'] = config_get("config", "blog");
        $this->data['current_language'] =
            isset($this->data['configs']['room']['language']['default']) ? $this->data['configs']['room']['language']['default'] : "vi";
    }

    public function getCrumb()
    {
        return $this;
    }
    public function list(Request $request){
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $this->data['key'] = "core:module:miss_terry:room";
        $config = config_get('option',  $this->data['key']);
        $data = $request->query();

        $page = null;
        if (isset($data['action'])) {
            $page = 1;
        }
        $parameter = $data;

        $route = [];

        $item = isset($config['pagination']['item']) ? $config['pagination']['item'] : 20;
        $item = 1;
        $select = [

            'room.id',
            'room.title',
            'room.image',
            'room.status',
            'room.views',
            'room.created_at',
            'room.updated_at'];

        $models = DB::table('miss_room as room');

        if (isset($search) && !empty($search) || isset($parameter["filter"]['name']) && !empty($parameter['filter']['name']) && $search = $parameter['filter']['name']) {

            $models->where('t.title', 'like', '%' . $search . '%');
            $select['t.title'] = 't.title';
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
        $lang = $this->data['current_language'];

        if ($parameter['order_by']['col'] == "title") {
            if (!isset($select['t.title'])) {
                $select['t.title'] = 't.title';
            }
            $models->orderBy("t." . $parameter['order_by']['col'], $parameter['order_by']['type']);
        } else {
            $models->orderBy($parameter['order_by']['col'], $parameter['order_by']['type']);
        }
//         $models->join('miss_room_translation as rt', 'rt.room_id', '=', 'room.id');
//         $models->where('rt.lang_code', $lang);

        $models->select($select);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        return $this->render('room.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "HtmlImg" => function ($model) use ($lang) {
                    return "<img style='width:150px' src='".$model->image."'/>";
                }
            ],
        ]);

    }
    public function create()
    {
        $this->getCrumb()->breadcrumb('Tạo Phòng', route('backend:miss_terry:room:create'));
        return $this->render('room.create', ['item' => []]);
    }
    public function edit($id)
    {
        $this->getCrumb()->breadcrumb('Post Edit', route('backend:blog:post:create'));
        $item = RoomModel::find($id);
        if (isset($this->data['configs']['post']['language']['multiple'])) {
            $trans = $item->table_translation()->where(['room_id' => $id])->get();
            foreach ($trans as $tran) {
                $item->offsetSet("title_" . $tran->lang_code, $tran->title);
                $item->offsetSet("description_" . $tran->lang_code, $tran->description);
                $item->offsetSet("content_" . $tran->lang_code, $tran->content);
            }
        }

        return $this->render('room.edit', ["item" => $item, "lang_active" => $this->data['current_language']]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'image' => 'required',
            'time' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
        ], [
            'image.required' => 'The Image is Required.',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $model = RoomModel::find($data['id']);
        } else {
            $model = new RoomModel();
        }

        $model->slug = \Illuminate\Support\Str::slug($data['title'], '-');
        $model->image = $data['image'];
        $model->status = $data['status'];
        $model->admin_id = Auth::user()->id;

        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->content = $data['content'];
        $model->config = $data['config'];
        $model->difficult = $data['difficult'];

        DB::beginTransaction();
        try {
            $model->save();
            foreach ($this->data['language'] as $lang => $_language) {
                if (isset($data['title_' . $lang])) {
                    $model->table_translation()->updateOrInsert(
                        [
                            'room_id' => $model->id,
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
            DB::commit();
            return redirect(route('backend:miss_terry:room:edit', ['id' => $model->id]));
        } catch (\Exception $ex) {
            $validator->getMessageBag()->add('id', $ex->getMessage());
            DB::rollBack();
        }
        return back()
            ->withErrors($validator)
            ->withInput();
    }
}