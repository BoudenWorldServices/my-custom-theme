import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, para1, para2, box, tagline } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Strength Section" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ para1 } rows={ 2 } onChange={ ( v ) => setAttributes( { para1: v } ) } />
						<TextareaControl label="Paragraph 2" value={ para2 } rows={ 3 } onChange={ ( v ) => setAttributes( { para2: v } ) } />
						<TextareaControl label="Orange box text" value={ box } rows={ 3 } onChange={ ( v ) => setAttributes( { box: v } ) } />
						<TextControl label="Orange tagline" value={ tagline } onChange={ ( v ) => setAttributes( { tagline: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#020202', padding: '32px', textAlign: 'center' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>HIW Strength</p>
					<p style={ { fontSize: '20px', fontWeight: 700, color: '#fff', margin: '0 0 12px' } }>{ heading }</p>
					<p style={ { fontSize: '13px', color: '#ccc', margin: '0 0 16px' } }>{ para1.substring( 0, 80 ) }{ para1.length > 80 ? '…' : '' }</p>
					<div style={ { background: '#ff5c00', padding: '20px', margin: '0 auto 16px', maxWidth: '600px' } }>
						<p style={ { color: '#fff', fontSize: '13px', margin: 0 } }>{ box.substring( 0, 100 ) }{ box.length > 100 ? '…' : '' }</p>
					</div>
					<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '15px', margin: 0 } }>{ tagline }</p>
				</div>
			</>
		);
	},
	save() { return null; },
} );
