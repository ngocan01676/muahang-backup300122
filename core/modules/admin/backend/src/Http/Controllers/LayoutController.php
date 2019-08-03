<?php
namespace Admin\Http\Controllers;
use Admin\Http\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class LayoutController extends \Zoe\Http\ControllerBackend{
    public function list(){
        return view('backend::controller.layout.list');
    }
    private function GetBlade(){
        if(class_exists("ZoeTheme\Helper\BladeHelper")){
            return new \ZoeTheme\Helper\BladeHelper();
        }else{
            return new \Admin\Lib\BladeHelper();
        }
    }
    public function store(PageRequest $request){
//        $items = $request->all();
//        if(isset($items)){
//            $page = PageModel::find($items['id']);
//        }else{
//            $page = new PageModel();
//        }
//        $slug = Str::slug($items['title'], '-');
//        $page->title=$items['title'];
//        $page->slug = $slug;
//        $page->description = $items['description'];
//        $page->content = $items['content'];
//        $page->status = 1;
//        $file = new \Illuminate\Filesystem\Filesystem();
//        $page->save();
//        $file->put(base_path('bootstrap/tigon/views/page-'.md5($page->id).".blade.php"),$page->content);
//        return back();
    }
    public function ajaxPost(Request $request){
         $items = $request->all();
         if(isset($items['id']) && $items['id']!=0){
             $model = \Admin\Http\Models\Layout::find($items['id']);
         }else{
             $model = new \Admin\Http\Models\Layout();
         }

         $model->name=$items['name'];
         $slug = Str::slug($items['name'], '-');
         $model->slug = $slug;
         $model->theme = $items['theme'];
         $model->content = serialize($items['layout']);
         $model->save();
         \Admin\Lib\LayoutBlade::$blade = $this->GetBlade();
         \Admin\Lib\LayoutBlade::render($items['layout']);
         echo json_encode(['id'=>$model->id]);
    }

    public function create(){
        $model =new \Admin\Http\Models\Layout();
        $model->content = [
            "data"=>[],
            "widget"=>[]
        ];
        $model->id = 0;
        return $this->render("layout.edit",[
            'model'=>$model
        ]);
    }
    public function edit($id){
        $model = \Admin\Http\Models\Layout::find($id);
        $model->content = unserialize($model->content);
        return $this->render("layout.edit",[
            'model'=>$model
        ]);
    }
}