<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Tabs {


	public static function render( string $currentTab ): void {

		$tabs = array(
			'general'   => array(
				'title' => __( 'General', 'pn-ai-agent' ),
				'icon'  => 'dashicons-admin-generic',
				'pro'   => false,
			),

			'providers' => array(
				'title' => __( 'Providers', 'pn-ai-agent' ),
				'icon'  => 'dashicons-cloud',
				'pro'   => false,
			),

			'models'    => array(
				'title' => __( 'Models', 'pn-ai-agent' ),
				'icon'  => 'dashicons-database',
				'pro'   => true,
			),

			'agent'     => array(
				'title' => __( 'Agent', 'pn-ai-agent' ),
				'icon'  => 'dashicons-superhero',
				'pro'   => true,
			),

			'mcp'       => array(
				'title' => __( 'MCP', 'pn-ai-agent' ),
				'icon'  => 'dashicons-networking',
				'pro'   => true,
			),

			'knowledge' => array(
				'title' => __( 'Knowledge', 'pn-ai-agent' ),
				'icon'  => 'dashicons-book-alt',
				'pro'   => true,
			),

			'chat'      => array(
				'title' => __( 'Chat', 'pn-ai-agent' ),
				'icon'  => 'dashicons-format-chat',
				'pro'   => false,
			),

			'images'    => array(
				'title' => __( 'Images', 'pn-ai-agent' ),
				'icon'  => 'dashicons-format-image',
				'pro'   => true,
			),

			'users'     => array(
				'title' => __( 'Users', 'pn-ai-agent' ),
				'icon'  => 'dashicons-groups',
				'pro'   => true,
			),

			'logs'      => array(
				'title' => __( 'Logs', 'pn-ai-agent' ),
				'icon'  => 'dashicons-list-view',
				'pro'   => true,
			),

			'license'   => array(
				'title' => __( 'License', 'pn-ai-agent' ),
				'icon'  => 'dashicons-lock',
				'pro'   => false,
			),
		);

		?>

		<style>
			.pn-tab-pro {
				background: #7c3aed;
				color: #fff;
				font-size: 10px;
				padding: 2px 6px;
				border-radius: 10px;
				margin-left: 5px;
				vertical-align: middle;
				font-weight: 600;
			}

			.pn-tab-icon {
				margin-right: 5px;
				vertical-align: middle;
			}
		</style>


		<h2 class="nav-tab-wrapper">

			<?php foreach ( $tabs as $slug => $tab ) : ?>

				<a href="
				<?php
				echo esc_url(
					admin_url( 'admin.php?page=pn-ai-agent&tab=' . $slug )
				);
				?>
				"
				class="nav-tab <?php echo $currentTab === $slug ? 'nav-tab-active' : ''; ?>">

					<span class="dashicons <?php echo esc_attr( $tab['icon'] ); ?> pn-tab-icon"></span>

					<?php echo esc_html( $tab['title'] ); ?>


					<?php if ( $tab['pro'] ) : ?>

						<span class="pn-tab-pro">
							PRO
						</span>

					<?php endif; ?>

				</a>

			<?php endforeach; ?>

		</h2>

		<?php
	}
}