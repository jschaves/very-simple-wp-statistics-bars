<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    exit();
}
?>
<div class="wrap">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

		<!-- Identify your business so that you can collect the payments. -->
		<input type="hidden" name="business" value="juan.cha63@gmail.com">

		<!-- Specify a Donate button. -->
		<input type="hidden" name="cmd" value="_donations">

		<!-- Specify details about the contribution -->
		<input type="hidden" name="item_name" value="Very Sinple WordPress Statistics (WordPress plugin)">
		<input type="hidden" name="currency_code" value="EUR">

		<!-- Display the payment button. -->
		<input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="Donate">
		<img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

	</form>
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<h3 class="vswps-help-statistics" style="display:none"><?php esc_html_e( 'The statistics data was inserted in the form. Make the changes and then save the form', 'very-simple-wp-statistics' ); ?></h3>
    <form method="post" autocomplete="off" id="vswps-add-statistics" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
        <div id="universal-message-container">
            <h2><?php echo  esc_html_e( 'Statistics Configurator', 'very-simple-wp-statistics' ); ?></h2>
            <div class="options">
				<p>
					<label><?php esc_html_e( 'Title' ); ?></label>
					<br />
					<input name="title" type="text" style="width:300px" class="vswpp-new" id="vswps-title" value="" maxlength="100" required />
				</p>
                <p>
                    <label><?php esc_html_e( 'Number of bars', 'very-simple-wp-statistics' ); ?></label>
                    <br />
                    <input style="width:65px" id="vswps-n-bars" type="number" class="vswpp-new" name="vswps-n-bars" min="1" max="100" value="1" required />
                </p>
                <p>
                    <label><?php esc_html_e( 'Height bars', 'very-simple-wp-statistics' ); ?></label>
                    <br />
                    <input style="width:65px" id="vswps-height-bars" type="number" class="vswpp-new" name="vswps-height-bars" min="10" max="1999" value="25" required />
                </p>
				<p>	
					<label><?php esc_html_e( 'Percentage in bars', 'very-simple-wp-statistics'  ); ?></label>
					<span id="vswps-add-percentage"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Color of the bars', 'very-simple-wp-statistics'  ); ?></label>
					<span id="vswps-add-color"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Color of the text', 'very-simple-wp-statistics'  ); ?></label>
					<span id="vswps-add-color-text"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Text of the bars', 'very-simple-wp-statistics'  ); ?></label>
					<span id="vswps-add-text"></span>
				</p>
				<input id="vswps-data-save-percentage" type="hidden" name="vswps-data-save-percentage" required />
				<input id="vswps-data-save-color" type="hidden" name="vswps-data-save-color" required />
				<input id="vswps-data-save-color-text" type="hidden" name="vswps-data-save-color-text" required />
				<input id="vswps-data-save-text" type="hidden" name="vswps-data-save-text" required />
				<input id="vswps-data-save-ids" type="hidden" name="vswps-data-save-ids" required />
				<input id="vswps-id-statistics-edit" type="hidden" name="edit" value="null" />
				<input type="hidden" name="action" value="vswps">
			</div>
		</div>
        <?php
            wp_nonce_field( 'settings-save', 'id-message' );
            submit_button( __( 'Save' ) );
        ?>
    </form>
</div>
<p><a id="vswps-link-data-statistics" class="vswps-preview-statistics" ><?php esc_html_e( 'Preview' ); ?></a></p>
<p><span id="vswps-paint" style="display:none" ></span></p>
<br />
<br />
<h3><?php esc_html_e( 'Saved Statistics', 'very-simple-wp-statistics' ); ?></h3>
<p><?php esc_html_e( 'Click Copy for the selected Statistic and paste it in the page where you want it to appear.', 'very-simple-wp-statistics' ); ?></p>
<br />
<div id="vswps-list-statistics">
<?php 
	$values = esc_attr( $this->deserializer_vswps->get_value( 'very\_simple\_wp\_statistics\_%' ) );
	if( ! empty( $values ) ) {
		$values = explode( '#statistics#', $values );
		if( count( $values ) > 0 ) {
			foreach( $values as $value ) {
				$idStatistics = explode( '[', $value );
				$idStatistics = explode( ',', $idStatistics[1] );
				$deleteEditId = explode( '=', $idStatistics[0] );
				$title = $idStatistics[1];
?>
				<table cellspacing='0' class="vswps-ul-statistics">
					<tr>
						<td class="vswps-preview-statistics">
							[<?php echo $idStatistics[0] . ' ' . $title; ?>]
						</td>
						<td class="vswps-array-data-statistics"> 
							<span class="vswps-view-statistics" id="<?php echo $deleteEditId[1]; ?>" viewStatistics="<?php echo str_replace( array( '[', ']' ), array( '', '' ), $value ); ?>"></span>
							<input type="submit" vswpsId="<?php echo $deleteEditId[1]; ?>" class="button button-primary vswps-view-input" value="<?php echo __( 'Edit' ); ?>" />
						</td>
						<td>
						</td>
						<td>
							<form class="vswps-form-statistics" method="post" autocomplete="off" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
								<input type="hidden" name="delete" value="<?php echo $deleteEditId[1]; ?>" />
								<input type="hidden" name="action" value="vswps">
							<?php 
								wp_nonce_field( 'settings-save', 'id-message' );
								submit_button( __( 'Delete' ) );
							?>
							</form>
						</td>
						<td>
						</td>
						<td>
							<input class="vswps-copy-statistics button button-primary" type="submit" copy="[<?php echo $idStatistics[0] . ' ' . $title; ?>]" class="button button-primary vswps-copy" value="<?php echo _e( 'Copy' ); ?> " />
						</td>
						<td>
						</td>
					</tr>
				</table>
<?php
			}	
		} else {
			echo _e( 'Nothing saved', 'very-simple-wp-statistics' );
		}
	}
?>
</div>