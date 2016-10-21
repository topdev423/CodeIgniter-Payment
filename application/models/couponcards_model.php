<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to couponcards management
 * @author Teamtweaks
 *
 */
class Couponcards_model extends My_Model
{


public function view_category_list($CatRow,$val){
	$SubcatView ='';
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}
	
	public function view_edit_category_list($CatRow,$val,$ArrVal){
	$SubcatView ='';
	if(in_array($CatRow->id,$ArrVal)){ $Cond = 'checked="checked"';}else{ $Cond = '';}
	
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" '.$Cond.' tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}
	
	
	public function view_category_details(){
	
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list($CatRow,'1');		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list($SubCatRow,'2');	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list($SubCatRow1,'3');	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list($SubCatRow2,'4');	

					}			
				}
			}
		}
					
		return $catView;
	}
	
	public function view_edit_category_details($ArrVal){
	
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_edit_category_list($CatRow,'1',$ArrVal);		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_edit_category_list($SubCatRow,'2',$ArrVal);	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_edit_category_list($SubCatRow1,'3',$ArrVal);	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_edit_category_list($SubCatRow2,'4',$ArrVal);	

					}			
				}
			}
		}
					
		return $catView;
	}

	public function view_product_details($ArrVal = ''){
	

		$select_qry = "select * from ".PRODUCT." where status='Publish'";
		$productList = $this->ExecuteQuery($select_qry);
		$catView = '';
		
		if($ArrVal!=''){
			foreach ($productList->result() as $PrdRow){
				if(in_array($PrdRow->id, $ArrVal)==1){ $condT = ' checked="checked"';}else{ $condT = ''; }
				$catView .= '<span class="prd"><input name="product_id[]" class="checkbox" type="checkbox" value="'.$PrdRow->id.'" '.$condT.' tabindex="7"><strong>'.$PrdRow->product_name.' &nbsp;</strong></span>';
			}
		}else{
			foreach ($productList->result() as $PrdRow){
				$catView .= '<span class="prd"><input name="product_id[]" class="checkbox" type="checkbox" value="'.$PrdRow->id.'" tabindex="7"><strong>'.$PrdRow->product_name.' &nbsp;</strong></span>';
			}
		}			
		return $catView;
	}
}