<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Http\Model\Permission;
use User\Http\Model\Role;

class DashboardController extends \Zoe\Http\ControllerBackend
{
    public function list()
    {
        return $this->render('dashboard.list');
    }

    public function option(Request $request)
    {
        $items = $request->all();
        if (isset($items['act'])) {
            if ($items['act'] == 'get') {
                return view('backend::configs.option', ['configs' => $items['configs']]);
            } else if ($items['act'] == 'save') {
                DB::table('config')->updateOrInsert(
                    [
                        'name' => $items['name'],
                        'type' => 'option'
                    ],
                    ['data' => serialize($items['data'])]);
            }
        }
    }

    public function router(Request $request)
    {
        $data = $request->all();
        if ($request->isMethod('post')) {

            config_set('router', 'frontend', ['data' => $data]);

        }
        $listsRole = Role::where('guard_name', 'web')->get();
        $listsRolePremission = [];
        foreach ($listsRole as $item) {
            $listsRolePremission[$item->id] = Permission::where('role_id', $item->id)->get();
        }

        $layouts = \Admin\Http\Models\Layout::where('type_group', 'theme')->where('type', 'layout')->orderBy("updated_at", "desc")->get();
        return $this->render('dashboard.router', [
            'listsRolePremission' => $listsRolePremission,
            'layouts' => $layouts,
            'datas' => config_get('router', 'frontend')
        ]);
    }
}