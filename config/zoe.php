<?php
return [
  'structure'=>[
      'module'=>'core/modules',
      'plugin'=>'core/plugins',
      'theme'=>'core/themes'
  ],
  'modules'=>['admin'],
  'providers' => [

  ],
  'router'=>[
      'backend'=>[
          'prefix'=>'admin',
          'guard'=>'admin'
      ],
      'frontend'=>[]
  ]
];