import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, description, buttonText, buttonUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="CTA Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Description"
							value={ description }
							onChange={ ( val ) => setAttributes( { description: val } ) }
							rows={ 3 }
						/>
						<TextControl
							label="Button text"
							value={ buttonText }
							onChange={ ( val ) => setAttributes( { buttonText: val } ) }
						/>
						<TextControl
							label="Button URL"
							value={ buttonUrl }
							onChange={ ( val ) => setAttributes( { buttonUrl: val } ) }
							help="Default: /contact/"
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#ff5c00',
							padding: '64px 32px',
							textAlign: 'center',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: 'rgba(255,255,255,0.7)', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>
						CTA Section
					</p>
					<h2 style={ { fontSize: '32px', fontWeight: 700, color: '#fff', margin: '0 0 16px' } }>
						{ heading }
					</h2>
					{ description && (
						<p style={ { color: 'rgba(255,255,255,0.9)', fontSize: '16px', margin: '0 0 24px', maxWidth: '600px', marginLeft: 'auto', marginRight: 'auto' } }>
							{ description }
						</p>
					) }
					<div style={ { display: 'inline-block', background: '#020202', color: '#fff', padding: '16px 32px', fontWeight: 700, fontSize: '14px' } }>
						{ buttonText }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
