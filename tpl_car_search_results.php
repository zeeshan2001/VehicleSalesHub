				<div class="box">
						<div class="car-title"><?php echo $search->Fields('vehicle_make')." ".formatModel($search->Fields('model_group'))." ".$search->Fields('description'); ?><br>
					<span><?php echo formatTree($search->Fields('vehicle_tree_description')); ?></span></div>
						<div class="car-image">
								<div class="car-image-container"><img src="img/cars/thumbs/<?php echo $search->Fields('image_filename'); ?>" alt="<?php echo $search->Fields('vehicle_make')." ".formatModel($search->Fields('model_group'))." ".$search->Fields('description')." ".formatTree($search->Fields('vehicle_tree_description')); ?>car deal" width="300" height="200"> </div>
								<a href="/vehicle/<?php echo $makeOutput.'/'.formatSlug($search->Fields('long_description')).'/'.strtolower($search->Fields('model_year')); ?>" class="more-details">
								<div class="more-details-button"><i class="fas fa-info-circle"> </i> <span> view deal</span></div>
								</a> </div>
						<div class="car-price"><i class="fas fa-tag"></i> OUR PRICE £<?php echo number_format($search->Fields('basic_price')); ?></div>
						<div class="car-saving"><i class="fas fa-check-square"></i> SAVE £3,999 OFF RRP</div>
				</div>
