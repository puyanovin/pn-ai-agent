(function (blocks, element) {

    const el = element.createElement;

    blocks.registerBlockType(

        'pn-ai-agent/chat',

        {

            edit() {

                return el(

                    'div',

                    {
                        style: {

                            padding: '25px',

                            border: '2px dashed #2271b1',

                            background: '#fff',

                            borderRadius: '10px',

                            textAlign: 'center'

                        }

                    },

                    [

                        el(

                            'h3',

                            {},

                            '🤖 PN AI Agent'

                        ),

                        el(

                            'p',

                            {},

                            'Open Source AI Assistant'

                        )

                    ]

                );

            },

            save() {

                return null;

            }

        }

    );

})(

    window.wp.blocks,

    window.wp.element

);
