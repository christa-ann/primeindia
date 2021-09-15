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
}
?>