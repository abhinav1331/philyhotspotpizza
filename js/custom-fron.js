
jQuery(document).ready(function(){
	jQuery('#lightgallery').lightGallery();
});


function AddToCart() {
	var admin_url = jQuery("input[name='admin_url']").val();
	var cartURL = jQuery("input[name='cartURL']").val();
	jQuery.ajax({
		type: "POST",
		url: admin_url+"/order_now.php", 
		data:jQuery("#add_to_cart").serialize(),
		success:function(resp){
			 window.location.href = cartURL; 
		}
	});
}

jQuery(document).ready(function(){
	jQuery("input[name='base_size']").change(function(){
		var priceSection = jQuery(this).siblings("input[name='base_price']").val();
		var priceBase = jQuery(this).val();
		var Count = 0;
		jQuery("input[name='base_toppings']:checked").each(function(){
			Count = parseInt(Count) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var ExtraCount = 0;
		jQuery("input[name='extra_toppings']:checked").each(function(){
			ExtraCount = parseInt(ExtraCount) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var basePrice = jQuery("input[name='base_base']:checked").siblings("input[name='base_price']").val();
		if(basePrice != "") {
			basePrice = 0;
		}
		var FinalPrice = parseInt(basePrice) + parseInt(priceSection) + parseInt(Count) + parseInt(ExtraCount);
		jQuery(".myPrice").text(FinalPrice);
		jQuery("input[name='pizza_final']").val(FinalPrice);
		jQuery(".Addto-cart").removeAttr("disabled");
		jQuery(".extra").show();
		var base_size_price = {};
		base_size_price["name"] = priceBase;
		base_size_price["price"] = priceSection;
		base_size_price = JSON.stringify(base_size_price);
		jQuery("input[name='pizza_size']").val(base_size_price);
	});

	jQuery("input[name='base_base']").change(function(){
		
		var Count = 0;
		jQuery("input[name='base_toppings']:checked").each(function(){
			Count = parseInt(Count) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var ExtraCount = 0;
		jQuery("input[name='extra_toppings']:checked").each(function(){
			ExtraCount = parseInt(ExtraCount) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var basePrice = jQuery(this).siblings("input[name='base_price']").val();
		if(basePrice == "") {
			basePrice = 0;
		}
		var priceBase = jQuery(this).val();
		var priceSection = jQuery("input[name='base_size']:checked").siblings("input[name='base_price']").val();
		var FinalPrice = parseInt(basePrice) + parseInt(priceSection) + parseInt(Count) + parseInt(ExtraCount);
		jQuery(".myPrice").text(FinalPrice);
		jQuery("input[name='pizza_final']").val(FinalPrice);
		var base_base_price = {};
		base_base_price["name"] = priceBase;
		base_base_price["price"] = basePrice;
		base_base_price = JSON.stringify(base_base_price);
		jQuery("input[name='pizza_base']").val(base_base_price);

	});
	jQuery("input[name='base_toppings']").change(function(){
		var Count = 0;
		var base_toppings = [];
		jQuery("input[name='base_toppings']:checked").each(function(){
			var data = {};
			var price = jQuery(this).siblings("input[name='base_price']").val();
			var toppings = jQuery(this).val();
			data["name"] = toppings;
			data["price"] = price;
			base_toppings.push(data);
			Count = parseInt(Count) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		base_toppings = JSON.stringify(base_toppings);
		/*console.log(base_toppings);*/
		jQuery("input[name='pizza_toppings']").val(base_toppings);
		var ExtraCount = 0;
		jQuery("input[name='extra_toppings']:checked").each(function(){
			ExtraCount = parseInt(ExtraCount) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var basePrice = jQuery("input[name='base_base']:checked").siblings("input[name='base_price']").val();
		if(basePrice != "") {
			basePrice = 0;
		}
		var priceSection = jQuery("input[name='base_size']:checked").siblings("input[name='base_price']").val();
		var FinalPrice = parseInt(basePrice) + parseInt(priceSection) + parseInt(Count) + parseInt(ExtraCount);
		jQuery(".myPrice").text(FinalPrice);
		jQuery("input[name='pizza_final']").val(FinalPrice);

	});

	jQuery("input[name='extra_toppings']").change(function(){
		var Count = 0;
		jQuery("input[name='base_toppings']:checked").each(function(){
			Count = parseInt(Count) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});
		var ExtraArray = [];
		var ExtraCount = 0;
		jQuery("input[name='extra_toppings']:checked").each(function(){

			var data = {};
			var price = jQuery(this).siblings("input[name='base_price']").val();
			var extraings = jQuery(this).val();
			data["name"] = extraings;
			data["price"] = price;
			ExtraArray.push(data);
			ExtraCount = parseInt(ExtraCount) + parseInt(jQuery(this).siblings("input[name='base_price']").val());
		});

		ExtraArray = JSON.stringify(ExtraArray);
		jQuery("input[name='pizza_extra']").val(ExtraArray);
		var basePrice = jQuery("input[name='base_base']:checked").siblings("input[name='base_price']").val();
		if(basePrice != "") {
			basePrice = 0;
		}
		var priceSection = jQuery("input[name='base_size']:checked").siblings("input[name='base_price']").val();
		var FinalPrice = parseInt(basePrice) + parseInt(priceSection) + parseInt(Count) + parseInt(ExtraCount);
		jQuery(".myPrice").text(FinalPrice);
		jQuery("input[name='pizza_final']").val(FinalPrice);

	});
});


/*jQuery(document).ready(function(){
	jQuery(".minusBtn").each(function(){
		jQuery(this).click(function(){
			var currentQuantity = jQuery(this).siblings(".product_quantity").val();
			alert(currentQuantity);
			if(currentQuantity <= 1) {
				var addedQuantity = parseInt(currentQuantity) - 1;
				jQuery(this).siblings(".product_quantity").val(addedQuantity);
			}
		});
	});
});*/
function minusBtn(event) {
	var order_id = jQuery(event).siblings("input[name='order_id']").val();
	var currentQuantity = jQuery(event).siblings(".product_quantity").val();
		if(parseInt(currentQuantity) > 1) {
			var addedQuantity = parseInt(currentQuantity) - 1;
			jQuery(event).siblings(".product_quantity").val(addedQuantity);
				var admin_url = jQuery("input[name='admin_url']").val();
				jQuery.ajax({
					type: "POST",
					url: admin_url+"/order_update.php", 
					data:{addedQuantity:addedQuantity,order_id:order_id},
					success:function(resp){
						var mySinglePrice = parseInt(resp);
						var finalTest = parseInt(addedQuantity) * mySinglePrice;
						jQuery(event).parent().parent().siblings(".w4").find("p").find("strong").text(finalTest);
						var MyTotal = 0;
						jQuery(".w4").each(function(){
							var thisTotal = jQuery(this).find("p").find("strong").text();
							MyTotal = parseInt(MyTotal) + parseInt(thisTotal);
						});
						jQuery(".MyTotal").text(MyTotal)
						jQuery(".netAmount").text(MyTotal);
						var myVal = jQuery("input[name='taxName']").val();
						var taxInc = jQuery("input[name='taxInc']").val();
						if(myVal != "") {
							var res = myVal.split(",");
							var restaxInc = taxInc.split(",");
							var i;
							var taxes = 0;
							for (i = 0; i < res.length; ++i) {
								    /*alert(res[i]);
								    alert(restaxInc[i]);*/
								    var myonepercent = parseInt(MyTotal) / 100;
								    var fnAmount = parseInt(myonepercent) * parseInt(restaxInc[i]);								    jQuery(".TaxInc:eq("+i+")").find("#vat_review_page").find(".netTax").text(fnAmount);
								    taxes = parseInt(taxes) + parseInt(fnAmount);
								}
						}
						var finalAmount = parseInt(MyTotal) + parseInt(taxes);
						jQuery(".netGrand").text(finalAmount);
						toastr.success("Cart is updated")
					}
				});
		}
}
function plusBtn(event) {
	var order_id = jQuery(event).siblings("input[name='order_id']").val();
	var currentQuantity = jQuery(event).siblings(".product_quantity").val();
		if(parseInt(currentQuantity) < 9) {
			var addedQuantity = parseInt(currentQuantity) + 1;
			jQuery(event).siblings(".product_quantity").val(addedQuantity);
			var admin_url = jQuery("input[name='admin_url']").val();
				jQuery.ajax({
					type: "POST",
					url: admin_url+"/order_update.php", 
					data:{addedQuantity:addedQuantity,order_id:order_id},
					success:function(resp){
						var mySinglePrice = parseInt(resp);
						var finalTest = parseInt(addedQuantity) * mySinglePrice;
						jQuery(event).parent().parent().siblings(".w4").find("p").find("strong").text(finalTest);
						var MyTotal = 0;
						jQuery(".w4").each(function(){
							var thisTotal = jQuery(this).find("p").find("strong").text();
							MyTotal = parseInt(MyTotal) + parseInt(thisTotal);
						});
						jQuery(".MyTotal").text(MyTotal)
						jQuery(".netAmount").text(MyTotal);
						var myVal = jQuery("input[name='taxName']").val();
						var taxInc = jQuery("input[name='taxInc']").val();
						if(myVal != "") {
							var res = myVal.split(",");
							var restaxInc = taxInc.split(",");
							var i;
							var taxes = 0;
							for (i = 0; i < res.length; ++i) {
								    /*alert(res[i]);
								    alert(restaxInc[i]);*/
								    var myonepercent = parseInt(MyTotal) / 100;
								    var fnAmount = parseInt(myonepercent) * parseInt(restaxInc[i]);								    jQuery(".TaxInc:eq("+i+")").find("#vat_review_page").find(".netTax").text(fnAmount);
								    taxes = parseInt(taxes) + parseInt(fnAmount);
								}
						}
						var finalAmount = parseInt(MyTotal) + parseInt(taxes);
						jQuery(".netGrand").text(finalAmount);
						toastr.success("Cart is updated");
					}
				});
		}
}

function deleteCart(event) {
	var admin_url = jQuery("input[name='admin_url']").val();
	var order_id = jQuery(event).siblings("input[name='order_idd']").val();
	jQuery.ajax({
		type: "POST",
		url: admin_url+"/delete_order_update.php", 
		data:{order_id:order_id},
		success:function(resp){
			jQuery(event).parent().remove();
			var countCart = jQuery(".order_items1").length;
			if(countCart == 0) {
				jQuery(".container").empty().append("<h2>Cart is Empty</h2>");
				// jQuery.removeCookie('myCookies', { path: '/' });
				jQuery.cookie("myCookies", null);
			} else {
				 myCalucaltion();
			}
			toastr.success("Cart Deleted");
		}
	});
}

jQuery(document).ready(function(){
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
});

function myCalucaltion() {
	var MyTotal = 0;
	jQuery(".w4").each(function(){
		var thisTotal = jQuery(this).find("p").find("strong").text();
		MyTotal = parseInt(MyTotal) + parseInt(thisTotal);
	});
	jQuery(".MyTotal").text(MyTotal)
	jQuery(".netAmount").text(MyTotal);
	var myVal = jQuery("input[name='taxName']").val();
	var taxInc = jQuery("input[name='taxInc']").val();
	if(myVal != "") {
		var res = myVal.split(",");
		var restaxInc = taxInc.split(",");
		var i;
		var taxes = 0;
		for (i = 0; i < res.length; ++i) {
			    /*alert(res[i]);
			    alert(restaxInc[i]);*/
			    var myonepercent = parseInt(MyTotal) / 100;
			    var fnAmount = parseInt(myonepercent) * parseInt(restaxInc[i]);								    jQuery(".TaxInc:eq("+i+")").find("#vat_review_page").find(".netTax").text(fnAmount);
			    taxes = parseInt(taxes) + parseInt(fnAmount);
			}
	}
	var finalAmount = parseInt(MyTotal) + parseInt(taxes);
	jQuery(".netGrand").text(finalAmount);
}

jQuery(document).ready(function(){
 myCalucaltion();
});

function getlatlong(event) {
	jQuery.ajax({
       url : "http://maps.googleapis.com/maps/api/geocode/json?address=santa+cruz&components=postal_code:"+event+"&sensor=false",
       method: "POST",
       success:function(data){
       		if(data.status != "ZERO_RESULTS") {
	           latitude = data.results[0].geometry.location.lat;
	           longitude= data.results[0].geometry.location.lng;
	           var latitudeRest = jQuery("input[name='latitudeRest']").val();
	           var longitudeRest = jQuery("input[name='longitudeRest']").val();
	           var distanceVar = distance(latitudeRest,longitudeRest,latitude,longitude,"M");
	           if(distanceVar < 2.5) {
	           	jQuery(".deliveryMethod").show();
	           	jQuery("#homeDelivery").show();
	           	jQuery("#homeDeliveryLabel").show();
	           } else {
	           	toastr.error("Your Address is not in our Delivery Zone");
	           	jQuery(".deliveryMethod").show();
	           	jQuery("#homeDelivery").hide();
	           	jQuery("#homeDeliveryLabel").hide();
	           }
       		}
       }

    });
}

function distance(lat1, lon1, lat2, lon2, unit) {
	var radlat1 = Math.PI * lat1/180
	var radlat2 = Math.PI * lat2/180
	var theta = lon1-lon2
	var radtheta = Math.PI * theta/180
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	dist = Math.acos(dist)
	dist = dist * 180/Math.PI
	dist = dist * 60 * 1.1515
	if (unit=="K") { dist = dist * 1.609344 }
	if (unit=="N") { dist = dist * 0.8684 }
	return dist
}

jQuery(document).ready(function(){
	jQuery("input[name='zip']").keyup(function(){
		var zip = jQuery(this).val();
		if(zip == "") {
	        jQuery(".deliveryMethod").hide();
		} else {
			getlatlong(zip);
		}
	});
});
