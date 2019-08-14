function resellers(region,service,page,state)
{
var url              =  "reseller/index/searchReseller";
var state=state.replace(","," ");
jQuery('#ajax_loader').show();
//alert(state);
jQuery.ajax({
         	 url: url,
         	// datatype:"json",
          	data:{ region: region,service: service,p: page,state: state},
          	success: function(html){
                   jQuery('#ajax_loader').hide();
                    jQuery("#show_total").hide();
                    jQuery("#show_result").html(html).show();
                    
          	}
  
   	 });

}


