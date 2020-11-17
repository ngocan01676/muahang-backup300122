<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\FilesystemAdapter;

class ElfinderController extends \Zoe\Http\ControllerBackend
{
    protected $layout = 'backend::layout.elfinder';

    public function list()
    {
        return $this->render('elfinder.list', ['dir' => 'module/admin/assets/elfinder', 'locale' => app()->getLocale()]);
    }

    public function tinymce4()
    {
        return $this->render('elfinder.tinymce4', ['dir' => 'module/admin/assets/elfinder', 'locale' => app()->getLocale()]);
    }
    public function showConnector()
    {
            $regpat = <<<'EOP'
~^
    /
    |
    Documents(
        /   # directory
        |
        /.+ # all of items
    )
    |
    Pictures(
        /   # directory
        |
        /
        (
            [^/]+   # files
            |
            Events  # Pictures/Events
            (
                /   # directory
                |
                /[^/]+   # files
                |
                /
                (
                    (
                        School  # Pictures/Events/School
                        |
                        Others  # Pictures/Events/Others
                    )
                    (
                        /   # directory
                        |
                        /[^/]+   # files
                    )
                )
            )
            |
            Design  # Pictures/Design
            (
                /   # directory
                |
                /.+   # all of items
            )
        )
    )
$~x
EOP;

        $access = function ($attr, $path, $data, $volume, $isDir, $relpath) use($regpat)
        {
            $test = trim($relpath, '/');
            if ($isDir) {
                $test .= '/';
            }
            if (!preg_match($regpat, $test) && $test!="/") {
                return !($attr === 'read' || $attr === 'write');
            }
            $basename = basename($path);
            return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
            && strlen($relpath) !== 1           // but with out volume root
                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
                :  null;                                 // else elFinder decide it itself
//            $basename = basename($path);
//            return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
//            && strlen($relpath) !== 1           // but with out volume root
//                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
//                : null;                                 // else elFinder decide it itself
        };
        $access1 = function ($attr, $path, $data, $volume, $isDir, $relpath)
        {
            $basename = basename($path);
            return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
            && strlen($relpath) !== 1           // but with out volume root
                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
                :  null;                                 // else elFinder decide it itself
//            $basename = basename($path);
//            return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
//            && strlen($relpath) !== 1           // but with out volume root
//                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
//                : null;                                 // else elFinder decide it itself
        };
        $username = auth()->user()->username;
        $opts = array(
            // 'debug' => true,
            'roots' => array(
                // Items volume
                array(
                    'driver' => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
                    'path' => base_path('public/uploads'),                 // path to files (REQUIRED)
                    'URL' => '/uploads/', // URL to files (REQUIRED)
//                    'trashHash' => base_path('public/uploads/t1_Lw'),                     // elFinder's hash of trash folder
                    'winHashFix' => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
                    'uploadDeny' => array('all'),                // All Mimetypes not allowed to upload
                    'uploadAllow' => array(
                        'image/x-ms-bmp',
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                        'image/x-icon',
                        'text/plain'
                    ), // Mimetype `image` and `text/plain` allowed to upload
                    'uploadOrder' => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
                    'accessControl' =>$access                     // disable and hide dot starting files (OPTIONAL)
                ),
                array(
                    'driver' => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
                    'path' => base_path('public/users/'.$username),                 // path to files (REQUIRED)
                    'URL' => '/users/'.$username.'/', // URL to files (REQUIRED)
//                    'trashHash' => base_path('public/uploads/t1_Lw'),                     // elFinder's hash of trash folder
                    'winHashFix' => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
                    'uploadDeny' => array('all'),                // All Mimetypes not allowed to upload
                    'uploadAllow' => array(
                        'image/x-ms-bmp',
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                        'image/x-icon',
                        'text/plain'
                    ), // Mimetype `image` and `text/plain` allowed to upload
                    'uploadOrder' => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
                    'accessControl' =>$access1                     // disable and hide dot starting files (OPTIONAL)
                ),
            )
        );
        $connector = new \elFinderConnector(new \elFinder($opts));
        $connector->run();
    }
    function expandDirectoriesMatrix($base_dir, $level = 0) {
        $directories = array();
        foreach(scandir($base_dir) as $file) {
            if($file == '.' || $file == '..' || $file == '.quarantine' || $file ==".tmb") continue;
            $dir = $base_dir.DIRECTORY_SEPARATOR.$file;
            if(is_dir($dir)) {
                $directories[]= array(
                    'level' => $level,
                    'name' => $file,
                    'dir' => $dir,
                    'path' => pathinfo($dir),
                    'children' => $this->expandDirectoriesMatrix($dir, $level +1)
            );
        }
        }
        return $directories;
    }
    public function permission(){
       $this->layout = 'backend::layout.layout';
       $_directories =  $this->expandDirectoriesMatrix( base_path('public/uploads'));
       $roles = DB::table('role')->get()->all();
       $admins = DB::table('admin')->get()->all();
       return $this->render('elfinder.permission',['directories'=>$_directories,'roles'=>$roles,'admins'=>$admins]);
    }
}
