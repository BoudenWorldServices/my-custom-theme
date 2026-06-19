import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { realworldH2, realworldIntro, realworldListIntro, realworldItems, realworldClosing, complianceH2, complianceIntro, complianceItems, complianceClosing } = attributes;

		const updateItem = ( list, attr, index, value ) => {
			const updated = [ ...list ];
			updated[ index ] = value;
			setAttributes( { [attr]: updated } );
		};

		const addItem = ( list, attr ) => setAttributes( { [attr]: [ ...list, '' ] } );
		const removeItem = ( list, attr, index ) => setAttributes( { [attr]: list.filter( ( _, i ) => i !== index ) } );

		return (
			<>
				<InspectorControls>
					<PanelBody title="Real-World Environments" initialOpen={ true }>
						<TextControl label="Heading" value={ realworldH2 } onChange={ ( v ) => setAttributes( { realworldH2: v } ) } />
						<TextareaControl label="Intro paragraph" value={ realworldIntro } onChange={ ( v ) => setAttributes( { realworldIntro: v } ) } />
						<TextControl label="List intro" value={ realworldListIntro } onChange={ ( v ) => setAttributes( { realworldListIntro: v } ) } />
						<p style={ { fontWeight: 600, marginBottom: '4px' } }>List items</p>
						{ realworldItems.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', gap: '4px', marginBottom: '4px' } }>
								<TextControl value={ item } onChange={ ( v ) => updateItem( realworldItems, 'realworldItems', i, v ) } style={ { flex: 1 } } />
								<Button isDestructive variant="tertiary" onClick={ () => removeItem( realworldItems, 'realworldItems', i ) } size="small">✕</Button>
							</div>
						) ) }
						<Button variant="secondary" onClick={ () => addItem( realworldItems, 'realworldItems' ) } size="small">Add item</Button>
						<TextareaControl label="Closing paragraph" value={ realworldClosing } onChange={ ( v ) => setAttributes( { realworldClosing: v } ) } style={ { marginTop: '12px' } } />
					</PanelBody>
					<PanelBody title="Built to Support Compliance" initialOpen={ false }>
						<TextControl label="Heading" value={ complianceH2 } onChange={ ( v ) => setAttributes( { complianceH2: v } ) } />
						<TextareaControl label="Intro paragraph" value={ complianceIntro } onChange={ ( v ) => setAttributes( { complianceIntro: v } ) } />
						<p style={ { fontWeight: 600, marginBottom: '4px' } }>Standards list</p>
						{ complianceItems.map( ( item, i ) => (
							<div key={ i } style={ { display: 'flex', gap: '4px', marginBottom: '4px' } }>
								<TextControl value={ item } onChange={ ( v ) => updateItem( complianceItems, 'complianceItems', i, v ) } style={ { flex: 1 } } />
								<Button isDestructive variant="tertiary" onClick={ () => removeItem( complianceItems, 'complianceItems', i ) } size="small">✕</Button>
							</div>
						) ) }
						<Button variant="secondary" onClick={ () => addItem( complianceItems, 'complianceItems' ) } size="small">Add item</Button>
						<TextareaControl label="Closing paragraph" value={ complianceClosing } onChange={ ( v ) => setAttributes( { complianceClosing: v } ) } style={ { marginTop: '12px' } } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px', display: 'flex', gap: '32px', flexWrap: 'wrap' } } ) }>
					<div style={ { flex: 1, minWidth: '200px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Real World</p>
						<p style={ { fontSize: '18px', fontWeight: 700, color: '#020202', margin: '0 0 8px' } }>{ realworldH2 }</p>
						<p style={ { fontSize: '12px', color: '#555', margin: 0 } }>{ realworldIntro }</p>
					</div>
					<div style={ { flex: 1, minWidth: '200px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Compliance</p>
						<p style={ { fontSize: '18px', fontWeight: 700, color: '#020202', margin: '0 0 8px' } }>{ complianceH2 }</p>
						<p style={ { fontSize: '12px', color: '#555', margin: 0 } }>{ complianceIntro }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
