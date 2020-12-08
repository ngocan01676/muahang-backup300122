<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use \User\Http\Model\Role;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class RoleController extends \Zoe\Http\ControllerBackend
{
    public function getCrumb()
    {
        $this->breadcrumb("Role Group", ('backend:user:role:list'));
        return $this;
    }
    public function list()
    {
        $allRoles = Role::all();
        return $this->render('role.list', [
            'lists' => $allRoles
        ], 'user');
    }
    public function permission($id,$guard,Request $request)
    {
        $this->getcrumb()->breadcrumb(z_language("Premission"), false);
        $modelRole = new Role();
        if($request->isXmlHttpRequest()){

            $post = $request->all();
            $this->log('role','permission',['guard'=>$guard]);
            $modelRole->SaveData($id,$guard,isset($post['data'])?$post['data']:[]);

            Cache::pull('sidebars:'.auth_key_cache($guard,$id));
            Cache::pull('role:'.$guard);
            Cache::pull( 'permissions:'.$guard.":".$id);
            Cache::pull( 'permissions:user:'.$guard);

            return $post;
        }

        $permissions = [];
        $global_permissions = app()->getPermissions();
        foreach ($global_permissions->data as $key=>$values){
            $permissions[$key] = [];
            foreach ($values as $_key=>$_values){
                $permissions[$key][$_key] = [
                    "type"=>"router",
                    "name"=>$_key,
                    "group"=>explode(":",$_key),
                    "status"=>true,
                    "permissions"=>$_values
                ];
            }
        }

        $acl_statics = acl_all_key();
        foreach ($acl_statics as $acl_static){
            $arr_acls = explode(":",$acl_static['name']);

            $key = isset($arr_acls[0])?$arr_acls[0]=="SB"?"backend":"frontend":"";
            $n = count($arr_acls);

            if(!empty($key)){
                $name = "";

                for ($i=1; $i< count($arr_acls) ; $i++){
                    $name.=$arr_acls[$i].":";
                }
                $name = trim($name,":");

                $permissions[$key][$acl_static['name']] = [
                    "type"=>$acl_static['path'][1],
                    "name"=>$name,
                    "group"=>$arr_acls,
                    "status"=>$n > 2,
                    "permissions"=>[$acl_static['name']]
                ];

            }
        }
        return $this->render('role.premission', [
            'user_permissions' => $modelRole->GetPermissions($id),
            'global_permissions' => $global_permissions,
            'permissions' => $permissions,
            'id'=>$id,
            'guard'=>$guard,
            'acl_statics'=> acl_all_key()
        ], 'user');

    }
    public function error(){
        return $this->render('role.error');
    }
    public function create(){
        return $this->render('role.create');
    }
    public function edit($id){
        $roles = DB::table('role')->where('guard_name','backend')->get()->all();
        $this->data['roles'] = [];
        foreach ($roles as $role){
            $this->data['roles'][$role->id] = $role->name;
        }
        $this->getcrumb()->breadcrumb(z_language("Sửa"), false);
        $model = Role::find($id);
        return $this->render('role.edit',["model" => $model]);
    }
    public function store(Request $request){
        $data = $request->all();
        $filter = [

        ];
        $type = 'create';

        if (isset($data['id']) && !empty($data['id'])) {

            $model = Role::find($data['id']);
            $type = 'edit';
            $filter['name'] = 'required|max:255';
            if($model->name != $data['name']){
                $filter['name'] = $filter['name'].'|unique:role';
            }
        }else{
            $filter['name'] = 'required|max:255|unique:role';
            $model = new Role();
        }

        $validator = Validator::make($data,$filter, [
            'name.required' => z_language('Tên nhóm quyền không được phép bỏ trống.'),
            'name.unique' => z_language('Tên nhóm quyền đã tồn tại.'),
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $model->name = $data['name'];
            $model->guard_name = $data['guard_name'];
            $model->status = $data['status'];

            $model->save();

            $this->log('user:user',$type,['id'=>$model->id]);

            $request->session()->flash('success',z_language('Cập nhật thông tin thành công'));

            return redirect(route('backend:user:role:edit', ['id' => $model->id]));
        }catch (\Exception $ex){
            $validator->getMessageBag()->add('name', $ex->getMessage());
        }
        return back()
            ->withErrors($validator)
            ->withInput();
    }
}

