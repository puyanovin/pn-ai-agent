/**
 * Gutenberg editor script for PN AI Agent.
 *
 * @package PNAIAgent
 */

(function (blocks, element, i18n) {

	const el = element.createElement;
	const __ = i18n.__;

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
						__( 'PN AI Agent', 'pn-ai-agent' )
					),
					el(
						'p',
						{},
						__( 'AI Chat Assistant', 'pn-ai-agent' )
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
	window.wp.element,
	window.wp.i18n
);
