<?php
/**
 * Homepage process steps.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$steps = we_rows( 'process_steps' );
if ( ! $steps ) {
	return;
}
?>
<section class="we-section we-section--dark">
	<div class="we-container">
		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'process_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'process_heading' ) ); ?></h2>
			<?php if ( we_f( 'process_intro' ) ) : ?>
				<p class="we-lead"><?php echo esc_html( we_f( 'process_intro' ) ); ?></p>
			<?php endif; ?>
		</div>

		<div class="we-process-grid">
			<?php foreach ( $steps as $step ) : ?>
				<div class="we-step" data-reveal>
					<span class="we-step__no"><?php echo esc_html( $step['step'] ); ?></span>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
					<i class="<?php echo esc_attr( $step['icon'] ); ?> we-step__icon"></i>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
