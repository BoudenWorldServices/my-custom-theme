import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { client, intro } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Case Study Hero" initialOpen={ true }>
						<TextControl
							label="Client name (displayed in orange)"
							value={ client }
							onChange={ ( val ) => setAttributes( { client: val } ) }
							placeholder="e.g. B&M"
						/>
						<TextareaControl
							label="Intro paragraph (optional)"
							value={ intro }
							onChange={ ( val ) => setAttributes( { intro: val } ) }
							rows={ 4 }
							help="Displayed below the heading in white text."
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: 'linear-gradient(135deg, #020202 0%, #1a1a2e 100%)',
							padding: '48px 32px',
							minHeight: '280px',
							display: 'flex',
							flexDirection: 'column',
							justifyContent: 'flex-end',
							gap: '12px',
						},
					} ) }
				>
					<h1 style={ { fontSize: '36px', fontWeight: 700, color: '#fff', margin: 0, lineHeight: 1.2 } }>
						<span>Case Study: </span>
						<span style={ { color: '#ff5c00' } }>{ client || 'Client Name' }</span>
					</h1>
					{ intro && (
						<p style={ { color: 'rgba(255,255,255,0.9)', fontSize: '16px', margin: 0, maxWidth: '900px' } }>
							{ intro }
						</p>
					) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
