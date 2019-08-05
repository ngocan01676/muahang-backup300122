<?php
return [
  'structure'=>[
      'module'=>'core/modules',
      'plugin'=>'core/plugins',
      'theme'=>'core/themes'
  ],
  'modules'=>['admin','user'],
  'providers' => [

  ],
  'router'=>[
      'backend'=>[
          'prefix'=>'admin',
          'guard'=>'admin'
      ],
      'frontend'=>[
          'prefix'=>'/',
          'guard'=>'user'
      ]
  ],
  'auth'=>[
      'backend'=>[
          'login'=>'backend:login'
      ],
      'frontend'=>[
          'login'=>'login'
      ]
  ],
  'theme'=>'zoe',

];