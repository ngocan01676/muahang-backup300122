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
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {

        $sidebars = Cache::remember('sidebars:' . $this->user->keyCache(), 1 , function () {
            $app = app();
            $sidebars = $app->getConfig()->sidebars;
            $aliases_acl = $app->getPermissions()->aliases;
            $sidebar_new = [];
            foreach ($sidebars as $key => $sidebar) {
                if (isset($sidebar['url']) && !empty($sidebar['url']) && !isset($sidebar['items'])) {
                    if (isset($aliases_acl[$sidebar['url']])) {
                        $acl = $aliases_acl[$sidebar['url']];
                        if ($this->user->IsAcl($acl)) {
                            $sidebar_new[$key] = $sidebar;
                        }
                    } else {
                        $sidebar_new[$key] = $sidebar;
                    }
                } else if (isset($sidebar['items'])) {
                    $items = $sidebar['items'];
                    $_items = [];
                    foreach ($items as $k => $item) {
                        if (isset($item['url']) && !empty($item['url'])) {
                            if (isset($aliases_acl[$item['url']])) {
                                $acl = $aliases_acl[$item['url']];
                                if ($this->user->IsAcl($acl)) {
                                    $_items[] = $item;
                                }
                            }
                        }
                    }
                    $sidebar["items"] = $_items;
                    if (count($sidebar['items']) > 0) {
                        $sidebar_new[$key] = $sidebar;
                    }
                }
            }
            $func_sort = function ( $a , $b ){
                if (!isset($a['pos']) || !isset($b['pos']) || $a['pos'] == $b['pos']) {
                    return 0;
                }
                return ($a['pos'] < $b['pos']) ? -1 : 1;
            };
            usort($sidebar_new,$func_sort);
            foreach ($sidebar_new as $key=>$values){
                if(isset($values['items']) && count($values['items']) > 0){
                    $items = $values['items'];
                    usort($items,$func_sort);
                    $lists_sidebar[$key]['items'] = $items;
                }
            }
            return $sidebar_new;
        });
        $view->with('lists_sidebar', $sidebars);
    }
}