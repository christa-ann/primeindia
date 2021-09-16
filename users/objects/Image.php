<?php
class Image{
	public static function uploadMedia($image, $image_tmp)
	    {
	    	if(!file_exists(ROOT."/mediafiles/"))
	        {
	    		mkdir(ROOT."/mediafiles/");
	    		chmod(ROOT."/mediafiles/", 0755);
	    	}
	    	//mkdir(ROOT."/quotations");
	    	if(move_uploaded_file($image_tmp, ROOT."/mediafiles/".$image)){
	    		return true;
	    	}
	    	else{
	    		return false;
	    	}
	    
	}
	public static function deleteMediaDoc($db,$img,$rowID,$field){
	    	//imgpath is img name
	    	//echo ROOT."/products/".$imgpath;
		//echo file_exists(ROOT."/assetsdoc/".$img);
	    	if(file_exists(ROOT."/mediafiles/".$img)){
	            
	            @unlink(ROOT."/mediafiles/".$img); 
	            
	            
	            //echo "UPDATE task_updates SET {$field}='' WHERE id='{$rowID}' ";
	            try {
		        $db->query("UPDATE task_updates SET {$field}='' WHERE id='{$rowID}' ");
		            return true;
		            } catch (PDOException $e){ return $e->getMessage(); }
	        }

	    }
}
?>