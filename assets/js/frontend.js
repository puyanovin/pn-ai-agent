console.log('=== PN AI FRONTEND LOADED ===');

jQuery(function ($) {

    console.log('PN AI DOM READY');


    /*
     * Send message
     */
    $(document).on('click', '.pn-chat-send', function () {


        const button = $(this);

        const chat = button.closest('.pn-ai-chat');

        const messageBox = chat.find('.pn-chat-message');

        const windowBox = chat.find('.pn-chat-window');


        let message = messageBox.val().trim();


        if (message === '') {
            return;
        }


        /*
         * User message
         */
        windowBox.append(
            '<div class="pn-user"><span>' +
            $('<div>').text(message).html() +
            '</span></div>'
        );


        messageBox.val('');


        /*
         * Thinking
         */
        windowBox.append(
            '<div class="pn-thinking pn-ai">' +
                '<span>' +
                pnAi.i18n.thinking +
                '</span>' +
            '</div>'
        );


        /*
         * Disable button
         */
        button.prop(
            'disabled',
            true
        );


        /*
         * AJAX
         */
        $.post(

            pnAi.ajax_url,

            {
                action: 'pn_ai_chat',
                _ajax_nonce: pnAi.nonce,
                prompt: message
            }

        )


        .done(function(response){


            chat.find('.pn-thinking').remove();


            console.log(
                'PN AI RESPONSE:',
                response
            );


            if(response.success){


                windowBox.append(

                    '<div class="pn-ai">' +
                        '<span>' +
                        $('<div>')
                            .text(response.message)
                            .html()
                        +
                        '</span>' +
                    '</div>'

                );


            } else {


                windowBox.append(

                    '<div class="pn-ai">' +
                        '<span style="color:red">' +
                        $('<div>')
                            .text(
                                response.message ??
                                'Unknown error'
                            )
                            .html()
                        +
                        '</span>' +
                    '</div>'

                );


            }


        })


        .fail(function(xhr){


            chat.find('.pn-thinking').remove();


            console.error(
                'PN AI AJAX ERROR:',
                xhr
            );


            windowBox.append(

                '<div class="pn-ai">' +
                    '<span style="color:red">' +
                    'Connection error' +
                    '</span>' +
                '</div>'

            );


        })


        .always(function(){


            button.prop(
                'disabled',
                false
            );


            windowBox.scrollTop(
                windowBox[0].scrollHeight
            );


        });


    });



    /*
     * Clear chat
     */
    $(document).on(
        'click',
        '.pn-chat-clear',
        function(){


            const chat = $(this)
                .closest('.pn-ai-chat');


            chat.find(
                '.pn-chat-window'
            )
            .empty();


        }
    );



    /*
     * Enter to send
     */
    $(document).on(
        'keydown',
        '.pn-chat-message',
        function(e){


            if(
                e.key === 'Enter' &&
                !e.shiftKey
            ){

                e.preventDefault();


                $(this)
                .closest('.pn-ai-chat')
                .find('.pn-chat-send')
                .trigger('click');

            }


        }
    );


});
