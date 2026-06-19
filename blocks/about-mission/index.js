import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, text } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Mission Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Mission statement"
							value={ text }
							onChange={ ( val ) => setAttributes( { text: val } ) }
							rows={ 5 }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#f9fafb',
							padding: '48px 32px',
							textAlign: 'center',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						About – Our Mission
					</p>
					<h2 style={ { margin: '8px 0 16px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#4a5565', fontSize: '16px', maxWidth: '640px', margin: '0 auto' } }>{ text }</p>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
