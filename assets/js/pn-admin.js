/**
 * PN AI Agent - Admin Script
 */


jQuery(function ($) {

    /**
     * Display WordPress admin notice.
     *
     * @param {string} message
     * @param {string} type success|error|warning|info
     */
    function pnNotice(message, type = 'success') {

        $('#pn-admin-notice').remove();

        $('.wrap').prepend(
            '<div id="pn-admin-notice" class="notice notice-' +
            type +
            ' is-dismissible"><p>' +
            $('<div>').text(message).html() +
            '</p></div>'
        );

    }

    /**
     * Test provider connection.
     */
    $('.pn-test-provider').on('click', function () {

        const button = $(this);
        const provider = button.data('provider') || $('#pn_ai_provider').val();

        button
            .prop('disabled', true)
            .text(pnAi.i18n.testing);

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_test_provider',
                _ajax_nonce: pnAi.nonce,
                provider: provider
            },
            function (response) {

                let statusHtml = '';

                if (response.success) {

                    statusHtml =
                        '<span class="pn-success">🟢 ' +
                        pnAi.i18n.connected +
                        '</span>';

                } else {

                    statusHtml =
                        '<span class="pn-error">❌ ' +
                        $('<div>')
                            .text(response.data.message)
                            .html() +
                        '</span>';

                }

                $('#pn-provider-status').html(statusHtml);
                $('#pn-result-' + provider).html(statusHtml);

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        })
        .always(function () {

            button
                .prop('disabled', false)
                .text(pnAi.i18n.test_connection);

        });

    });

    /**
     * Provider changed.
     */
    $('#pn_ai_provider').on('change', function () {
    
        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_provider_data',
                _ajax_nonce: pnAi.nonce,
                provider: $(this).val()
            },
            function (response) {

                if (!response.success) {
                    return;
                }

                $('#pn_ai_api_url').val(
                   response.data.api_url || ''
                );

                $('#pn_ai_api_key').val(
                    response.data.api_key || ''
                );

                $('#pn_ai_model')
                   .empty()
                   .append(
                       $('<option>', {
                           value: response.data.model || '',
                           text: response.data.model || ''
                       })
                   );
                
            }

        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        });
    });
       
    $('#pn_ai_provider').trigger('change');

    /**
     * Save provider settings.
     */
    $('#pn-save-provider').on('click', function () {

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_save_provider_settings',
                _ajax_nonce: pnAi.nonce,
                provider: $('#pn_ai_provider').val(),
                api_url: $('#pn_ai_api_url').val(),
                api_key: $('#pn_ai_api_key').val(),
                model: $('#pn_ai_model').val()
            },
            function (response) {

                if (response.success) {

                    pnNotice(
                        response.data.message,
                        'success'
                    );

                } else {

                    pnNotice(
                        response.data.message,
                        'error'
                    );

                }

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        });

    });

    /**
     * Load models.
     */
    $('#pn-load-models').on('click', function () {

        const button = $(this);

        button.prop('disabled', true);

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_get_models',
                _ajax_nonce: pnAi.nonce,
                provider: $('#pn_ai_provider').val()
            },
            function (response) {

                if (!response.success) {

                    pnNotice(
                        response.data.message ||
                        pnAi.i18n.cannot_load_models,
                        'error'
                    );

                    return;

                }

                const select = $('#pn_ai_model');

                select.empty();

                if (
                    response.data.models &&
                    response.data.models.length
                ) {

                    console.log('GET MODELS RESPONSE:', response);

                    if (!response.success || !response.data.models) {
                        console.error('Models error:', response);
                        alert(response.data?.message || 'Failed to load models');
                        return;
                    }



                    response.data.models.forEach(function(model){

                        select.append(
                            $('<option>', {
                                value: model.id,
                                text: model.id
                            })
                        );

                    });

                }

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        })
        .always(function () {

            button.prop('disabled', false);

        });
    });
        
    /**
     * Clear chat window.
     */
    $('#pn-chat-clear').on('click', function () {

        $('#pn-chat-window').empty();

    });


    /**
     * Scroll chat to bottom.
     */
    if ($('#pn-chat-window').length) {

        $('#pn-chat-window').scrollTop(
            $('#pn-chat-window')[0].scrollHeight
        );

    }


    /**
     * Save license key.
     */
    $('#pn-save-license').on('click', function () {

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_save_license',
                _ajax_nonce: pnAi.nonce,
                license: $('#pn_ai_license_key').val()
            },
            function (response) {

                if (response.success) {

                    pnNotice(
                        response.data.message,
                        'success'
                    );

                } else {

                    pnNotice(
                        response.data.message,
                        'error'
                    );

                }

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        });

    });


    /**
     * Save selected model.
     */
    $('#pn-save-model').on('click', function () {

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_save_model',
                _ajax_nonce: pnAi.nonce,
                provider: $('#pn_ai_provider').val(),
                model: $('#pn_ai_model').val()
            },
            function (response) {

                if (response.success) {

                    pnNotice(
                        response.data.message,
                        'success'
                    );

                } else {

                    pnNotice(
                        response.data.message,
                        'error'
                    );

                }

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        });

    });


    /**
    * Send chat message.
    */
    $('#pn-chat-send').on('click', function () {
       
        const message = $('#pn-chat-message').val().trim();

        if (message === '') {
            return;
        }

        $('#pn-chat-window').append(
            '<div class="pn-user"><span>' +
            $('<div>').text(message).html() +
            '</span></div>'
        );

        $('#pn-chat-message').val('');

        $('#pn-chat-window').append(
            '<div id="pn-thinking" class="pn-ai"><span>' +
            pnAi.i18n.thinking +
            '</span></div>'
        );

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_chat',
                _ajax_nonce: pnAi.nonce,
                prompt: message
            },
            function (response) {

                $('#pn-thinking').remove();

                if (response.success) {

                    $('#pn-chat-window').append(
                        '<div class="pn-ai"><span>' +
                        $('<div>')
                            .text(response.data.message)
                            .html() +
                        '</span></div>'
                    );

                } else {

                    $('#pn-chat-window').append(
                        '<div class="pn-ai"><span class="pn-error">' +
                        $('<div>')
                            .text(response.data.message)
                            .html() +
                        '</span></div>'
                    );

                    pnNotice(
                        response.data.message,
                        'error'
                    );

                }

                $('#pn-chat-window').scrollTop(
                    $('#pn-chat-window')[0].scrollHeight
                );

            }
        )
        .fail(function () {

            pnNotice(
                pnAi.i18n.unexpected_error,
                'error'
            );

        });

    });


    /**
    * Press Enter to send message.
    */
    $('#pn-chat-message').on('keydown', function (e) {

        if (e.key === 'Enter' && !e.shiftKey) {

            e.preventDefault();

            $('#pn-chat-send').trigger('click');

        }

    });


});
    
    
    
    
    
