<?php
class Ktree_Reseller_Helper_Data extends Mage_Core_Helper_Abstract
{

public function countrydropdown()
     {
$storeid=Mage::app()->getStore()->getId();
$countryhtml="";
     $read= Mage::getSingleton('core/resource')->getConnection('core_read');
				    $value=$read->query("SELECT Distinct(reseller_country) FROM reseller_reselleraddress"); 
					$rows = $value->fetchAll(); 
                     $countryhtml.='<select name="region" id="region" class="regionstate">';
				$countryhtml.='<option value="0" selected>All</option>';	
					foreach($rows as $row ) {
					 $countryCode=$row['reseller_country'];
$countryName = Mage::getModel('directory/country')->load($countryCode)->getName();
					
					$countryhtml.='<option value="'.$row['reseller_country'].'">'.$countryName.'</option>'; 
                    	 } 
                    $countryhtml.='</select>';
return $countryhtml;
     }
/*public function statedropdown($country)
     {
$statehtml="";
     $read= Mage::getSingleton('core/resource')->getConnection('core_read');
				    
$sql="SELECT * FROM ktree_reseller where".$country;
$value=$read->query($sql); 
					$rows = $value->fetchAll(); 
                     $statehtml.='<select name="region" id="region">';
				$statehtml.='<option value="0" selected>All</option>';	
					foreach($rows as $row ) {
					 					
					$countryhtml.='<option value="'.$row['reseller_state'].'">'.$row['reseller_state'].'</option>'; 
                    	 } 
                    $statehtml.='</select>';
return $statehtml;
     }*/

}
