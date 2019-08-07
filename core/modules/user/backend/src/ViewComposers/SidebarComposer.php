<?php
 namespace User\ViewComposers;
 use Illuminate\View\View;
 use Illuminate\Support\Facades\Cache;
 class SidebarComposer
 {
     public $user = [];

     /**
      * Create a movie composer.
      *
      * @return void
      */
     public function __construct()
     {
         $this->user = \Auth::guard("backend")->user();
     }

     /**
      * Bind data to the view.
      *
      * @param  View  $view
      * @return void
      */

     public function compose(View $view)
     {
         $sidebars = Cache::remember('sidebars:'.$this->user->keyCache(),0, function()
         {
             $app = app();
             $sidebars =  $app->getConfig()->sidebars;
             $aliases_acl = $app->getPermissions()->aliases;
             $sidebar_new = [];
             foreach ($sidebars as $key=>$sidebar){
                if(isset($sidebar['url']) && !empty($sidebar['url'])){
                    if(isset($aliases_acl[$sidebar['url']])){
                        $acl = $aliases_acl[$sidebar['url']];
                        if($this->user->IsAcl($acl)){
                            $sidebar_new[$key] = $sidebar;
                        }
                    }else{
                        $sidebar_new[$key] = $sidebar;
                    }
                }else if(isset($sidebar['items'])){
                    $items = $sidebar['items'];
                    foreach ($items as $k=>$item){
                        if(isset($item['url'])){
                            if(isset($aliases_acl[$item['url']])){
                                $acl = $aliases_acl[$item['url']];
                                if($this->user->IsAcl($acl) == false){
                                    unset($sidebar['items'][$k]);
                                }
                            }
                        }
                    }
                    if(count($sidebar['items'])>0){
                        $sidebar_new[$key] = $sidebar;
                    }
                }
             }
             return $sidebar_new;
         });
         $view->with('lists_sidebar', $sidebars);
     }
 }