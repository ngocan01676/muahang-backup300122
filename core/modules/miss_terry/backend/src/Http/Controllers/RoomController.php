<?php
namespace MissTerry\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
         $models->join('miss_room_translation as rt', 'rt.room_id', '=', 'room.id');
         $models->where('rt.lang_code', $lang);

        $models->select($select);
        $models = $models->paginate($item, ['*'], 'page', $page);
        $models->appends($parameter);

        return $this->render('room.list', [
            'models' => $models,
            "route" => $route,
            'parameter' => $parameter,
            'callback' => [
                "GetTitle" => function ($model) use ($lang) {
                    $rs = DB::table('miss_room_translation as t')->where('room_id', $model->id)->where('lang_code', $lang)->get('title');
                    return $rs && count($rs) > 0 ? $rs[0]->title : "Empty";
                }
            ],
        ]);

    }
    public function create()
    {
        $this->getCrumb()->breadcrumb('Tạo Phòng', route('backend:miss_terry:room:create'));
        return $this->render('room.create', ['item' => []]);
    }
}