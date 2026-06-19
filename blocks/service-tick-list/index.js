import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, items, image, imageAlt, ctaText, ctaUrl } = attributes;

		const updateItem = ( index, value ) => {
			const updated = [ ...items ];
			updated[ index ] = value;
			setAttributes( { items: updated } );
		};

		const addItem = () => setAttributes( { items: [ ...items, '' ] } );

		const removeItem = ( index ) => {
			const updated = items.filter( ( _, i ) => i !== index );
			setAttributes( { items: updated } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
					</PanelBody>
					<PanelBody title="Tick List Items" initialOpen={ true }>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', gap: '8px', marginBottom: '8px', alignItems: 'center' } }>
								<TextControl
									value={ item }
									onChange={ ( v ) => updateItem( i, v ) }
									style={ { flex: 1, margin: 0 } }
								/>
								<Button isDestructive onClick={ () => removeItem( i ) } style={ { flexShrink: 0 } }>✕</Button>
							</div>
						) ) }
						<Button variant="secondary" onClick={ addItem }>+ Add item</Button>
					</PanelBody>
					<PanelBody title="CTA Button (optional)" initialOpen={ false }>
						<TextControl label="Button text (leave blank to hide)" value={ ctaText } onChange={ ( v ) => setAttributes( { ctaText: v } ) } />
						<TextControl label="Button URL" value={ ctaUrl } onChange={ ( v ) => setAttributes( { ctaUrl: v } ) } />
					</PanelBody>
					<PanelBody title="Side Image (optional)" initialOpen={ false }>
						<TextControl label="Image URL (leave blank to hide)" value={ image } onChange={ ( v ) => setAttributes( { image: v } ) } />
						<TextControl label="Image alt text" value={ imageAlt } onChange={ ( v ) => setAttributes( { imageAlt: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#f8f8f8', padding: '32px' } } ) }>
					{ heading && <h2 style={ { fontSize: '20px', fontWeight: 700, marginBottom: '12px' } }>{ heading }</h2> }
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(2,1fr)', gap: '8px', marginBottom: '12px' } }>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', alignItems: 'center', gap: '8px', fontSize: '13px', color: '#364153' } }>
								<span style={ { color: '#ff5c00', fontWeight: 700 } }>✓</span> { item }
							</div>
						) ) }
					</div>
					{ ctaText && (
						<div style={ { display: 'inline-flex', background: '#ff5c00', color: '#fff', padding: '12px 20px', fontSize: '12px', fontWeight: 700, textTransform: 'uppercase' } }>{ ctaText }</div>
					) }
				</div>
			</>
		);
	},
	save() { return null; },
} );
