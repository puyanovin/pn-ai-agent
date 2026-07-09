/**
 * PN AIBot Admin Script 
 */
<script>
jQuery(document).ready(function($) {
    $('.pn-delete-user-key').on('click', function() {
        var userId = $(this).data('user-id');
        if (confirm('<?php _e( 'Are you sure? This will delete the user\'s API key.', 'pn-aibot' ); ?>')) {
            $.post(ajaxurl, {
                action: 'pn_delete_user_api_key',
                user_id: userId,
                nonce: '<?php echo wp_create_nonce( 'pn_delete_api_key' ); ?>'
            }, function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data || '<?php _e( 'Error occurred', 'pn-aibot' ); ?>');
                }
            });
        }
    });
});
</script>