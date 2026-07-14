<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class ProNotice {

	public static function render(): void {
		?>
		<div class="notice notice-info inline pn-pro-notice">

			<h2>
				🚀
				<?php
				esc_html_e(
					'Available in PN AI Agent Pro',
					'pn-ai-agent'
				);
				?>
			</h2>

			<p>

				<?php
				esc_html_e(
					'This feature is available in the Pro version.',
					'pn-ai-agent'
				);
				?>

			</p>

			<ul>

				<li>✓ AI Agents</li>

				<li>✓ MCP Servers</li>

				<li>✓ Knowledge Base</li>

				<li>✓ Image Generation</li>

				<li>✓ Memory</li>

				<li>✓ Premium Providers</li>

				<li>✓ Usage Statistics</li>

				<li>✓ Priority Support</li>

			</ul>

			<p>

				<a
					class="button button-primary"
					href="https://plugins.puyanovin.ir"
					target="_blank">

					<?php
					esc_html_e(
						'Upgrade to Pro',
						'pn-ai-agent'
					);
					?>

				</a>

			</p>

		</div>

		<?php
	}
}