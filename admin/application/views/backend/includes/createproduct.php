<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				 Product Details
			</header>
			<div class="panel-body">
				<form class="form-horizontal row-fluid" method="post" action="<?php echo site_url('site/createproductsubmit');?>" >
					<div class="form-group">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">SKU</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="sku" value="<?php echo set_value('sku');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-4">
						  <textarea name="description" class="form-control"><?php echo set_value('description'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">URL</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="url" value="<?php echo set_value('url');?>">
						</div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Visibility</label>
					  <div class="col-sm-4">
						<?php
							
							echo form_dropdown('visibility',$visibility,set_value('visibility'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
						?>
					  </div>
					</div>
					<div class="hidden">
					<div class="form-group">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="price" value="<?php echo set_value('price');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Wholesale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="wholesaleprice" value="<?php echo set_value('wholesaleprice');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">First sale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="firstsaleprice" value="<?php echo set_value('firstsaleprice');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Second Sale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="secondsaleprice" value="<?php echo set_value('secondsaleprice');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Special price from</label>
						<div class="col-sm-4">
						  <input type="date" id="normal-field" class="form-control" name="specialpricefrom" value="<?php echo set_value('specialpricefrom');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Special price to</label>
						<div class="col-sm-4">
						  <input type="date" id="normal-field" class="form-control" name="specialpriceto" value="<?php echo set_value('specialpriceto');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Related Product</label>
						<div class="col-sm-4">
						   <?php 
								echo form_multiselect('relatedproduct[]',$relatedproduct,set_value('relatedproduct'),'id="select2" class="form-control populate placeholder select2-offscreen"');
								 
							?>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Category</label>
						<div class="col-sm-4">
						   <?php 
								echo form_multiselect('category[]',$category,set_value('category'),'id="select1" class="form-control populate placeholder select2-offscreen"');
								 
							?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Title</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="metatitle" value="<?php echo set_value('metatitle');?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Desc</label>
						<div class="col-sm-4">
						  <textarea name="metadesc" class="form-control"><?php echo set_value('metadesc'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Keyword</label>
						<div class="col-sm-4">
						  <textarea name="metakeyword" class="form-control"><?php echo set_value('metakeyword'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Quantity</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="quantity" value="<?php echo set_value('quantity');?>">
						</div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Status</label>
					  <div class="col-sm-4">
						<?php
							
							echo form_dropdown('status',$status,set_value('status'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
						?>
					  </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-4">	
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</section>
    </div>
</div>