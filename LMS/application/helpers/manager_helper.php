<?php

if(!function_exists('paginate')){
	function paginate($item_per_page, $current_page, $total_pages, $page_url){
	  global $assets;
	    $pagination = '';
	    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
	        $pagination .= '<div class="text-center"><div class="pageron">';
	        
	        if($current_page == 1)
	          $right_links    = $current_page + 5;
	        elseif($current_page == 2)
	          $right_links    = $current_page + 4;
	        else
	          $right_links    = $current_page + 3;


	        $previous       = $current_page - 1; //previous link 
	        $next           = $current_page + 1; //next link
	        $first_link     = true; //boolean var to decide our first link
	        
	        // Link anterior
	        $previous_link = ($previous==0) ? 1: $previous;
	        if($previous ==0){
	            $pagination .= '<a class="prev disabled" href="javascript:;" title="Anterior"><img src="'.base_url().'style/images/back.png"></a>'; //previous link
	        }
	        else{
	            $pagination .= '<a class="prev" href="'.$page_url.$previous_link.'" title="Anterior"><img src="'.base_url().'style/images/back.png"></a>'; //previous link
	        }

	        //paginas
	        if($current_page > 1){
	                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
	                    if($i > 0){
	                        $pagination .= '<a href="'.$page_url.$i.'">'.$i.'</a>';
	                    }
	                }   
	            $first_link = false; //set first link to false
	        }
	        
	        if($first_link){ //if current active page is first link
	            $pagination .= '<a href="javascript:;" class="first current">'.$current_page.'</a>';
	        }elseif($current_page == $total_pages){ //if it's the last active link
	            $pagination .= '<a href="javascript:;" class="last current">'.$current_page.'</a>';
	        }else{ //regular current link
	            $pagination .= '<a href="javascript:;" class="current">'.$current_page.'</a>';
	        }

	        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
	            if($i<=$total_pages){
	                $pagination .= '<a href="'.$page_url.$i.'">'.$i.'</a>';
	            }
	        }

	        // Link siguiente
	        $next_link = ($next > $total_pages) ? $total_pages : $next;
	        if(($current_page+1) > $total_pages){
	            $pagination .= '<a class="next disabled" href="javascript:;" title="Anterior"><img src="'.base_url().'style/images/next.png"></a>'; //next link
	        }
	        else{
	            $pagination .= '<a class="next" href="'.$page_url.$next_link.'" title="Anterior"><img src="'.base_url().'style/images/next.png"></a>'; //next link
	        }
	        
	        $pagination .= '</div></div>'; 
	    }
	    return $pagination; //return pagination links
	}	
}