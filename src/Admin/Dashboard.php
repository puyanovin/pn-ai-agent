<?php
/**
 * Dashboard Page
 * 
 * @package PN_AI_Agent
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$plugins = array(
    'pn-license-gateway' => array(
        'name'        => 'PN License Gateway',
        'description' => 'Complete license management and payment gateway solution for Easy Digital Downloads',
        'icon'        => '🔑',
        'color'       => '#4f46e5',
        'slug'        => 'pn-license-gateway',
        'file'        => 'pn-license-gateway/pn-license-gateway.php',
        'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-license-gateway/',
        'is_active'   => true, // این افزونه فعلاً فعال است
    ),
    'pn-paid-edd' => array(
        'name'        => 'PN Paid EDD',
        'description' => 'Connect Easy Digital Downloads with Paid Memberships Pro for seamless payment and membership management',
        'icon'        => '🛒',
        'color'       => '#10b981',
        'slug'        => 'pn-paid-edd',
        'file'        => 'pn-paid-edd/pn-paid-edd.php',
        'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-paid-edd/',
        'is_active'   => class_exists( 'PN_Paid_EDD' ),
    ),
    'pn-aibot' => array(
        'name'        => 'PN AIBot',
        'description' => 'Intelligent AI chatbot for WordPress with OpenAI and DeepSeek integration',
        'icon'        => '🤖',
        'color'       => '#f59e0b',
        'slug'        => 'pn-aibot',
        'file'        => 'pn-aibot/pn-aibot.php',
        'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-aibot/',
        'is_active'   => class_exists( 'PN_AIBot' ),
    ),
    'pn-zoho-smtp' => array(
        'name'        => 'PN Zoho SMTP',
        'description' => 'Connect your WordPress site to Zoho Mail using SMTP or REST API',
        'icon'        => '📧',
        'color'       => '#ef4444',
        'slug'        => 'pn-zoho-smtp',
        'file'        => 'pn-zoho-smtp/pn-zoho-smtp.php',
        'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-zoho-smtp/',
        'is_active'   => class_exists( 'PN_Zoho_SMTP' ),
    ),
);
?>

<div class="pnlg-dashboard">
    <!-- Header -->
    <div class="pnlg-dashboard-header">
        <div class="pnlg-dashboard-icon">
            <span class="dashicons dashicons-admin-generic"></span>
        </div>
        <div class="pnlg-dashboard-title">
            <h1><?php _e( 'PN Suite Dashboard', 'pn-license-gateway' ); ?></h1>
            <p><?php _e( 'Welcome to PN Suite - Professional WordPress plugins for your business', 'pn-license-gateway' ); ?></p>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="pnlg-stats-grid">
        <div class="pnlg-stat-card">
            <div class="pnlg-stat-number"><?php echo count( $plugins ); ?></div>
            <div class="pnlg-stat-label"><?php _e( 'Total Plugins', 'pn-license-gateway' ); ?></div>
        </div>
        <div class="pnlg-stat-card">
            <div class="pnlg-stat-number" style="color: #10b981;">
                <?php echo count( array_filter( $plugins, function( $p ) { return $p['is_active']; } ) ); ?>
            </div>
            <div class="pnlg-stat-label"><?php _e( 'Active Plugins', 'pn-license-gateway' ); ?></div>
        </div>
        <div class="pnlg-stat-card">
            <div class="pnlg-stat-number" style="color: #f59e0b;">
                <?php echo count( array_filter( $plugins, function( $p ) { return ! $p['is_active']; } ) ); ?>
            </div>
            <div class="pnlg-stat-label"><?php _e( 'Inactive Plugins', 'pn-license-gateway' ); ?></div>
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
                            <?php _e( 'Active', 'pn-license-gateway' ); ?>
                        </span>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $plugin['download_url'] ); ?>" target="_blank" class="pnlg-btn-download">
                            <span class="dashicons dashicons-download"></span>
                            <?php _e( 'Download', 'pn-license-gateway' ); ?>
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
                <h3><?php _e( 'Need Support?', 'pn-license-gateway' ); ?></h3>
                <p><?php _e( 'Get professional support for all PN Suite plugins', 'pn-license-gateway' ); ?></p>
                <a href="https://plugins.puyanovin.ir/support/" target="_blank" class="pnlg-btn-support">
                    <?php _e( 'Contact Support', 'pn-license-gateway' ); ?>
                </a>
            </div>
        </div>
        <div class="pnlg-support-card">
            <div class="pnlg-support-icon">📚</div>
            <div class="pnlg-support-content">
                <h3><?php _e( 'Documentation', 'pn-license-gateway' ); ?></h3>
                <p><?php _e( 'Read documentation and user guides', 'pn-license-gateway' ); ?></p>
                <a href="https://plugins.puyanovin.ir/docs/" target="_blank" class="pnlg-btn-docs">
                    <?php _e( 'Read Docs', 'pn-license-gateway' ); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* ========================================
   PN Suite Dashboard Styles
   ======================================== */

.pnlg-dashboard {
    max-width: 100%;
    margin-top: 20px;
}

/* Dashboard Header */
.pnlg-dashboard-header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 25px 30px;
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    border-radius: 20px;
    margin-bottom: 30px;
    color: white;
}

.pnlg-dashboard-icon {
    background: rgba(255,255,255,0.2);
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pnlg-dashboard-icon .dashicons {
    font-size: 40px;
    width: 40px;
    height: 40px;
    color: white;
}

.pnlg-dashboard-title h1 {
    margin: 0 0 8px 0;
    color: white;
    font-size: 28px;
    font-weight: 600;
}

.pnlg-dashboard-title p {
    margin: 0;
    color: rgba(255,255,255,0.85);
    font-size: 15px;
}

/* Stats Grid */
.pnlg-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 35px;
}

.pnlg-stat-card {
    background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
    padding: 25px 20px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.pnlg-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
}

.pnlg-stat-number {
    font-size: 42px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 10px;
}

.pnlg-stat-label {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}

/* Plugins Grid */
.pnlg-plugins-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.pnlg-plugin-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}

.pnlg-plugin-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.pnlg-plugin-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.pnlg-plugin-info h3 {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
}

.pnlg-plugin-info p {
    margin: 0 0 15px 0;
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
}

.pnlg-plugin-actions {
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
}

.pnlg-badge-active {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #d1fae5;
    color: #065f46;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
}

.pnlg-badge-active .dashicons {
    font-size: 16px;
    width: 16px;
    height: 16px;
}

.pnlg-btn-download {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.pnlg-btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79,70,229,0.4);
    color: white;
}

/* Support Section */
.pnlg-support-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.pnlg-support-card {
    background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
    border-radius: 20px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.pnlg-support-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.pnlg-support-icon {
    font-size: 42px;
}

.pnlg-support-content {
    flex: 1;
}

.pnlg-support-content h3 {
    margin: 0 0 8px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
}

.pnlg-support-content p {
    margin: 0 0 12px 0;
    font-size: 13px;
    color: #64748b;
}

.pnlg-btn-support {
    display: inline-block;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.pnlg-btn-support:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(16,185,129,0.4);
    color: white;
}

.pnlg-btn-docs {
    display: inline-block;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.pnlg-btn-docs:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59,130,246,0.4);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .pnlg-dashboard-header {
        flex-direction: column;
        text-align: center;
    }
    
    .pnlg-plugins-grid {
        grid-template-columns: 1fr;
    }
    
    .pnlg-support-card {
        flex-direction: column;
        text-align: center;
    }
}
</style>
