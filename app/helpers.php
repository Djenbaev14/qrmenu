<?php
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Order;

function is_answered(){
  $company_id=auth()->user()->company->id;
  return  Order::where('company_id', $company_id)->where("deleted_at",null)->where("is_answered",0)->count();
}
function translate($text, $targetLanguage = 'uz') {
  $tr = new GoogleTranslate();
  $tr->setSource(); // Avto aniqlash
  $tr->setTarget($targetLanguage); // Target til

  try {
      return $tr->translate($text);
  } catch (Exception $e) {
      return "Tarjima qilinmadi: " . $e->getMessage();
  }
}