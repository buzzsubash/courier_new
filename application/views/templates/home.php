<?php load_view("inc/header.php"); ?>
<style>
	:root{--blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,::after,::before{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%}section{display:block}body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff}h1,h2,h4{margin-top:0;margin-bottom:.5rem}a{color:#007bff;text-decoration:none;background-color:transparent}img{vertical-align:middle;border-style:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}h1,h2,h4{margin-bottom:.5rem;font-weight:500;line-height:1.2}h1{font-size:2.5rem}h2{font-size:2rem}h4{font-size:1.5rem}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col-md-4,.col-sm-4,.col-sm-8{position:relative;width:100%;padding-right:15px;padding-left:15px}@media (min-width:576px){.col-sm-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-sm-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}}@media (min-width:768px){.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}}.navbar-brand{display:inline-block;padding-top:.3125rem;padding-bottom:.3125rem;margin-right:1rem;font-size:1.25rem;line-height:inherit;white-space:nowrap}html{max-width:1600px;width:100%;margin:0 auto}*{font:400 16px 'DM Sans',sans-serif;line-height:1.6}h1,h2,h4{font-family:'Montserrat',sans-serif;font-weight:700;color:#c40c0c}a{color:#ef4f4f}.bg-image{object-fit:cover;display:block;vertical-align:middle;background-size:cover;background-position:50% 50%;background-repeat:no-repeat}.hide{display:none!important}::placeholder{color:#aaa!important;opacity:1}:-ms-input-placeholder{color:#aaa!important}::-ms-input-placeholder{color:#aaa!important}#header-wrap{border-bottom:2px solid #c40c0c;padding:5px 0}.navbar-brand img{width:130px}.banner-container{background-image:url('../images/banner.webp')}.banner-container .container{min-height:500px;display:flex;flex-direction:column;justify-content:center}.form-container h1{font-size:62px;color:#c40c0c;margin:0 0 15px}.form-container h2{font-size:30px;font-weight:500;margin:0;color:#212529}.about-container{padding:50px 0;text-align:center}.about-container h4{font-size:26px;color:#212529}.vendor-container{padding:50px 0 40px;background-color:#fafafa}.vendor-container a{padding:5px 10px;background-color:#fff;border:1px solid #e9e9e9;text-align:center;text-decoration:none;margin-bottom:10px;border-radius:5px;color:#c40c0c;min-height:60px;display:flex;flex-direction:column;justify-content:center;line-height:1.3}.scrolltoTop{position:fixed;right:-70px;bottom:75px;animation:flash 1s ease-out infinite;transform:scale(0.9);opacity:0.6;z-index:10}@keyframes flash{0%{transform:scale(0.9)}50%{transform:scale(1)}100%{transform:scale(0.9)}}@media (max-width:991px){.banner-container .container{min-height:400px}.form-container h1{font-size:48px}.form-container h2{font-size:26px;width:550px;margin:0 auto}.about-container{padding:30px 0}.about-container h4{font-size:22px}.vendor-container .col-md-4{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}}@media (max-width:767px){.banner-container .container{min-height:340px}.form-container h1{font-size:40px}.form-container h1 br{display:none}.form-container h2{font-size:22px;width:100%}.about-container{padding:30px 0}.about-container h4{font-size:18px}}@media (max-width:643px){*{font-size:12px}.banner-container .container{min-height:280px}.form-container h1{font-size:34px}.form-container h2{font-size:20px}.about-container{padding:20px 0}.about-container h4{font-size:16px}.vendor-container{padding:30px 0 20px}.vendor-container a{min-height:50px}}@media (max-width:480px){.banner-container .container{min-height:230px}.form-container h1{font-size:30px}.form-container h2{font-size:18px}.about-container h4{font-size:14px}.vendor-container .col-md-4{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}}@media (max-width:420px){.form-container h1{font-size:28px}}@media (max-width:360px){.form-container h1{font-size:25px}}
</style>


<section class="banner-container bg-image">
	<div class="container">
		<div class="form-container">
			<h1>Courier Tracking Status Online</h1>

			<h2>Track your couriers online and know delivery status.</h2>
		</div>
	</div>
</section>


<section class="about-container">
	<div class="container">
<?php $this->load->view('inc/adsense-h1-title'); ?>
		<h4>Courier And Logistics Tracking</h4>
	</div>
</section>


<section class="vendor-container">
	<div class="container">
<?php $this->load->view('inc/adsense-body1'); ?>
		<?php
			if($vendors = vendors()){
				$total = 0;
				echo '<div class="row">';
				foreach ($vendors as $vk => $v) {
					if( $category = category($v->category) ){
						$class = ($vk < 30 ? "" : "hide");
						echo '<div class="col-md-4 '.$class.'">
							<a href="'.base_url($category->url."/tracking-".$v->vendor_url).'">'.$v->vendor_name.'</a>
						</div>';
						$total++;
					}
				}
				echo ($total > 30 ? '<span class="load-more"><a href="javascript:void(0)" class="show_ext">View More</a></span>' : "");
				echo '</div>';
			} else{
				echo '<h4 style="text-align:center; width:100%;">No Vendors Yet!</h4>';
			}
		?>
	</div>
</section>


<?php load_view("inc/footer.php"); ?>

<script type="text/javascript">
	$(document).on("click", ".show_ext", function(){
		$(".vendor-container .col-md-4.hide").removeClass("hide");
		$(this).remove();
	});
</script>
