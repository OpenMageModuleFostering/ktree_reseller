<?php
class Ktree_Reseller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

   public function statedropdownAction()
    {
                
                                 $statehtml = " ";
				$region  = $this->getRequest()->getParam('region');
                          if($region != "0") {
                            $sql = "SELECT Distinct(reseller_state) FROM reseller_reselleraddress where reseller_country='".$region."'";
                          $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                                
                                
                        
                          //$statehtml.='<select name="state1" id="state1">';
				$statehtml.='<option value="0">All States</option>'; 
					foreach($connection->fetchAll($sql) as $row ) {
					 					
					$statehtml.='<option value="'.$row['reseller_state'].'">'.$row['reseller_state'].'</option>'; 
                    	 } 
                    //$statehtml.='</select>';
echo $statehtml;
}

 else { 
$statehtml.='<select name="state" id="state">';
				
					
					 					
					$statehtml.='<option value="0">All States</option>'; 
                    	
                    $statehtml.='</select>';
echo $statehtml;
}
                         
                  
               //echo $statehtml;

     }
    
    //coded by samanta for reseller filter
    public function searchResellerAction()
    {
    
    	if ($this->getRequest()->getParam('region') || $this->getRequest()->getParam('service') || $this->getRequest()->getParam('state')) { 
			        $response = array();
			        $response['result'] = '';
			        $html = " ";
				$region  = $this->getRequest()->getParam('region');
				$service  = $this->getRequest()->getParam('service');
                                $state  = $this->getRequest()->getParam('state');
                                $storeid=Mage::app()->getStore()->getId();
                                 $where="( store_id LIKE '".$storeid.",%' 
	                                       OR store_id LIKE '%,".$storeid."'
	                                       OR store_id LIKE '%,".$storeid.",%'
	                                       OR store_id LIKE '".$storeid."'  or store_id=0 ) AND ";
				if($region != "0" && $state == "0" && $service == "0")        // if only region is selected
				{
				  
				   //$where .="( reseller_region = '".$region."'";
				   //$where  .=" OR reseller_state = '".$state."'";
                                    $where  .="( reseller_country = '".$region."')";
				}

                            if($region != "0" && $state != "0" && $service == "0")        // if only region is selected
				{
				  
				   $where.="(reseller_country = '".$region."' AND reseller_state = '".$state."')";
                                   // $where  .=" OR reseller_country = '".$region."'";
				}
				if($region != "0" && $state != "0" && $service != "0")       // if both region and service is selected
				{
				   $where.="(reseller_country = '".$region."'";
				   $where  .=" AND reseller_state = '".$state."')";
				   //$where  .=" OR reseller_country = '".$region."')";
				   $where .=" AND (reseller_services LIKE '".$service.",%' 
	                                       OR reseller_services LIKE '%,".$service."'
	                                       OR reseller_services LIKE '%,".$service.",%'
	                                       OR reseller_services LIKE '".$service."')";
				}
                   if($region != "0" && $state == "0" && $service != "0")       // if both region and service is selected
				{
				   $where .="(reseller_country = '".$region."')";
				   //$where  .=" OR reseller_state = '".$state."')";
				   //$where  .=" OR reseller_country = '".$region."')";
				   $where .=" AND (reseller_services LIKE '".$service.",%' 
	                                       OR reseller_services LIKE '%,".$service."'
	                                       OR reseller_services LIKE '%,".$service.",%'
	                                       OR reseller_services LIKE '".$service."')";
				}
								
				if($region == "0" && $service != "0")     // if only service is selected
				{
				   $where.=" (reseller_services LIKE '".$service.",%' 
	                                     OR reseller_services LIKE '%,".$service."'
	                                     OR reseller_services LIKE '%,".$service.",%'
	                                     OR reseller_services LIKE '".$service."')";
	                                     
				
				}
				if($region == "0" && $service == "0") {
$sql = "SELECT * FROM reseller_reseller
INNER JOIN reseller_reselleraddress
ON reseller_reseller.id=reseller_reselleraddress.reseller_id WHERE  ( store_id LIKE '".$storeid.",%' 
	                                       OR store_id LIKE '%,".$storeid."'
	                                       OR store_id LIKE '%,".$storeid.",%'
	                                       OR store_id LIKE '".$storeid."'  or store_id=0 )"; }
else {
			        $sql = "SELECT *
FROM reseller_reseller
INNER JOIN reseller_reselleraddress
ON reseller_reseller.id=reseller_reselleraddress.reseller_id where".$where;
				}                   
                                $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                                
                                $row =$connection->query($sql)->rowCount();
                               
                                if($row > 0){
								$count=0;
$currentPage = (int) $this->getRequest()->getParam('p', 1);
//$currentPage = $_GET['p'];
$pageSize =Mage::getStoreConfig('reseller/reseller_group/reseller_input');
			        foreach($connection->fetchAll($sql) as $reseller){
					$count=$count+1;
	if(($currentPage-1)*$pageSize<$count && $count<=$currentPage*$pageSize){
	if($count<=$currentPage*$pageSize){
				$servicesid=$reseller['reseller_services'];
				/*$arr=explode( ',', $servicesid );
				if( ($arr[0]==1 || $arr[1]==1 || $arr[2]==1 || $arr[3]==1) { $insta="Installation "; }
			        if( $arr[0]==2 || $arr[1]==2 || $arr[2]==2 || $arr[3]==2) { $Train="Training "; }
			        if( $arr[0]==3 || $arr[1]==3 || $arr[2]==3 || $arr[3]==3) { $hard="Hardware "; }
			        if( $arr[0]==4 || $arr[1]==4 || $arr[2]==4 || $arr[3]==4) { $repair="Repair "; } */
				if($reseller['reseller_img']) {
				$imagedata="<img alt='".$reseller['reseller_img']."' src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."".$reseller['reseller_img']."' height='155' width='150'/>";
				}
				else {
				$imagedata="<img alt='".$reseller['reseller_img']."' src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."/frontend/base/default/images/catalog/product/placeholder/image.jpg' height='155' width='150'/>";
				}
				$countryCode=$reseller['reseller_country'];
$countryName = 
    Mage::getModel('directory/country')->load($countryCode)->getName();
	if($reseller['reseller_region'] == $countryName) { 
				$html .= "<div class='reseller_r'><div class='reseller_image'>".$imagedata."</div>
				               
				          <div class='reseller_text1'><h2>".$reseller['reseller_name']." </h2></div><div class='reseller-description'>".
		                          $reseller['reseller_description']."<br>".
				          $servicesid."<br>".$reseller['reseller_city'].", ".$reseller['reseller_state'].", ".$countryName."</div><div class='reseller_textaddress'><span class='view-website'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/view.png'/><a href='http://".$reseller['reseller_website']."'>View Website</a></span><br><span class='mail-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/mail.png'/><a href='mailto:".$reseller['reseller_email']."'>".$reseller['reseller_email']."</a></span><br><span class='call-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/call.png'/>".$reseller['reseller_phone']."</span></div></div>";
	                }
                 else {
                      $html .= "<div class='reseller_r'><div class='reseller_image'>".$imagedata."</div>
				               
				          <div class='reseller_text1'><h2>".$reseller['reseller_name']." </h2></div><div class='reseller-description'>".
		                          $reseller['reseller_description']."<br>".
				          $servicesid."<br>".$reseller['reseller_region'].", ".$reseller['reseller_city'].", ".$reseller['reseller_state'].", ".$countryName."</div><div class='reseller_textaddress'><span class='view-website'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/view.png'/><a href='http://".$reseller['reseller_website']."'>View Website</a></span><br><span class='mail-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/mail.png'/><a href='mailto:".$reseller['reseller_email']."'>".$reseller['reseller_email']."</a></span><br><span class='call-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/call.png'/>".$reseller['reseller_phone']."</span></div></div>";
	                }				 
				
				}
				}
				}
				$pageTot = ceil( $count / $pageSize );
				$html.="<div class='pagention'>";
    for ( $i=1; $i<=$pageTot; $i++ ) :
        if ( $i == $currentPage ) : 
		$html.="<span>".$i."</span>";  
		else : 
		$state = str_replace(' ',',',$state);
		//$html.="<a onclick=resellers('".$region."','".$service."','".$i."','".$state."')>";
		$html.="<a href='#' onclick=resellers('$region','$service','$i','$state')>";
		$html.=$i.' </a>';
		endif;
    endfor; 
	
$html.="</div>"; 
				}else{
				  $html .= "No Records Found , Try Again ";
				}
				
				
				echo $html;
				
		}
else { $html="";
 $storeid=Mage::app()->getStore()->getId();
$sql = "SELECT *
FROM reseller_reseller
INNER JOIN reseller_reselleraddress
ON reseller_reseller.id=reseller_reselleraddress.reseller_id where  (store_id LIKE '".$storeid.",%' 
	                                       OR store_id LIKE '%,".$storeid."'
	                                       OR store_id LIKE '%,".$storeid.",%'
	                                       OR store_id LIKE '".$storeid."'  or store_id=0 )";
$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                                
                                $row =$connection->query($sql)->rowCount();
                               
                                if($row > 0){
								$count=0;
$currentPage = (int) $this->getRequest()->getParam('p', 1);
//$currentPage = $_GET['p'];
$pageSize =Mage::getStoreConfig('reseller/reseller_group/reseller_input');
			        foreach($connection->fetchAll($sql) as $reseller){
					$count=$count+1;
	if(($currentPage-1)*$pageSize<$count && $count<=$currentPage*$pageSize){
	if($count<=$currentPage*$pageSize){
				$servicesid=$reseller['reseller_services'];
				/*$arr=explode( ',', $servicesid );
				if( ($arr[0]==1 || $arr[1]==1 || $arr[2]==1 || $arr[3]==1) { $insta="Installation "; }
			        if( $arr[0]==2 || $arr[1]==2 || $arr[2]==2 || $arr[3]==2) { $Train="Training "; }
			        if( $arr[0]==3 || $arr[1]==3 || $arr[2]==3 || $arr[3]==3) { $hard="Hardware "; }
			        if( $arr[0]==4 || $arr[1]==4 || $arr[2]==4 || $arr[3]==4) { $repair="Repair "; } */
				if($reseller['reseller_img']) {
				$imagedata="<img alt='".$reseller['reseller_img']."' src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."".$reseller['reseller_img']."' height='155' width='150'/>";
				}
				else {
				$imagedata="<img alt='".$reseller['reseller_img']."' src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."/frontend/base/default/images/catalog/product/placeholder/image.jpg' height='155' width='150'/>";
				}
				$countryCode=$reseller['reseller_country'];
$countryName = 
    Mage::getModel('directory/country')->load($countryCode)->getName();
				if($reseller['reseller_region'] == $countryName) { 
				 $html .= "<div class='reseller_r'><div class='reseller_image'>".$imagedata."</div>
				               
				          <div class='reseller_text1'><h2>".$reseller['reseller_name']." </h2></div><div class='reseller-description'>".
		                          $reseller['reseller_description']."<br>".
				          $servicesid."<br>".$reseller['reseller_city'].", ".$reseller['reseller_state'].", ".$countryName."</div><div class='reseller_textaddress'><span class='view-website'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/view.png'/><a href='http://".$reseller['reseller_website']."'>View Website</a></span><br><span class='mail-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/mail.png'/><a href='mailto:".$reseller['reseller_email']."'>".$reseller['reseller_email']."</a></span><br><span class='call-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/call.png'/>".$reseller['reseller_phone']."</span></div></div>";
	                 }
                 else {
                       $html .= "<div class='reseller_r'><div class='reseller_image'>".$imagedata."</div>
				               
				          <div class='reseller_text1'><h2>".$reseller['reseller_name']." </h2></div><div class='reseller-description'>".
		                          $reseller['reseller_description']."<br>".
				          $servicesid."<br>".$reseller['reseller_region'].", ".$reseller['reseller_city'].", ".$reseller['reseller_state'].", ".$countryName."</div><div class='reseller_textaddress'><span class='view-website'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/view.png'/><a href='http://".$reseller['reseller_website']."'>View Website</a></span><br><span class='mail-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/mail.png'/><a href='mailto:".$reseller['reseller_email']."'>".$reseller['reseller_email']."</a></span><br><span class='call-im'><img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN)."frontend/default/default/images/call.png'/>".$reseller['reseller_phone']."</span></div></div>";
	                }		
				
				}
				}
				}
				$pageTot = ceil( $count / $pageSize );
				$html.="<div class='pagention'>";
    for ( $i=1; $i<=$pageTot; $i++ ) :
        if ( $i == $currentPage ) : 
		$html.="<span>".$i."</span>";  
		else : 
		$html.="<a href='#' onclick=resellers('".$region."','".$service."','".$i."','".$state."')>";
		$html.=$i.' </a>';
		endif;
    endfor; 
	
$html.="</div>"; 
				}else{
				  $html .= "No Records Found , Try Again ";
				}
				
				
				echo $html;


 }
               
    }
   //coded by samanta
}



