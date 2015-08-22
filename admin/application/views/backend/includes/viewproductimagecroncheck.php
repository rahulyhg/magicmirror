<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
                Product Image Reorder With Timestamp Details
            </header>
			<table class="table table-striped table-hover border-top " id="sample_1" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<!--<th>Id</th>-->
					<th>Product</th>
					<th>Message</th>
					<th>Timestamp</th>
				</tr>
			</thead>
			<tbody>
			   <?php foreach($table as $row) { ?>
					<tr>
						<!--<td><?php echo $row->id; ?></td>-->
						<td><?php echo $row->productname." ".$row->sku; ?></td>
						<td><?php echo $row->message; ?></td>
						<td><?php echo $row->timestamp; ?></td>
						
					</tr>
					<?php } ?>
			</tbody>
			</table>
		</section>
	</div>
  </div>