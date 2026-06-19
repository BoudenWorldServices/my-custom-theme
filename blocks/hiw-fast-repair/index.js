import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, para1, para2, para3, boxH3, boxPara } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Copy" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ para1 } rows={ 3 } onChange={ ( v ) => setAttributes( { para1: v } ) } />
						<TextareaControl label="Paragraph 2" value={ para2 } rows={ 4 } onChange={ ( v ) => setAttributes( { para2: v } ) } />
						<TextareaControl label="Paragraph 3" value={ para3 } rows={ 3 } onChange={ ( v ) => setAttributes( { para3: v } ) } />
					</PanelBody>
					<PanelBody title="Orange Box" initialOpen={ true }>
						<TextControl label="Box heading" value={ boxH3 } onChange={ ( v ) => setAttributes( { boxH3: v } ) } />
						<TextareaControl label="Box paragraph" value={ boxPara } rows={ 3 } onChange={ ( v ) => setAttributes( { boxPara: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#f9fafb', padding: '32px', display: 'flex', gap: '32px', flexWrap: 'wrap', alignItems: 'center' } } ) }>
					<div style={ { flex: 1, minWidth: '220px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>HIW Fast Repair</p>
						<p style={ { fontSize: '20px', fontWeight: 700, color: '#020202', margin: '0 0 10px' } }>{ heading }</p>
						<p style={ { fontSize: '13px', color: '#555', margin: 0 } }>{ para1.substring( 0, 100 ) }{ para1.length > 100 ? '…' : '' }</p>
					</div>
					<div style={ { background: '#ff5c00', padding: '24px', width: '240px', flexShrink: 0 } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '16px', margin: '0 0 6px' } }>{ boxH3 }</p>
						<p style={ { color: '#fff', fontSize: '12px', margin: 0 } }>{ boxPara.substring( 0, 80 ) }{ boxPara.length > 80 ? '…' : '' }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
