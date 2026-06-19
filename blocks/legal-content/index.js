import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { content } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Legal Content" initialOpen={ true }>
						<TextareaControl
							label="HTML content"
							value={ content }
							onChange={ ( v ) => setAttributes( { content: v } ) }
							rows={ 20 }
							help="Paste formatted HTML. Rendered via wp_kses_post() on the front end. Supports: p, h2, h3, ul, li, a, strong, em."
						/>
						<p style={ { fontSize: '11px', color: '#666', marginTop: '8px' } }>
							__HTML content rendered on front end__
						</p>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px', borderLeft: '4px solid #364153' } } ) }>
					<p style={ { fontSize: '11px', color: '#999', marginBottom: '8px', textTransform: 'uppercase', letterSpacing: '1px' } }>Legal Content Block — HTML rendered on front end</p>
					<div
						style={ { fontSize: '14px', color: '#364153', lineHeight: 1.6 } }
						dangerouslySetInnerHTML={ { __html: content } }
					/>
				</div>
			</>
		);
	},
	save() { return null; },
} );
