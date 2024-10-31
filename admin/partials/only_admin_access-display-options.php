<div class="wrap">
	    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	    <form action="options.php" method="post">
	        <?php
	            settings_fields( $this->plugin_name );
	            do_settings_sections( $this->plugin_name );
	            submit_button();
	        ?>
	    </form>
</div>
<p class="copyright">Only Admin Access by <a href="https://startnet.co.uk" target="_blank">Startnet Ltd</a> &copy <?php echo date('Y'); ?></p>