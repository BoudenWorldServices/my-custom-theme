import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { h3, item1, item2, item3, item4, image } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Overlay Content" initialOpen={ true }>
						<TextControl label="Heading (H3)" value={ h3 } onChange={ ( v ) => setAttributes( { h3: v } ) } />
						<TextControl label="Bullet 1" value={ item1 } onChange={ ( v ) => setAttributes( { item1: v } ) } />
						<TextControl label="Bullet 2" value={ item2 } onChange={ ( v ) => setAttributes( { item2: v } ) } />
						<TextControl label="Bullet 3" value={ item3 } onChange={ ( v ) => setAttributes( { item3: v } ) } />
						<TextControl label="Bullet 4" value={ item4 } onChange={ ( v ) => setAttributes( { item4: v } ) } />
					</PanelBody>
					<PanelBody title="Image" initialOpen={ false }>
						<TextControl
							label="Image URL (leave blank to use Settings › Customizer value)"
							value={ image }
							onChange={ ( v ) => setAttributes( { image: v } ) }
							help="Paste a direct image URL or leave blank to use the theme option."
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#f3f3f3', padding: '24px', position: 'relative' } } ) }>
					<div style={ { background: '#ccc', height: '200px', marginBottom: '16px', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#666' } }>
						{ image ? <img src={ image } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : 'Background image (set via URL or theme option)' }
					</div>
					<div style={ { background: '#ff5c00', padding: '24px' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '16px', margin: '0 0 8px' } }>{ h3 }</p>
						{ [ item1, item2, item3, item4 ].filter( Boolean ).map( ( item, i ) => (
							<p key={ i } style={ { color: '#fff', fontSize: '13px', margin: '4px 0' } }>✓ { item }</p>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
