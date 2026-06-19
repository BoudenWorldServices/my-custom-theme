import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { sectionTitle, col1Heading, col1Body, col1Callout, col2Heading, col2Body, col2Callout, showDivider } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Title" initialOpen={ true }>
						<TextControl
							label="Section title (optional orange heading above columns)"
							value={ sectionTitle }
							onChange={ ( val ) => setAttributes( { sectionTitle: val } ) }
						/>
						<ToggleControl
							label="Show bottom divider line"
							checked={ showDivider }
							onChange={ ( val ) => setAttributes( { showDivider: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Left Column" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ col1Heading }
							onChange={ ( val ) => setAttributes( { col1Heading: val } ) }
						/>
						<TextareaControl
							label="Body text (separate paragraphs with a blank line)"
							value={ col1Body }
							onChange={ ( val ) => setAttributes( { col1Body: val } ) }
							rows={ 5 }
						/>
						<TextControl
							label="Orange callout sentence (optional)"
							value={ col1Callout }
							onChange={ ( val ) => setAttributes( { col1Callout: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Right Column" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ col2Heading }
							onChange={ ( val ) => setAttributes( { col2Heading: val } ) }
						/>
						<TextareaControl
							label="Body text (separate paragraphs with a blank line)"
							value={ col2Body }
							onChange={ ( val ) => setAttributes( { col2Body: val } ) }
							rows={ 5 }
						/>
						<TextControl
							label="Orange callout sentence (optional)"
							value={ col2Callout }
							onChange={ ( val ) => setAttributes( { col2Callout: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>
						Text Columns
					</p>
					{ sectionTitle && (
						<h2 style={ { fontSize: '24px', fontWeight: 700, color: '#ff5c00', margin: '0 0 16px' } }>{ sectionTitle }</h2>
					) }
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px' } }>
						<div>
							{ col1Heading && <h3 style={ { fontWeight: 700, margin: '0 0 8px', color: '#020202' } }>{ col1Heading }</h3> }
							{ col1Body && <p style={ { color: '#555', fontSize: '14px', margin: '0 0 8px' } }>{ col1Body.substring( 0, 120 ) }{ col1Body.length > 120 ? '…' : '' }</p> }
							{ col1Callout && <p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '13px', margin: 0 } }>{ col1Callout }</p> }
						</div>
						<div>
							{ col2Heading && <h3 style={ { fontWeight: 700, margin: '0 0 8px', color: '#020202' } }>{ col2Heading }</h3> }
							{ col2Body && <p style={ { color: '#555', fontSize: '14px', margin: '0 0 8px' } }>{ col2Body.substring( 0, 120 ) }{ col2Body.length > 120 ? '…' : '' }</p> }
							{ col2Callout && <p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '13px', margin: 0 } }>{ col2Callout }</p> }
						</div>
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
