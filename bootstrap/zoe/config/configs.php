O:8:"stdClass":2:{s:5:"cache";i:1565168263;s:4:"data";C:10:"Zoe\Config":4603:{x:i:0;a:6:{s:5:"views";a:2:{s:5:"paths";a:3:{s:5:"admin";a:2:{s:7:"backend";a:2:{s:5:"alias";s:7:"backend";s:4:"path";s:75:"C:\xampp\htdocs\zoecms\core\modules\admin\backend\resource\configs/../views";}s:8:"frontend";a:2:{s:5:"alias";s:11:"admin_front";s:4:"path";s:76:"C:\xampp\htdocs\zoecms\core\modules\admin\frontend\resource\configs/../views";}}s:4:"user";a:2:{s:7:"backend";a:2:{s:5:"alias";s:4:"user";s:4:"path";s:74:"C:\xampp\htdocs\zoecms\core\modules\user\backend\resource\configs/../views";}s:8:"frontend";a:2:{s:5:"alias";s:10:"user_front";s:4:"path";s:75:"C:\xampp\htdocs\zoecms\core\modules\user\frontend\resource\configs/../views";}}s:3:"zoe";a:1:{s:8:"frontend";a:2:{s:5:"alias";s:5:"theme";s:4:"path";s:73:"C:\xampp\htdocs\zoecms\core\themes\zoe\frontend\resource\configs/../views";}}}s:5:"alias";a:1:{s:7:"backend";a:2:{s:13:"layout.create";s:33:"backend::controller.layout.create";s:11:"layout.edit";s:31:"backend::controller.layout.edit";}}}s:8:"packages";a:3:{s:10:"namespaces";a:4:{s:5:"Admin";s:76:"C:\xampp\htdocs\zoecms\core\modules\admin\backend\resource\configs/../../src";s:4:"User";s:75:"C:\xampp\htdocs\zoecms\core\modules\user\backend\resource\configs/../../src";s:9:"UserFront";s:76:"C:\xampp\htdocs\zoecms\core\modules\user\frontend\resource\configs/../../src";s:8:"ZoeTheme";s:74:"C:\xampp\htdocs\zoecms\core\themes\zoe\frontend\resource\configs/../../src";}s:9:"providers";a:0:{}s:5:"paths";a:3:{s:5:"admin";s:41:"C:\xampp\htdocs\zoecms\core/modules/admin";s:4:"user";s:40:"C:\xampp\htdocs\zoecms\core/modules/user";s:3:"zoe";s:38:"C:\xampp\htdocs\zoecms\core/themes/zoe";}}s:7:"routers";a:2:{s:7:"backend";a:5:{s:9:"dashboard";a:5:{s:9:"namespace";s:22:"Admin\Http\Controllers";s:10:"controller";s:19:"DashboardController";s:6:"prefix";s:5:"admin";s:5:"guard";s:7:"backend";s:6:"router";a:1:{s:4:"list";a:1:{s:3:"url";s:1:"/";}}}s:6:"layout";a:5:{s:9:"namespace";s:22:"Admin\Http\Controllers";s:10:"controller";s:16:"LayoutController";s:6:"prefix";s:12:"admin/layout";s:5:"guard";s:7:"backend";s:6:"router";a:6:{s:4:"list";a:1:{s:3:"url";s:1:"/";}s:6:"create";a:1:{s:3:"url";s:7:"/create";}s:4:"edit";a:1:{s:3:"url";s:10:"/edit/{id}";}s:4:"ajax";a:3:{s:3:"url";s:5:"/ajax";s:6:"method";a:1:{i:0;s:4:"post";}s:6:"action";s:8:"ajaxPost";}s:16:"ajax:form_config";a:3:{s:3:"url";s:17:"/ajax-form-config";s:6:"method";a:1:{i:0;s:4:"post";}s:6:"action";s:14:"ajaxFormConfig";}s:17:"ajax:review_blade";a:3:{s:3:"url";s:18:"/ajax-review-blade";s:6:"method";a:1:{i:0;s:4:"post";}s:6:"action";s:15:"ajaxReviewBlade";}}}s:5:"guest";a:3:{s:9:"namespace";s:21:"User\Http\Controllers";s:10:"controller";s:14:"AuthController";s:6:"router";a:3:{s:5:"login";a:4:{s:3:"url";s:6:"/login";s:6:"action";s:8:"getLogin";s:4:"name";s:13:"backend:login";s:5:"guard";s:0:"";}s:10:"login:post";a:4:{s:3:"url";s:13:"/login/action";s:6:"action";s:9:"postLogin";s:6:"method";a:1:{i:0;s:4:"post";}s:5:"guard";s:0:"";}s:6:"logout";a:4:{s:3:"url";s:7:"/logout";s:6:"action";s:6:"logout";s:6:"method";a:1:{i:0;s:4:"post";}s:4:"name";s:14:"backend:logout";}}}s:4:"user";a:4:{s:9:"namespace";s:21:"User\Http\Controllers";s:10:"controller";s:14:"UserController";s:3:"acl";s:4:"user";s:6:"router";a:1:{s:4:"list";a:1:{s:3:"url";s:5:"/user";}}}s:9:"user:role";a:4:{s:9:"namespace";s:21:"User\Http\Controllers";s:10:"controller";s:14:"RoleController";s:3:"acl";s:9:"user:role";s:6:"router";a:1:{s:4:"list";a:1:{s:3:"url";s:10:"/user/role";}}}}s:8:"frontend";a:1:{s:4:"user";a:3:{s:9:"namespace";s:26:"UserFront\Http\Controllers";s:10:"controller";s:14:"UserController";s:6:"router";a:1:{s:4:"info";a:2:{s:3:"url";s:9:"user/info";s:5:"guard";s:0:"";}}}}}s:8:"sidebars";a:2:{s:9:"dashboard";a:3:{s:4:"name";s:9:"Dashboard";s:3:"pos";i:1;s:3:"url";s:22:"backend:dashboard:list";}s:4:"user";a:4:{s:4:"name";s:4:"User";s:3:"pos";i:2;s:3:"url";s:0:"";s:5:"items";a:2:{i:0;a:2:{s:4:"name";s:4:"List";s:3:"url";s:17:"backend:user:list";}i:1;a:2:{s:4:"name";s:4:"Role";s:3:"url";s:22:"backend:user:role:list";}}}}s:10:"components";a:2:{s:7:"configs";a:1:{s:8:"template";a:3:{s:5:"label";s:8:"Template";s:4:"view";a:1:{s:5:"admin";a:3:{s:1:"t";s:7:"backend";s:1:"m";s:6:"module";s:1:"v";s:8:"template";}}s:4:"data";a:1:{s:5:"count";i:2;}}}s:10:"components";a:2:{s:7:"content";a:2:{s:5:"admin";a:2:{s:1:"t";s:8:"frontend";s:1:"m";s:6:"module";}s:3:"zoe";a:2:{s:1:"t";s:8:"frontend";s:1:"m";s:5:"theme";}}s:15:"thumbnail-image";a:1:{s:3:"zoe";a:2:{s:1:"t";s:8:"frontend";s:1:"m";s:5:"theme";}}}}s:9:"providers";a:1:{s:38:"User\Providers\ComposerServiceProvider";s:38:"User\Providers\ComposerServiceProvider";}};m:a:0:{}}}