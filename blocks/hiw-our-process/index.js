import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, para1, para2, para3, para4, quote } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Copy" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ para1 } rows={ 3 } onChange={ ( v ) => setAttributes( { para1: v } ) } />
						<TextareaControl label="Paragraph 2" value={ para2 } rows={ 3 } onChange={ ( v ) => setAttributes( { para2: v } ) } />
						<TextareaControl label="Paragraph 3" value={ para3 } rows={ 3 } onChange={ ( v ) => setAttributes( { para3: v } ) } />
						<TextareaControl label="Paragraph 4" value={ para4 } rows={ 3 } onChange={ ( v ) => setAttributes( { para4: v } ) } />
					</PanelBody>
					<PanelBody title="Dark Quote Box" initialOpen={ true }>
						<TextareaControl label="Quote text" value={ quote } rows={ 3 } onChange={ ( v ) => setAttributes( { quote: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px', display: 'flex', gap: '32px', flexWrap: 'wrap' } } ) }>
					<div style={ { flex: 1, minWidth: '220px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>HIW Our Process</p>
						<p style={ { fontSize: '20px', fontWeight: 700, color: '#020202', margin: '0 0 10px' } }>{ heading }</p>
						<p style={ { fontSize: '13px', color: '#555', margin: 0 } }>{ para1.substring( 0, 100 ) }{ para1.length > 100 ? '…' : '' }</p>
					</div>
					<div style={ { background: '#020202', padding: '24px', width: '240px', flexShrink: 0, display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '14px', textAlign: 'center', margin: 0 } }>{ quote.substring( 0, 100 ) }{ quote.length > 100 ? '…' : '' }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
