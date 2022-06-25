<?php

switch ($data['status']) {

 case 1:
  $return = ['code' => 1, 'msg' => mys_lang('已付款')];
   break;

 case 0:
  $return = ['code' => 0, 'msg' => mys_lang('未付款')];
   break;

}
