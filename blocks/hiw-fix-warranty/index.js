import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			fixH2Line1, fixH2Line2, fixP,
			warrantyH2Line1, warrantyH2Line2, warrantyP1, warrantyP2,
		} = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Fix the Problem" initialOpen={ true }>
						<TextControl label="Heading line 1 (orange)" value={ fixH2Line1 } onChange={ ( v ) => setAttributes( { fixH2Line1: v } ) } />
						<TextControl label="Heading line 2 (black)" value={ fixH2Line2 } onChange={ ( v ) => setAttributes( { fixH2Line2: v } ) } />
						<TextareaControl label="Paragraph" value={ fixP } rows={ 3 } onChange={ ( v ) => setAttributes( { fixP: v } ) } />
					</PanelBody>
					<PanelBody title="Lifetime Warranty" initialOpen={ true }>
						<TextControl label="Heading line 1 (orange)" value={ warrantyH2Line1 } onChange={ ( v ) => setAttributes( { warrantyH2Line1: v } ) } />
						<TextControl label="Heading line 2 (black)" value={ warrantyH2Line2 } onChange={ ( v ) => setAttributes( { warrantyH2Line2: v } ) } />
						<TextareaControl label="Paragraph 1" value={ warrantyP1 } rows={ 3 } onChange={ ( v ) => setAttributes( { warrantyP1: v } ) } />
						<TextareaControl label="Paragraph 2" value={ warrantyP2 } rows={ 2 } onChange={ ( v ) => setAttributes( { warrantyP2: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fafafa', padding: '32px', display: 'flex', gap: '32px', flexWrap: 'wrap' } } ) }>
					<div style={ { flex: 1, minWidth: '200px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 6px' } }>Fix the Problem</p>
						<p style={ { fontSize: '22px', fontWeight: 700, color: '#ff5c00', margin: 0 } }>{ fixH2Line1 }</p>
						<p style={ { fontSize: '22px', fontWeight: 700, color: '#020202', margin: '0 0 8px' } }>{ fixH2Line2 }</p>
						<p style={ { fontSize: '14px', color: '#666', margin: 0 } }>{ fixP.substring( 0, 80 ) }{ fixP.length > 80 ? '…' : '' }</p>
					</div>
					<div style={ { flex: 1, minWidth: '200px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 6px' } }>Warranty</p>
						<p style={ { fontSize: '22px', fontWeight: 700, color: '#ff5c00', margin: 0 } }>{ warrantyH2Line1 }</p>
						<p style={ { fontSize: '22px', fontWeight: 700, color: '#020202', margin: '0 0 8px' } }>{ warrantyH2Line2 }</p>
						<p style={ { fontSize: '14px', color: '#666', margin: 0 } }>{ warrantyP1.substring( 0, 80 ) }{ warrantyP1.length > 80 ? '…' : '' }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
