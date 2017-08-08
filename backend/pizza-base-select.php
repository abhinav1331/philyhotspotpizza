<div class="container1">
					<div class="row">

						<div class="complete-row-base">
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
							$size_base_json = get_post_meta($post_id,'base_price');
							
							foreach($size_base_json as $size_attr) {
								$size_base = json_decode($size_attr);
								?>
								<div class="complete-row-base">
									<div class="col-lg-4">
										<input type="text" name="pizza_base[]" placeholder="Pizza Base" class="form-control" value="<?php echo $size_base->base; ?>">
									</div>
									<div class="col-lg-4">
										<input type="text" name="base_price[]" class="form-control" placeholder="Price" value="<?php echo $size_base->prize; ?>">
									</div>
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" onclick="deleteCurrentRowBase(this)">Delete</button>
									</div>
								</div>
								<?php
								$index++;
							}
							if($index==0) {
								?>
								<div class="complete-row-base">
									<div class="col-lg-4">
										<input type="text" name="pizza_base[]" placeholder="Pizza Base" class="form-control">
									</div>
									<div class="col-lg-4">
										<input type="text" name="base_price[]" class="form-control" placeholder="Price">
									</div>
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" onclick="deleteCurrentRowBase(this)">Delete</button>
									</div>
								</div>
								<?php
							}
						 ?>
						<button type="button" onclick="addBaseAttribute()" class="btn btn-default">Add Row</button>
					</div>
				</div>