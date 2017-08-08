<div class="container1">
					<div class="row">

						<div class="complete-row">
							<div class="col-lg-4">
								<h4>Size</h4>
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
							$size_price_json = get_post_meta($post_id,'size_price');
							
							foreach($size_price_json as $size_attr) {
								$size_price = json_decode($size_attr);
								?>
								<div class="complete-row">
									<div class="col-lg-4">
										<select name="size[]" id="size" class="form-control">
											<option <?php if($size_price->size == "small") { echo "selected"; } ?> value="small">Small</option>
											<option <?php if($size_price->size == "medium") { echo "selected"; } ?> value="medium">Medium</option>
											<option <?php if($size_price->size == "large") { echo "selected"; } ?> value="large">large</option>
										</select>
									</div>
									<div class="col-lg-4">
										<input type="text" name="size_price[]" class="form-control" placeholder="Price" value="<?php echo $size_price->prize; ?>">
									</div>
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" onclick="deleteCurrentRowSize(this)">Delete</button>
									</div>
								</div>
								<?php
								$index++;
							}
							if($index==0) {
								?>
								<div class="complete-row">
									<div class="col-lg-4">
										<select name="size[]" id="size" class="form-control">
											<option value="small">Small</option>
											<option value="medium">Medium</option>
											<option value="Large">large</option>
										</select>
									</div>
									<div class="col-lg-4">
										<input type="text" name="size_price[]" class="form-control" placeholder="Price">
									</div>
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" onclick="deleteCurrentRowSize(this)">Delete</button>
									</div>
								</div>
								<?php
							}
						 ?>
						<button type="button" onclick="addSizeAttribute()" class="btn btn-default">Add Row</button>
					</div>
				</div>