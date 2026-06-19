import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { client, quote, attribution, ctaText, ctaUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Testimonial (optional)" initialOpen={ true }>
						<TextControl
							label="Client name (shown in 'A Word from {client}')"
							value={ client }
							onChange={ ( val ) => setAttributes( { client: val } ) }
							placeholder="e.g. B&M"
						/>
						<TextareaControl
							label="Testimonial quote (leave blank to show the default 'Ready to Get Similar Results?' heading)"
							value={ quote }
							onChange={ ( val ) => setAttributes( { quote: val } ) }
							rows={ 4 }
						/>
						<TextControl
							label="Attribution (name, role — leave blank to hide)"
							value={ attribution }
							onChange={ ( val ) => setAttributes( { attribution: val } ) }
							placeholder="e.g. John Smith, Facilities Manager, ACME Ltd"
						/>
					</PanelBody>
					<PanelBody title="CTA Button" initialOpen={ true }>
						<TextControl
							label="Button text"
							value={ ctaText }
							onChange={ ( val ) => setAttributes( { ctaText: val } ) }
						/>
						<TextControl
							label="Button URL"
							value={ ctaUrl }
							onChange={ ( val ) => setAttributes( { ctaUrl: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#ff5c00',
							padding: '48px 32px',
							textAlign: 'center',
							display: 'flex',
							flexDirection: 'column',
							alignItems: 'center',
							gap: '12px',
						},
					} ) }
				>
					{ quote ? (
						<>
							<p style={ { color: '#fff', fontWeight: 700, fontSize: '18px', margin: 0 } }>
								{ client ? `A Word from ${ client }` : 'Client Testimonial' }
							</p>
							<p style={ { color: '#fff', fontStyle: 'italic', fontSize: '16px', maxWidth: '720px', margin: 0 } }>
								{ quote }
							</p>
							{ attribution && (
								<p style={ { color: '#fff', fontWeight: 700, fontSize: '13px', margin: 0 } }>
									— { attribution }
								</p>
							) }
						</>
					) : (
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '18px', margin: 0 } }>
							Ready to Get Similar Results?
						</p>
					) }
					<div style={ { background: '#020202', color: '#fff', padding: '14px 24px', fontWeight: 700, fontSize: '14px', marginTop: '8px' } }>
						{ ctaText || 'Get Similar Results' }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
