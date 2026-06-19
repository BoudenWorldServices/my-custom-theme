import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { preHeading, quote, attribution, buttonText, buttonUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Testimonial" initialOpen={ true }>
						<TextControl
							label="Pre-heading (e.g. 'A Word from B&M Retailers')"
							value={ preHeading }
							onChange={ ( val ) => setAttributes( { preHeading: val } ) }
						/>
						<TextareaControl
							label="Quote"
							value={ quote }
							onChange={ ( val ) => setAttributes( { quote: val } ) }
							rows={ 4 }
						/>
						<TextControl
							label="Attribution (name, role, company)"
							value={ attribution }
							onChange={ ( val ) => setAttributes( { attribution: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Button" initialOpen={ false }>
						<TextControl
							label="Button text"
							value={ buttonText }
							onChange={ ( val ) => setAttributes( { buttonText: val } ) }
						/>
						<TextControl
							label="Button URL"
							value={ buttonUrl }
							onChange={ ( val ) => setAttributes( { buttonUrl: val } ) }
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
					<p style={ { fontSize: '11px', color: 'rgba(255,255,255,0.7)', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>Testimonial</p>
					{ preHeading && <h2 style={ { fontSize: '20px', fontWeight: 700, color: '#fff', margin: '0 0 16px' } }>{ preHeading }</h2> }
					{ quote && <p style={ { color: '#fff', fontSize: '16px', fontStyle: 'italic', margin: '0 0 16px', maxWidth: '700px', marginLeft: 'auto', marginRight: 'auto' } }>{ quote }</p> }
					{ attribution && <p style={ { color: '#fff', fontWeight: 700, fontSize: '14px', margin: '0 0 24px' } }>— { attribution }</p> }
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
