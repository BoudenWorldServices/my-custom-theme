import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, items, columns, theme, background } = attributes;
		const addItem = () => setAttributes( { items: [ ...items, { text: '' } ] } );
		const updateItem = ( i, value ) => setAttributes( { items: items.map( ( item, idx ) => idx === i ? { text: value } : item ) } );
		const removeItem = ( i ) => setAttributes( { items: items.filter( ( _, idx ) => idx !== i ) } );

		const darkBg = theme === 'dark' || background === 'gray';
		return (
			<>
				<InspectorControls>
					<PanelBody title="List Settings" initialOpen={ true }>
						<TextControl label="Heading (optional)" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<SelectControl label="Columns" value={ columns } options={ [ { label: '1 column', value: '1' }, { label: '2 columns', value: '2' } ] } onChange={ ( v ) => setAttributes( { columns: v } ) } />
						<SelectControl label="Text theme" value={ theme } options={ [ { label: 'Light (dark text)', value: 'light' }, { label: 'Dark (white text)', value: 'dark' } ] } onChange={ ( v ) => setAttributes( { theme: v } ) } />
						<SelectControl label="Background" value={ background } options={ [ { label: 'None (transparent)', value: 'none' }, { label: 'White', value: 'white' }, { label: 'Light gray', value: 'gray' } ] } onChange={ ( v ) => setAttributes( { background: v } ) } />
					</PanelBody>
					<PanelBody title="List Items" initialOpen={ true }>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', gap: '8px', marginBottom: '8px', alignItems: 'center' } }>
								<TextControl label="" value={ item.text } onChange={ ( v ) => updateItem( i, v ) } style={ { flex: 1, margin: 0 } } />
								<Button onClick={ () => removeItem( i ) } variant="link" isDestructive style={ { whiteSpace: 'nowrap' } }>✕</Button>
							</div>
						) ) }
						<Button onClick={ addItem } variant="secondary">+ Add item</Button>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: background === 'gray' ? '#f9fafb' : background === 'white' ? '#fff' : 'transparent', padding: '24px', borderLeft: '3px solid #ff5c00' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Tick List ({ items.length } items)</p>
					{ heading && <h3 style={ { fontWeight: 700, margin: '0 0 12px' } }>{ heading }</h3> }
					<div style={ { display: 'grid', gridTemplateColumns: columns === '2' ? '1fr 1fr' : '1fr', gap: '8px' } }>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', gap: '8px', alignItems: 'flex-start' } }>
								<span style={ { color: '#ff5c00', fontWeight: 700, fontSize: '14px', lineHeight: '1.4', flexShrink: 0 } }>✓</span>
								<span style={ { fontSize: '14px', color: darkBg ? '#fff' : '#364153' } }>{ item.text || `Item ${ i + 1 }` }</span>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
