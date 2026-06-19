import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { phoneSubtitle, emailSubtitle } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Card Subtitles" initialOpen={ true }>
						<TextControl
							label="Phone card subtitle"
							value={ phoneSubtitle }
							onChange={ ( val ) => setAttributes( { phoneSubtitle: val } ) }
							help="Shown below 'Phone' heading. Contact number comes from global settings."
						/>
						<TextControl
							label="Email card subtitle"
							value={ emailSubtitle }
							onChange={ ( val ) => setAttributes( { emailSubtitle: val } ) }
							help="Shown below 'Email' heading. Email address comes from global settings."
						/>
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#f9fafb', padding: '40px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>
						Contact Quick Cards
					</p>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: '24px' } }>
						{ [ 'Phone', 'Email', 'Location' ].map( ( label ) => (
							<div key={ label } style={ { background: '#fff', padding: '32px', textAlign: 'center' } }>
								<div style={ { width: 48, height: 48, background: '#ff5c00', margin: '0 auto 12px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
									<span style={ { color: '#fff', fontSize: '20px' } }>⬛</span>
								</div>
								<p style={ { fontWeight: 700, margin: '0 0 4px' } }>{ label }</p>
								<p style={ { color: '#4a5565', fontSize: '14px', margin: 0 } }>{ label === 'Phone' ? phoneSubtitle : label === 'Email' ? emailSubtitle : 'Address from global settings' }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
