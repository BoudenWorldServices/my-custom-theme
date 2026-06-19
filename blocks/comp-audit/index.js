import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, asideH3, asideP } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Main Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ p1 } onChange={ ( v ) => setAttributes( { p1: v } ) } rows={ 3 } />
						<TextareaControl label="Paragraph 2" value={ p2 } onChange={ ( v ) => setAttributes( { p2: v } ) } rows={ 3 } />
					</PanelBody>
					<PanelBody title="Orange Aside" initialOpen={ false }>
						<TextControl label="Aside heading (H3)" value={ asideH3 } onChange={ ( v ) => setAttributes( { asideH3: v } ) } />
						<TextareaControl label="Aside paragraph" value={ asideP } onChange={ ( v ) => setAttributes( { asideP: v } ) } rows={ 4 } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fafafa', padding: '40px 32px', display: 'grid', gridTemplateColumns: '1fr auto', gap: '32px', alignItems: 'start' } } ) }>
					<div>
						<h2 style={ { fontSize: '22px', fontWeight: 700, marginBottom: '12px' } }>{ heading }</h2>
						<p style={ { fontSize: '14px', color: '#364153' } }>{ p1 }</p>
					</div>
					<div style={ { background: '#ff5c00', padding: '32px', width: '320px', color: '#fff', border: '2px solid #ff5c00' } }>
						<h3 style={ { fontSize: '18px', fontWeight: 700, marginBottom: '12px' } }>{ asideH3 }</h3>
						<p style={ { fontSize: '13px' } }>{ asideP }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
