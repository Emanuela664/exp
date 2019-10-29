<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;

class TreeController extends Controller
{
    public function treeView(){
        $dep = Departament::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($dep as $Departament) {
             $tree .='<li class="tree-view closed"><a class="tree-name" onclick="dep_employees('.$Departament->id.')">'.$Departament->first_name.'</a>';
             if(count($Departament->childs)) {
                $tree .=$this->childView($Departament);
            }
        }
        $tree .='<ul>';
        return view('treeview',compact('tree'));
    }
    public function childView($Departament){
            $html ='<ul>';
            foreach ($Departament->childs as $arr) {
                if(count($arr->childs)){
                $html .='<li class="tree-view closed"><a class="tree-name" onclick="dep_employees('.$arr->id.')">'.$arr->first_name.'</a>';
                        $html.= $this->childView($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name" onclick="dep_employees('.$arr->id.')">'.$arr->first_name.'</a>';
                        $html .="</li>";
                    }

            }

            $html .="</ul>";
            return $html;
    }
}
