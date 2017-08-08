<div class="container1">
	<div class="row">

		<div class="complete-row-toppings">
			<div class="col-lg-4">
				<h4>Toppings</h4>
			</div>
			<div class="col-lg-4">
				<h4>Price</h4>
			</div>
			<div class="col-lg-4">
				<h4>Delete</h4>
			</div>
		</div>
		<?php 
		$index = 0;
			$toppings_json = get_post_meta($post_id,'toppings_price');
			
			foreach($toppings_json as $toppings_attr) {
				$toppings_pizza = json_decode($toppings_attr);
				?>
				<div class="complete-row-toppings">
					<div class="col-lg-3">
						<select name="sizeToppings[]" id="size" class="form-control">
							<option <?php if($size_price->size == "small") { echo "selected"; } ?> value="small">Small</option>
							<option <?php if($size_price->size == "medium") { echo "selected"; } ?> value="medium">Medium</option>
							<option <?php if($size_price->size == "large") { echo "selected"; } ?> value="large">large</option>
						</select>
					</div>
					<div class="col-lg-3">
						<input type="text" name="toppings_base[]" placeholder="Toppings" class="form-control" value="<?php echo $toppings_pizza->toppings; ?>">
					</div>
					<div class="col-lg-3">
						<input type="text" name="toppings_price[]" class="form-control" placeholder="Price" value="<?php echo $toppings_pizza->prize; ?>">
					</div>
					<div class="col-lg-3">
						<button type="button" class="btn btn-danger" onclick="deleteCurrentRowToppings(this)">Delete</button>
					</div>
				</div>
				<?php
				$index++;
			}
			if($index==0) {
				?>
				<div class="complete-row-toppings">
					<div class="col-lg-4">
						<input type="text" name="toppings_base[]" placeholder="Toppings" class="form-control">
					</div>
					<div class="col-lg-4">
						<input type="text" name="toppings_price[]" class="form-control" placeholder="Price">
					</div>
					<div class="col-lg-4">
						<button type="button" class="btn btn-danger" onclick="deleteCurrentRowToppings(this)">Delete</button>
					</div>
				</div>
				<?php
			}
		 ?>
		<button type="button" onclick="addToppingsAttribute()" class="btn btn-default">Add Row</button>
	</div>
</div>