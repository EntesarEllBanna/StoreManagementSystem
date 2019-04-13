<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    //بيحول الاراي الازواج المرتبة الى الاوبجيكت تاعنا
	public function __construct($properties=null){		
		if($properties!=null)
		    $this->SetValues($properties);
    }	
	protected $boolValues = array("active","newwindow");	
	public function SetValues($properties){		
		foreach($properties as $key => $value){	
			$r=array_search($key,$this->boolValues);
			if($r>0 || $r===0)
				$this->{$key} = $value?1:0;
			else
				$this->{$key} = $value;
      	}
	}
    
    
    
	
	protected $uniqueColumn="";
	protected $uniqueColumn2="";
	
	public function IsExists($request){
		$items=\DB::table($this->table)->where($this->uniqueColumn,
		$request[$this->uniqueColumn]);
		if($this->uniqueColumn2!="")
			$items=$items->where($this->uniqueColumn2,$request[$this->uniqueColumn2]);
			
		return $items->count();
	}
	
	public function IsExistsForUpdate($request,$id){
		$items=\DB::table($this->table)->where($this->uniqueColumn,
		$request[$this->uniqueColumn])->where("id","<>",$id);
		
		if($this->uniqueColumn2!="")
			$items=$items->where($this->uniqueColumn2,$request[$this->uniqueColumn2]);
			
		return $items->count();
	}
}