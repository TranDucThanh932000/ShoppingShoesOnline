<?php
namespace App\Components;

use App\Models\Menu;

class MenuRecursive{
    private $html;
    public function __construct(){
        $this->html = '';
    }

    public function menuRecursiveAdd($parentId = 0,$subMark = ''){
        $data = Menu::where('parent_id',$parentId)->get();
        foreach($data as $dataItem){
            
            $this->html .='<option value="' . $dataItem->id . '">'. $subMark . $dataItem->name . '</option>';
            
            
            $this->menuRecursiveAdd($dataItem->id,$subMark . '--');
        };
        return $this->html;        
    }

    public function menuRecursiveEdit($parentIdMenuEdit,$parentId = 0,$subMark = ''){
        $data = Menu::where('parent_id',$parentId)->get();
        foreach($data as $dataItem){
            if($dataItem->id == $parentIdMenuEdit){
                $this->html .='<option selected value="' . $dataItem->id . '">'. $subMark . $dataItem->name . '</option>';
            }else{
                $this->html .='<option value="' . $dataItem->id . '">'. $subMark . $dataItem->name . '</option>';
            }
            
            $this->menuRecursiveEdit($parentIdMenuEdit,$dataItem->id,$subMark . '--');
        };
        return $this->html;        
    }

}