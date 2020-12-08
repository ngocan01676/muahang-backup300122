<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use MissTerry\Http\Models\Room\RoomModel;
class BookingController extends \Zoe\Http\ControllerBackend
{
    public function init()
    {
        $this->data['language'] = config('zoe.language');
        $this->data['nestables'] = config_get("category", "blog:category");
        $this->data['configs'] = config_get("config", "blog");
        $this->data['miss_room'] = DB::table('miss_room')->get()->keyBy('id')->all();
        $this->data['current_language'] =
            isset($this->data['configs']['room']['language']['default']) ? $this->data['configs']['room']['language']['default'] : "vi";
    }
    public function getCrumb()
    {
        $this->breadcrumb('List Room',('backend:miss_terry:booking:list'));
        return $this;
    }
    public function list(Request $request){
        $search = $request->query('search', "");
        $status = $request->query('status', "");
        $this->data['key'] = "core:module:miss_terry:booking";
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
        $select = [];

        $models = DB::table('miss_booking as b');

//        if (isset($search) && !empty($search) || isset($parameter["filter"]['name']) && !empty($parameter['filter']['name']) && $search = $parameter['filter']['name']) {
//
//            $models->where('title', 'like', '%' . $search . '%');
//        }

        if (isset($parameter["filter"]['room']) && !empty($parameter['filter']['room'])) {
            $models->where('room_id', $parameter['filter']['room']);
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
//        $models->select([]);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        $miss_room = $this->data['miss_room'];
        $miss_user = DB::table('user')->get()->keyBy('id')->all();

        return $this->render('booking.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "get_room" => function ($model) use ($lang,$miss_room) {
                    if(isset($miss_room[$model->room_id])){
                        return $miss_room[$model->room_id]->title;
                    }
                    return z_language('Empty');
                },
                "get_user" => function ($model) use ($lang,$miss_user) {
                    if($model->user_id > 0){
                        return $miss_user[$model->user_id]->name;
                    }
                    return $model->fullname;
                }
            ],
        ]);

    }
    public function create()
    {
        $this->getCrumb()->breadcrumb('Create Booking', ('backend:miss_terry:booking:create'));
        return $this->render('booking.create', ['item' => []]);
    }
    public function edit($id)
    {
        $this->getCrumb()->breadcrumb(z_language('Edit Booking'), ('backend:miss_terry:booking:edit'));
        $item = RoomModel::find($id);
        if (isset($this->data['configs']['post']['language']['multiple'])) {
            $trans = $item->table_translation()->where(['room_id' => $id])->get();
            foreach ($trans as $tran) {
                $item->offsetSet("title_" . $tran->lang_code, $tran->title);
                $item->offsetSet("description_" . $tran->lang_code, $tran->description);
                $item->offsetSet("content_" . $tran->lang_code, $tran->content);
            }
        }

        return $this->render('booking.edit', ["item" => $item, "lang_active" => $this->data['current_language']]);
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
            return back();
        } catch (\Exception $ex) {
            $validator->getMessageBag()->add('id', $ex->getMessage());
            DB::rollBack();
        }
        return back()
            ->withErrors($validator)
            ->withInput();
    }
}