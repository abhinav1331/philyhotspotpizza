function addSizeAttribute() {
	var CountElement = jQuery(".complete-row").length;
	if(CountElement < 4) {
		jQuery( "<div class='complete-row'><div class='col-lg-4'><select name='size[]' id='size' class='form-control'><option value='small'>Small</option><option value='medium'>Medium</option><option value='Large'>large</option></select></div><div class='col-lg-4'><input type='text' name='size_price[]' class='form-control' placeholder='Price'></div><div class='col-lg-4'><button type='button' class='btn btn-danger'  onclick='deleteCurrentRowSize(this)'>Delete</button></div></div>" ).insertAfter( ".complete-row:last" );
	} else {
		toastr.error("You Have used all the 3 sizes");
	}
}
function addBaseAttribute() {
	jQuery( "<div class='complete-row-base'><div class='col-lg-4'><input type='text' name='pizza_base[]' placeholder='Pizza Base' class='form-control'></div><div class='col-lg-4'><input type='text' name='base_price[]' class='form-control' placeholder='Price'></div><div class='col-lg-4'><button type='button' class='btn btn-danger' onclick='deleteCurrentRowBase(this)'>Delete</button></div></div>" ).insertAfter( ".complete-row-base:last" );
}
function addToppingsAttribute() {
	jQuery( "<div class='complete-row-base'><div class='col-lg-4'><input type='text' name='toppings_base[]' placeholder='Toppings' class='form-control'></div><div class='col-lg-4'><input type='text' name='toppings_price[]' class='form-control' placeholder='Price'></div><div class='col-lg-4'><button type='button' class='btn btn-danger' onclick='deleteCurrentRowToppings(this)'>Delete</button></div></div>" ).insertAfter( ".complete-row-toppings:last" );
}
function addExtraAttribute() {
	jQuery( "<div class='complete-row-extra'><div class='col-lg-4'><input type='text' name='extra_base[]' placeholder='Extra Base' class='form-control'></div><div class='col-lg-4'><input type='text' name='extra_price[]' class='form-control' placeholder='Price'></div><div class='col-lg-4'><button type='button' class='btn btn-danger' onclick='deleteCurrentRowExtra(this)'>Delete</button></div></div>" ).insertAfter( ".complete-row-extra:last" );
}


function deleteCurrentRowSize(event) {
	jQuery(event).parent().parent().remove();
}
function deleteCurrentRowBase(event) {
	jQuery(event).parent().parent().remove();
}
function deleteCurrentRowToppings(event) {
	jQuery(event).parent().parent().remove();
}
function deleteCurrentRowExtra(event) {
	jQuery(event).parent().parent().remove();
}


function addTaxCurrentSection() {
	jQuery("<div class='row myRow'> <div class='col-lg-3'><input type='text' class='form-control' name='taxName[]'></div><div class='col-lg-3'><input type='text' class='form-control' name='taxPercent[]'></div><div class='col-lg-3'><button type='button' class='btn-danger btn'> DELETE</button></div></div>").insertAfter(".myRow:last");
}



jQuery(function($) {
	jQuery('#add_to_tax').validate({
		
		rules: {
			"taxName[]": {
				required: true
			},
			"taxPercent[]": {
				required: true
			}
		},
		submitHandler: function(form) {
			var myPluginURL = jQuery("input[name='myPluginURL']").val();
			jQuery(form).ajaxSubmit({
				type: "POST",
				data: jQuery(form).serialize(),
				url: myPluginURL+'templates/addTaxes.php', 
				success: function(data)  {
					toastr.success("Taxes Added");
				}
			});
		}
		
	});
});

jQuery(function($) {
	jQuery('#add_locations').validate({
		
		rules: {
			"longitude": {
				required: true
			},
			"longitude": {
				required: true
			}
		},
		submitHandler: function(form) {
			var myPluginURL = jQuery("input[name='myPluginURL']").val();
			jQuery(form).ajaxSubmit({
				type: "GET",
				data: jQuery(form).serialize(),
				url: myPluginURL+'templates/addLocations.php', 
				success: function(data)  {
					toastr.success("Location Added");
				}
			});
		}
		
	});
});


function deleteRec(event) {
	jQuery(event).parent().parent().remove();
}


jQuery(document).ready(function(){
	jQuery("#stripe").click(function(){
		if (jQuery(this).is(':checked')) {
			var status = jQuery("input[name='httpsStatus']").val();
			if(status == "no") {
				toastr.error("Before Activating the Stripe Payment method, please enable the server.");
				jQuery(this).removeAttr("checked");
			}
		}
	});
});







