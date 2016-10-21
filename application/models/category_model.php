<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Category_model extends My_Model
{
	
	public function add_category($dataArr=''){
			$this->db->insert(CATEGORY,$dataArr);
	}


	public function edit_category($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(CATEGORY,$dataArr);
	}
	
	
	public function view_category($condition=''){
			return $this->db->get_where(CATEGORY,$condition);
			
	}
	
	public function view_category_list_main($CatRow,$val,$arr_val){
	$SubcatView ='';
	if($CatRow->catCount !=''){ $CatCnt = $CatRow->catCount; }else{ $CatCnt = 0;}
		$SubcatView .= '<div style="float:left;width:100%;background-color:#F3D3D8;border-bottom:1px solid rgb(202, 160, 167);"><span class="maincat"><input name="checkbox_id[]" type="checkbox"  value="'.$CatRow->id.'"><strong>'.$CatRow->cat_name.' &nbsp; ('.$CatCnt.')</strong></span>
		<div class="posView">
			<input title="Category Position" class="tipTop" type="text" name="cat_position" value="'.$CatRow->cat_position.'"/>
			<a href="javascript:void(0)" title="Change position" class="tipTop" onclick="javascript:changeCatPos(this,\''.$CatRow->id.'\')">Update</a>
			<img src="images/site/spinner.gif" style="display:none;"/>
		</div>	
		<div class="mainview">';
					if ($arr_val == '1' || in_array('2', $arr_val)){
					$mode = ($CatRow->status == 'Active')?'0':'1';
					$statusMode = 'javascript:confirm_status("admin/category/change_category_status/'.$mode.'/'.$CatRow->id.'")';
					
					if ($mode == '0'){
					$SubcatView .= '<span><a title="Click to inactive" class="action-icons c-approve" href='.$statusMode.'><span class="badge_style b_done">'.$CatRow->status.'</span></a></span><span>';
                    }else{
                    $SubcatView .= '<span><a title="Click to active" class="action-icons c-pending" href='.$statusMode.'><span class="badge_style">'.$CatRow->status.'</span></a></span>';
                    }
					
					}else {
					
					$SubcatView .= '<span class="badge_style b_done">'.$CatRow->status.'</span>';
					}
					
				if ($arr_val == '1' || in_array('2', $arr_val)){
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-edit" href="admin/category/edit_category_form/'.$CatRow->id.'" title="Edit">Edit</a></span>';
				}
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-suspend" href="admin/category/view_category/'.$CatRow->id.'" title="View">View</a></span>';
				if ($arr_val == '1' || in_array('3', $arr_val)){
					$DeleteMode = 'javascript:confirm_delete("admin/category/delete_category/'.$CatRow->id.'")';
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-delete" href='.$DeleteMode.' title="Delete">Delete</a></span>';
				}	
				
				$SubcatView .= '</div></div>';
			
		return $SubcatView;					
	}
	
	public function view_category_list_sub($CatRow,$val,$arr_val){
	$SubcatView ='';
	if($CatRow->catCount !=''){ $CatCnt = $CatRow->catCount; }else{ $CatCnt = 0;}
		$SubcatView .= '<span class="subcat'.$val.'"><input name="checkbox_id[]" type="checkbox" value="'.$CatRow->id.'"><strong>'.$CatRow->cat_name.' &nbsp; ('.$CatCnt.')</strong></span>
			<div class="subview'.$val.'">';
					if ($arr_val == '1' || in_array('2', $arr_val)){
					$mode = ($CatRow->status == 'Active')?'0':'1';
					$statusMode = 'javascript:confirm_status("admin/category/change_category_status/'.$mode.'/'.$CatRow->id.'")';
					
					if ($mode == '0'){
					$SubcatView .= '<span><a title="Click to inactive" class="action-icons c-approve" href='.$statusMode.'><span class="badge_style b_done">'.$CatRow->status.'</span></a></span><span>';
                    }else{
                    $SubcatView .= '<span><a title="Click to active" class="action-icons c-pending" href='.$statusMode.'><span class="badge_style">'.$CatRow->status.'</span></a></span>';
                    }
					}else {
					
					$SubcatView .= '<span class="badge_style b_done">'.$CatRow->status.'</span>';
					}
					
				if ($arr_val == '1' || in_array('2', $arr_val)){
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-edit" href="admin/category/edit_category_form/'.$CatRow->id.'" title="Edit">Edit</a></span>';
				}
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-suspend" href="admin/category/view_category/'.$CatRow->id.'" title="View">View</a></span>';
				if ($arr_val == '1' || in_array('3', $arr_val)){
						
					$DeleteMode = 'javascript:confirm_delete("admin/category/delete_category/'.$CatRow->id.'")';
					$SubcatView .= '<span class="view_cat"><a class="action-icons c-delete" href='.$DeleteMode.' title="Delete">Delete</a></span>';
				}	
				
				$SubcatView .= '</div><hr style="float:left;width:100%;background-color:#EFF0F7;border:none;height:1px;">';
			
		return $SubcatView;					
	}
	
	
	public function view_category_details(){
	
		//$select_qry = "select a.*,COUNT(b.category_id) as catCount from ".CATEGORY." a LEFT JOIN ".PRODUCT_CATEGORY." b on a.id = b.product_id where a.rootID=0  ";
		//$select_qry = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select category_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.category_id where a.rootID=0";



		$select_qry = "select a.*,(select count(*) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID=0 order by a.cat_position asc";
		$categoryList = $this->ExecuteQuery($select_qry);
		
		//echo '<pre>'; print_r($categoryList->result()); die;
		
		$catView='';$Admpriv = 0;$SubPrivi = '';
			
		if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name')){
			$Admpriv = '1';
		}
		
		if($Admpriv==1){
				
		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'','1');		
			
			$sel_qry = "select a.*,(select count(*) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1','1');	
				
				$sel_qry1 = "select a.*,(select count(*) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow->id."'  ";		
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2','1');	
					
					$sel_qry2 = "select a.*,(select count(*) from ".PRODUCT." c where FIND_IN_SET(a.id ,c.category_id) ) as catCount from ".CATEGORY." a where a.rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3','1');	

					}			
				}
			}
		}
					
		}else{
			$newSubAdmin = $this->session->userdata('fc_session_admin_privileges'); 
			
			
			foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list_main($CatRow,'',$newSubAdmin['category']);		
			
			$sel_qry = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select category_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.category_id where a.rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list_sub($SubCatRow,'1',$newSubAdmin['category']);	
					
				$sel_qry1 = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select subcategory_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.subcategory_id where a.rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list_sub($SubCatRow1,'2',$newSubAdmin['category']);	
					
					$sel_qry2 = "select a.*,b.catCount from ".CATEGORY." a LEFT JOIN (select subcategory_id,count(*) as catCount from ".PRODUCT_CATEGORY." GROUP BY product_id) b on a.id = b.subcategory_id where a.rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list_sub($SubCatRow2,'3',$newSubAdmin['category']);	

					}			
				}
			}
		}
			
		}
			
			return $catView;
					

			
	}

	public function getAttrubteValues($condition){
		$sel = 'select * from '.LIST_VALUES.' '.$condition.' ';
		return $this->ExecuteQuery($sel);
	}


	
}

?>