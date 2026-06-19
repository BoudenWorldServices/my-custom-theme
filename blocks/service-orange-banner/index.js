import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, description, image, imageAlt } = attributes;
		const parts = heading.split( ' ' );
		const white = parts[0] || '';
		const orange = parts.slice( 1 ).join( ' ' );
		return (
			<>
				<InspectorControls>
					<PanelBody title="Banner Content" initialOpen={ true }>
						<TextControl
							label="Heading (first word white, rest orange)"
							value={ heading }
							onChange={ ( v ) => setAttributes( { heading: v } ) }
						/>
						<TextareaControl
							label="Description paragraph"
							value={ description }
							onChange={ ( v ) => setAttributes( { description: v } ) }
							rows={ 4 }
						/>
					</PanelBody>
					<PanelBody title="Image (optional)" initialOpen={ false }>
						<TextControl
							label="Image URL"
							value={ image }
							onChange={ ( v ) => setAttributes( { image: v } ) }
						/>
						<TextControl
							label="Image alt text"
							value={ imageAlt }
							onChange={ ( v ) => setAttributes( { imageAlt: v } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#020202', padding: '48px 32px' } } ) }>
					<h1 style={ { fontSize: '32px', fontWeight: 700, margin: '0 0 12px' } }>
						<span style={ { color: '#fff' } }>{ white } </span>
						<span style={ { color: '#ff5c00' } }>{ orange }</span>
					</h1>
					{ description && (
						<p style={ { color: '#d1d5dc', fontSize: '16px', maxWidth: '720px', margin: 0 } }>{ description }</p>
					) }
					{ image && (
						<div style={ { marginTop: '16px', height: '160px', overflow: 'hidden' } }>
							<img src={ image } alt={ imageAlt } style={ { width: '100%', height: '100%', objectFit: 'cover' } } />
						</div>
					) }
				</div>
			</>
		);
	},
	save() { return null; },
} );
