jQuery(document).ready(function(){
    	
	jQuery('.ctsc-map').each(function() {
		var data = jQuery(this).data(), // Get the data from this element
		options = { // Create map options object
			center: new google.maps.LatLng(data.lat, data.lng),
			disableDefaultUI: data.controls || false,
			zoom: data.zoom || 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var styles = [{
			stylers: [{ hue: data.color }, { saturation: -20 }]
		},{
			featureType: "road",
			elementType: "labels",
			stylers: [{ visibility: "off" }]
		}];

		// Create and display the map
		var map = new google.maps.Map(this, options);
		map.setOptions({styles: styles});
	});
	
	//FADE IN ELEMENTS WHEN SCROLLING
	ctsc_waypoint_fade();
	
	//FILL PROGRESS BARS
	ctsc_waypoint_progress();
	
	//SKIPPING BUTTONS
	//Adds smooth scrolling to an anchor link with the specified class
	jQuery('.ctsc-back-top').click(function(e){
		e.preventDefault();
		var target_id = jQuery(this).attr('href');
		jQuery('html, body').animate({
			scrollTop: jQuery(target_id).offset().top
		}, 1000);
	});
});


function ctsc_waypoint_fade(){
	if(jQuery.isFunction(jQuery.fn.waypoint)){
		jQuery('.ctsc-animation').waypoint(function(){ 
			var area_delay = 0;
			var element = jQuery(this);
			if(jQuery(this).attr('data-delay'))	area_delay = jQuery(this).attr('data-delay');
			setTimeout(function(){ element.addClass('ctsc-animation-active'); }, area_delay);
		},{ offset:'80%' });
	}
}

function ctsc_waypoint_progress(){
	if(jQuery.isFunction(jQuery.fn.waypoint)){
		jQuery('.ctsc-progress .bar-content').waypoint(function(){ 
			var element = jQuery(this);
			var progress_data = element.data();
			element.animate({ width: progress_data.value + '%' }, 1500);
		},{ 
			offset:'95%'
		});
	}
}