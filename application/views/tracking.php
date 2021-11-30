<div class="tracking-container">

	<h1 class="page-title"><?=$vendor->vendor_name;?> Courier Tracking</h1>
<?php $this->load->view('inc/adsense-h1-title'); ?>
<br>
	<br>

    <p style="text-align: center;"><a href="<?=$vendor->vendor_website;?>" rel="noopener noreferrer nofollow" target="_blank"><u><b>Click here</b></u></a> to track <?=$vendor->vendor_name;?> courier/order.</p>

    <iframe src="<?=$vendor->vendor_website;?>" border="0" frameborder="0" scrolling="yes"></iframe>
</div>
