/**
 * PN AI Agent Admin Script
 */

jQuery(function ($) {

    // Test Provider
    $('.pn-test-provider').on('click', function () {

        let button = $(this);

        button.prop('disabled', true).text('Testing...');
        button.prop('disabled', true).text(pnAi.i18n.testing);

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_test_provider',
                _ajax_nonce: pnAi.nonce
            },
            function (response) {

            let provider = button.data('provider');

            let statusHtml;

            if (response.success) {

                statusHtml = '<span style="color:green">🟢 ' + pnAi.i18n.connected + '</span>';

            } else {

                statusHtml = '<span style="color:red">❌ ' + response.message + '</span>';

            }

            // اگر صفحه Providers باشد
            $('#pn-result-' + provider).html(statusHtml);

            // اگر صفحه General باشد
            $('#pn-provider-status').html(statusHtml);

                button.prop('disabled', false).text(pnAi.i18n.test_connection);
                
            }
        );
        

    });


    // Save Model
    $('#pn-save-model').on('click', function () {

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_save_model',
                _ajax_nonce: pnAi.nonce,
                model: $('#pn_ai_model').val()
            },
            function (response) {

                alert(response.data.message);

            }
        );

    });


    // Provider Changed
    $('#pn_ai_provider').on('change', function () {

        console.log('Provider:', $(this).val());

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_provider_data',
                _ajax_nonce: pnAi.nonce,
                provider: $(this).val()
            },
            function (response) {

                console.log(response);

                if (!response.success) {
                    return;
                }

                $('#pn_ai_api_url').val(response.data.url);
                $('#pn_ai_api_key').val(response.data.api_key);

                $('#pn_ai_model')
                    .empty()
                    .append(
                        $('<option>', {
                            value: response.data.model,
                            text: response.data.model || '-- Select Model --'
                        })
                    );

            }
        );

    });

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

                alert(response.data.message);

            }

        );

    });

    $('#pn-load-models').on('click', function () {

        let button = $(this);

        button.prop('disabled', true);

        $.post(
            pnAi.ajax_url,
            {
                action: 'pn_ai_test_provider',
                _ajax_nonce: pnAi.nonce
            },

            function (response) {

                button.prop('disabled', false);

                if (!response.success) {
                  alert(pnAi.i18n.cannot_load_models);
                  return;
                }

                let select = $('#pn_ai_model');

                select.empty();

                
                if (response.models && response.models.length) {

                   response.models.forEach(function(model){

                       select.append(
                           $('<option>',{
                               value: model.id,
                               text: model.id
                           })
                       );

               });

}

            }
        );

    });

    $('#pn-chat-send').on('click', function () {

        let message = $('#pn-chat-message').val().trim();

        if (message === '') {
            return;
        }

        $('#pn-chat-window').append(
            '<div class="pn-user"><span>' + message + '</span></div>'
        );

        $('#pn-chat-message').val('');

        $('#pn-chat-window').append(
            $('#pn-chat-window').append(
                '<div id="pn-thinking" class="pn-ai"><span>' + pnAi.i18n.thinking + '</span></div>'
            );
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
                        response.message +
                        '</span></div>'
                    );

                } else {

                    $('#pn-chat-window').append(
                        '<div class="pn-ai"><span style="color:red;">' +
                        response.message +
                        '</span></div>'
                    );

                }

                $('#pn-chat-window').scrollTop(
                    $('#pn-chat-window')[0].scrollHeight
                );
            }
        );

    });

    $('#pn-chat-message').on('keydown', function(e){

        if(e.key === 'Enter' && !e.shiftKey){

            e.preventDefault();

            $('#pn-chat-send').click();

        }

    });

    $('#pn-chat-clear').on('click', function(){

        $('#pn-chat-window').html('');

    });

    $('#pn-chat-window').scrollTop(
        $('#pn-chat-window')[0].scrollHeight
    );

   

});
