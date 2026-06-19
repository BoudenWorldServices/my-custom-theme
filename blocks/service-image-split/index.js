import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, body, image, imageAlt, imagePosition } = attributes;
		const isLeft = imagePosition === 'left';
		const textBlock = (
			<div style={ { flex: 1, padding: '24px' } }>
				{ heading && <h2 style={ { fontSize: '20px', fontWeight: 700, marginBottom: '8px' } }>{ heading }</h2> }
				{ body && <p style={ { fontSize: '13px', color: '#364153' } }>{ body }</p> }
			</div>
		);
		const imageBlock = (
			<div style={ { width: '240px', flexShrink: 0, background: '#ccc', minHeight: '160px', overflow: 'hidden' } }>
				{ image && <img src={ image } alt={ imageAlt } style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> }
			</div>
		);
		return (
			<>
				<InspectorControls>
					<PanelBody title="Text Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Body text" value={ body } onChange={ ( v ) => setAttributes( { body: v } ) } rows={ 5 } />
					</PanelBody>
					<PanelBody title="Image" initialOpen={ false }>
						<TextControl label="Image URL" value={ image } onChange={ ( v ) => setAttributes( { image: v } ) } />
						<TextControl label="Alt text" value={ imageAlt } onChange={ ( v ) => setAttributes( { imageAlt: v } ) } />
						<SelectControl
							label="Image position"
							value={ imagePosition }
							options={ [
								{ label: 'Left', value: 'left' },
								{ label: 'Right', value: 'right' },
							] }
							onChange={ ( v ) => setAttributes( { imagePosition: v } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', display: 'flex', flexDirection: isLeft ? 'row' : 'row-reverse', alignItems: 'stretch', gap: 0 } } ) }>
					{ isLeft ? <>{ imageBlock }{ textBlock }</> : <>{ textBlock }{ imageBlock }</> }
				</div>
			</>
		);
	},
	save() { return null; },
} );
