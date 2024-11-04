<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Productlist extends Component
{
    
    // mount  
    // sortColumnName
    // public $sortColumnName='created_at';
    // public $sortDirection='desc';
    public $search='';
    public function mount(){
    }

    // public function sortBy($columnName){
    //     if($this->sortColumnName==$columnName){
    //         $this->sortDirection= $this->swapSortDirection();
    //     }else{
    //         $this->sortDirection= 'asc';
    //     }
    //     $this->sortColumnName= $columnName;
    // }
    // public function swapSortDirection(){
    //     return $this->sortDirection == 'asc' ? 'desc' : 'asc';
    // }
    
    public function render()
    {
        $products = Product::where('deleted_at',null)->where('is_active',1)->where('name_uz', 'like', '%' . $this->search . '%')->get();
        // orderBy($this->sortColumnName, $this->sortDirection)
        return view('livewire.productlist',['products'=>$products]);
    }
}
