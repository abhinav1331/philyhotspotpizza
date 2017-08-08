<div class="container1">
	<div class="row">

		<div class="complete-row-extra">
			<div class="col-lg-4">
				<h4>Base</h4>
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
			$extra_base_json = get_post_meta($post_id,'extra_price');
			
			foreach($extra_base_json as $extra_attr) {
				$extra_base = json_decode($extra_attr);
				?>
				<div class="complete-row-extra">
					<div class="col-lg-4">
						<input type="text" name="extra_base[]" placeholder="Extra Base" class="form-control" value="<?php echo $extra_base->extra; ?>">
					</div>
					<div class="col-lg-4">
						<input type="text" name="extra_price[]" class="form-control" placeholder="Price" value="<?php echo $extra_base->prize; ?>">
					</div>
					<div class="col-lg-4">
						<button type="button" class="btn btn-danger" onclick="deleteCurrentRowExtra(this)">Delete</button>
					</div>
				</div>
				<?php
				$index++;
			}
			if($index==0) {
				?>
				<div class="complete-row-extra">
					<div class="col-lg-4">
						<input type="text" name="extra_base[]" placeholder="Extra Base" class="form-control">
					</div>
					<div class="col-lg-4">
						<input type="text" name="extra_price[]" class="form-control" placeholder="Price">
					</div>
					<div class="col-lg-4">
						<button type="button" class="btn btn-danger" onclick="deleteCurrentRowExtra(this)">Delete</button>
					</div>
				</div>
				<?php
			}
		 ?>
		<button type="button" onclick="addExtraAttribute()" class="btn btn-default">Add Row</button>
	</div>
</div>