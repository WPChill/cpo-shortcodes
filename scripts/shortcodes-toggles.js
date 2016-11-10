jQuery(document).ready(function(){
   //Accordions
	if(jQuery('.ctsc-accordion').length){
		jQuery('.ctsc-accordion').each(function(){
			var accordion = jQuery(this);
			
			accordion.find('.ctsc-accordion-title').on("click touchstart", function(e){
				//Get accordion group, close all others with the same group
				var accordion_group = accordion.data('group');
				if(accordion_group){
					jQuery('.ctsc-accordion[data-group=' + accordion_group + ']').find('.ctsc-accordion-content').slideUp(300);
					jQuery('.ctsc-accordion[data-group=' + accordion_group + ']').removeClass('ctsc-accordion-open');
				}
				if(!accordion.find('.ctsc-accordion-content').is(':visible')){
					accordion.find('.ctsc-accordion-content').slideDown(300);
					accordion.addClass('ctsc-accordion-open');
				}else{
					accordion.find('.ctsc-accordion-content').slideUp(300);
					accordion.removeClass('ctsc-accordion-open');				
				}
				e.preventDefault(); 
			});
		});
	}
	
	//Tabs
	jQuery('.ctsc-tablist').tabs();
});