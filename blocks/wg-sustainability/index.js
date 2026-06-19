import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, p3, tagline, image } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Sustainability Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Paragraph 2"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Paragraph 3"
							value={ p3 }
							onChange={ ( val ) => setAttributes( { p3: val } ) }
							rows={ 2 }
						/>
						<TextControl
							label="Tagline (orange bold text)"
							value={ tagline }
							onChange={ ( val ) => setAttributes( { tagline: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Section Image" initialOpen={ false }>
						<TextControl
							label="Image URL (leave blank to use the theme default)"
							value={ image }
							onChange={ ( val ) => setAttributes( { image: val } ) }
							help="Paste a full image URL. When blank the theme option or fallback image is used."
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						Why Goliath – Sustainability
					</p>
					<h2 style={ { margin: '8px 0 12px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p1 }</p>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p2 }</p>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p3 }</p>
					<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '16px', margin: 0 } }>{ tagline }</p>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
