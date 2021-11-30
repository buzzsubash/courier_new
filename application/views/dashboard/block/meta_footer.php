<script src="<?php echo dashboard_theme_uri('js/lib/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo dashboard_theme_uri('js/lib/datatables/datatables.min.js'); ?>"></script>
<script src="<?php echo dashboard_theme_uri('js/lib/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
<script src="<?php echo dashboard_theme_uri('js/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo dashboard_theme_uri('js/sidebarmenu.js'); ?>"></script>
<script src="<?php echo dashboard_theme_uri('js/custom.min.js'); ?>"></script>
<script src="<?php echo theme_uri('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo theme_uri('plugins/toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript">var base_url = '<?=base_url();?>';</script>
<script src="<?php echo dashboard_theme_uri('js/custom.js'); ?>"></script>

<script type="text/javascript">
	setTimeout(function(){
		$('.alert.alert-dismissable').fadeOut(500);
		'<?php $this->session->set_flashdata('message', ''); ?>';
	},10000);
</script>