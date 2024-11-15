<?php

use App\Models\Order;

function is_answered(){
  $company_id=auth()->user()->company->first()->id;
  return  Order::where('company_id', $company_id)->where("deleted_at",null)->where("is_answered",0)->count();
}