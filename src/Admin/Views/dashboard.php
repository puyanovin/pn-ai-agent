<?php
/**
 * PN AI Agent Admin Dashboard Template
 *
 * @package PNAIAgent
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="pnlg-dashboard">
	<!-- Header -->
	<div class="pnlg-dashboard-header">
		<div class="pnlg-dashboard-icon">
			<span class="dashicons dashicons-admin-generic"></span>
		</div>
		<div class="pnlg-dashboard-title">
			<h1><?php esc_html_e( 'PN Suite Dashboard', 'pn-ai-agent' ); ?></h1>
			<p><?php esc_html_e( 'Welcome to PN Suite - Professional WordPress plugins for your business', 'pn-ai-agent' ); ?></p>
		</div>
	</div>

	<!-- Stats Overview -->
	<div class="pnlg-stats-grid">
		<div class="pnlg-stat-card">
			<div class="pnlg-stat-number"><?php echo esc_html( (string) count( $plugins ) );?></div>
			<div class="pnlg-stat-label"><?php esc_html_e( 'Total Plugins', 'pn-ai-agent' ); ?></div>
		</div>
		<div class="pnlg-stat-card">
			<div class="pnlg-stat-number" style="color: #10b981;">
				<?php
				echo count(
					array_filter(
						$plugins,
						function ( $p ) {
							return $p['is_active'];
						}
					)
				);
				?>
			</div>
			<div class="pnlg-stat-label"><?php esc_html_e( 'Active Plugins', 'pn-ai-agent' ); ?></div>
		</div>
		<div class="pnlg-stat-card">
			<div class="pnlg-stat-number" style="color: #f59e0b;">
				<?php
				echo count(
					array_filter(
						$plugins,
						function ( $p ) {
							return ! $p['is_active'];
						}
					)
				);
				?>
			</div>
			<div class="pnlg-stat-label"><?php esc_html_e( 'Inactive Plugins', 'pn-ai-agent' ); ?></div>
		</div>
	</div>

	<!-- Plugins Grid -->
	<div class="pnlg-plugins-grid">
		<?php foreach ( $plugins as $plugin ) : ?>
			<div class="pnlg-plugin-card" style="border-top: 4px solid <?php echo esc_attr( $plugin['color'] ); ?>;">
				<div class="pnlg-plugin-icon" style="background: <?php echo esc_attr( $plugin['color'] ); ?>20;">
					<span style="font-size: 32px;"><?php echo esc_html( $plugin['icon'] ); ?></span>
				</div>
				<div class="pnlg-plugin-info">
					<h3><?php echo esc_html( $plugin['name'] ); ?></h3>
					<p><?php echo esc_html( $plugin['description'] ); ?></p>
				</div>
				<div class="pnlg-plugin-actions">
					<?php if ( $plugin['is_active'] ) : ?>
						<span class="pnlg-badge-active">
							<span class="dashicons dashicons-yes-alt"></span>
							<?php esc_html_e( 'Active', 'pn-ai-agent' ); ?>
						</span>
					<?php else : ?>
						<a href="<?php echo esc_url( $plugin['download_url'] ); ?>" target="_blank" class="pnlg-btn-download">
							<span class="dashicons dashicons-download"></span>
							<?php esc_html_e( 'Download', 'pn-ai-agent' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<!-- Support Section -->
	<div class="pnlg-support-section">
		<div class="pnlg-support-card">
			<div class="pnlg-support-icon">📞</div>
			<div class="pnlg-support-content">
				<h3><?php esc_html_e( 'Need Support?', 'pn-ai-agent' ); ?></h3>
				<p><?php esc_html_e( 'Get professional support for all PN Suite plugins', 'pn-ai-agent' ); ?></p>
				<a href="https://plugins.puyanovin.ir/support/" target="_blank" class="pnlg-btn-support">
					<?php esc_html_e( 'Contact Support', 'pn-ai-agent' ); ?>
				</a>
			</div>
		</div>
		<div class="pnlg-support-card">
			<div class="pnlg-support-icon">📚</div>
			<div class="pnlg-support-content">
				<h3><?php esc_html_e( 'Documentation', 'pn-ai-agent' ); ?></h3>
				<p><?php esc_html_e( 'Read documentation and user guides', 'pn-ai-agent' ); ?></p>
				<a href="https://plugins.puyanovin.ir/docs/" target="_blank" class="pnlg-btn-docs">
					<?php esc_html_e( 'Read Docs', 'pn-ai-agent' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>