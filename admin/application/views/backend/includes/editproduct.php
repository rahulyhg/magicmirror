	    <section class="panel">
		    <header class="panel-heading">
				 Product Details
			</header>
			<div class="panel-body">
				<form class="form-horizontal row-fluid" method="post" action="<?php echo site_url('site/editproductsubmit');?>" enctype= "multipart/form-data">
					<div class="form-row control-group row-fluid" style="display:none;">
						<label class="control-label span3" for="normal-field">ID</label>
						<div class="controls span9">
						  <input type="text" id="normal-field" class="row-fluid" name="id" value="<?php echo $before['product']->id;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name',$before['product']->name);?>">
						</div>
					</div>		
					<div class="form-group">
						<label class="col-sm-2 control-label">SKU</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="sku" value="<?php echo set_value('sku',$before['product']->sku);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-4">
						  <textarea name="description" class="form-control"><?php echo set_value('description',$before['product']->description); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">URL</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="url" value="<?php echo set_value('url',$before['product']->url);?>">
						</div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Visibility</label>
					  <div class="col-sm-4">
						<?php
							
							echo form_dropdown('visibility',$visibility,set_value('visibility',$before['product']->visibility),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
						?>
					  </div>
					</div>
					<div class="hidden">
					<div class="form-group">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="price" value="<?php echo set_value('price',$before['product']->price);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Wholesale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="wholesaleprice" value="<?php echo set_value('wholesaleprice',$before['product']->wholesaleprice);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">First sale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="firstsaleprice" value="<?php echo set_value('firstsaleprice',$before['product']->firstsaleprice);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Second Sale Price</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="secondsaleprice" value="<?php echo set_value('secondsaleprice',$before['product']->secondsaleprice);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Special price from</label>
						<div class="col-sm-4">
						  <input type="date" id="normal-field" class="form-control" name="specialpricefrom" value="<?php echo set_value('specialpricefrom',$before['product']->specialpricefrom);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Special price to</label>
						<div class="col-sm-4">
						  <input type="date" id="normal-field" class="form-control" name="specialpriceto" value="<?php echo set_value('specialpriceto',$before['product']->specialpriceto);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Related Product</label>
						<div class="col-sm-4">
						   <?php 
								echo form_multiselect('relatedproduct[]',$relatedproduct,set_value('relatedproduct',$before['related_product']),'id="select2" class="form-control populate placeholder select2-offscreen"');
								 
							?>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Category</label>
						<div class="col-sm-4">
						   <?php 
								echo form_multiselect('category[]',$category,set_value('category',$before['product_category']),'id="select1" class="form-control populate placeholder select2-offscreen"');
								 
							?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Title</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="metatitle" value="<?php echo set_value('metatitle',$before['product']->metatitle);?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Desc</label>
						<div class="col-sm-4">
						  <textarea name="metadesc" class="form-control"><?php echo set_value('metadesc',$before['product']->metadesc); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Meta Keyword</label>
						<div class="col-sm-4">
						  <textarea name="metakeyword" class="form-control"><?php echo set_value('metakeyword',$before['product']->metakeyword); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Quantity</label>
						<div class="col-sm-4">
						  <input type="text" id="normal-field" class="form-control" name="quantity" value="<?php echo set_value('quantity',$before['product']->quantity);?>">
						</div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Status</label>
					  <div class="col-sm-4">
						<?php
							
							echo form_dropdown('status',$status,set_value('status',$before['product']->status),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
						?>
					  </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-4">	
							<button type="submit" class="btn btn-info">Submit</button>
							<a href="<?php echo site_url('site/viewproduct'); ?>" type="submit" class="btn btn-info">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</section>
    