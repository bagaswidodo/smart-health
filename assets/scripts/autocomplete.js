//autocomplete script
	$(this).ready( function() {
		$("#lokasi").autocomplete({
  			minLength: 1,
  			source:
    		function(req, add){
      			$.ajax({
	        		url: lokasiJson,
	          		dataType: 'json',
	          		type: 'POST',
	          		data: req,
	          		success:

	            	function(data){
	            		
	              		if(data.response ==true){
	                 		add(data.message);
	                 		
	              		}
	            	},
          		});
     		},
 		 select:
     	 	function(event, ui) {
     	 		$("#terpilih").html(ui.item.value + "(" + ui.item.id + ")");

     	 		$("#latlng").val( ui.item.id );
     	 		var latlng = ui.item.id;
     	 		var latlngs = latlng.split(",");

     	 	},
		});
	});