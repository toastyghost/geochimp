$(function() {
	
	$('#subscribe').on('click', function() {
		navigator.geolocation.getCurrentPosition( function(position) {
		
			var geocoder = new google.maps.Geocoder(),
				latlng = new google.maps.LatLng(
					position.coords.latitude,
					position.coords.longitude
				);
			
			geocoder.geocode({ 'latLng': latlng}, function(results, status) {
				
				for (var i = 0; i < results[0].address_components.length; ++i) {
					if (results[0].address_components[i].types.indexOf('administrative_area_level_3') !== -1) {
						document.getElementById('city').value = results[0].address_components[i].short_name;
					}
					
					if (results[0].address_components[i].types.indexOf('country') !== -1) {
						document.getElementById('country').value = results[0].address_components[i].long_name;
					}
				}
			});
		});
		
		$.ajax({
			type: 'post',
			url: 'subscribe.php',
			
			data: {
				email: document.getElementById('email').value,
				city: document.getElementById('city').value,
				country: document.getElementById('country').value
			},
			
			success: function(data, textStatus, jqXHR) {
				alert(data);
			}
		})
	});
});
