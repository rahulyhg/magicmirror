<div class="row" style="padding:1% 0;">
<?php
$pageno=$this->input->get('pageno');
if($pageno=="")
{
$pageno=1;
}
echo $pageno;
echo $count;
if($pageno==1)
{
    ?>
<div class="col-md-7">
		<div class=" pull-right col-md-1 createbtn" ><a class="btn btn-primary" href="<?php echo site_url('site/productimagereorder?pageno='.$pageno); ?>"><i class="icon-plus"></i>Execute Product Image Reorder </a></div>
	</div>
	<?php
}
    ?>
    <?php
if($pageno > 1)
{
    if((($count/100)+1) >= ($pageno))
    {
    ?>
<div class="col-md-7">
		<div class=" pull-right col-md-1 createbtn" ><a class="btn btn-primary" href="<?php echo site_url('site/productimagereorder?pageno='.$pageno); ?>"><i class="icon-plus"></i>Execute Next </a></div>
	</div>
	<?php
    }
}
    ?>
</div>
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