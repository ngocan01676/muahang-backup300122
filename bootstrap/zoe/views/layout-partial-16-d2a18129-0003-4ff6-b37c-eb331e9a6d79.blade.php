
@z_include(core/plugins/Comment/resource/views/component/comment/main.php)


        @function(func_1566927807_7911_7314 ($option))
            @php $data = $option; @endphp
@includeIf('theme::component.thumbnail-image.views.list', ['data'=>$data])
        @endfunction

        @function(func_1566927807_7010_6839 ($option))
            @php $data = run_component('Comments\main',$option) @endphp
@includeIf('pluginComment::component.comment.views.list-new', ['data'=>$data])
        @endfunction
<div class="container"><div class="row justify-content-center"><div class="col-md-8"><div class='py-4'>
@func_1566927807_7911_7314(array (
  'data' => 
  array (
    'lists' => 
    array (
      0 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      1 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      2 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      3 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
    ),
  ),
))

</div></div></div></div>
@func_1566927807_7010_6839(array (
  'data' => 
  array (
    'lists' => 
    array (
      0 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      1 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      2 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
      3 => 
      array (
        'name' => '',
        'image' => '',
        'link' => '',
      ),
    ),
  ),
))

