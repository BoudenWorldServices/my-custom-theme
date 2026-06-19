import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, intro, items, boxH3, boxP, boxCta, boxCtaUrl, image } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Intro paragraph" value={ intro } onChange={ ( v ) => setAttributes( { intro: v } ) } rows={ 3 } />
						<TextareaControl
							label="Compatibility items (comma-separated)"
							value={ items }
							onChange={ ( v ) => setAttributes( { items: v } ) }
							rows={ 4 }
							help="Enter each racking type separated by a comma."
						/>
					</PanelBody>
					<PanelBody title="CTA Box" initialOpen={ false }>
						<TextControl label="Box heading (H3)" value={ boxH3 } onChange={ ( v ) => setAttributes( { boxH3: v } ) } />
						<TextareaControl label="Box paragraph" value={ boxP } onChange={ ( v ) => setAttributes( { boxP: v } ) } rows={ 3 } />
					<TextControl label="Button text" value={ boxCta } onChange={ ( v ) => setAttributes( { boxCta: v } ) } />
					<TextControl label="CTA URL" value={ boxCtaUrl } onChange={ ( v ) => setAttributes( { boxCtaUrl: v } ) } />
				</PanelBody>
					<PanelBody title="Image" initialOpen={ false }>
						<TextControl
							label="Image URL (leave blank to use theme option)"
							value={ image }
							onChange={ ( v ) => setAttributes( { image: v } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px' } } ) }>
					<h2 style={ { fontSize: '22px', fontWeight: 700, marginBottom: '8px' } }>{ heading }</h2>
					<p style={ { color: '#666', fontSize: '13px', marginBottom: '16px' } }>{ intro }</p>
					<div style={ { display: 'flex', gap: '16px' } }>
						<div style={ { flex: 1 } }>
							{ items.split( ',' ).map( ( item, i ) => (
								<div key={ i } style={ { border: '1px solid #e8e8e9', padding: '12px 16px', marginBottom: '4px', fontSize: '13px', fontWeight: 700 } }>✓ { item.trim() }</div>
							) ) }
						</div>
						<div style={ { width: '200px', background: '#ccc', flexShrink: 0 } }></div>
					</div>
					<div style={ { background: '#020202', padding: '24px', textAlign: 'center', marginTop: '16px' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '18px', marginBottom: '8px' } }>{ boxH3 }</p>
						<p style={ { color: 'rgba(255,255,255,0.9)', fontSize: '13px', marginBottom: '12px' } }>{ boxP }</p>
						<div style={ { display: 'inline-block', background: '#ff5c00', color: '#fff', padding: '12px 24px', fontSize: '13px', fontWeight: 700 } }>{ boxCta }</div>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
