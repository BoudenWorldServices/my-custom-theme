import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, caseH3, caseP } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Main Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ p1 } onChange={ ( v ) => setAttributes( { p1: v } ) } rows={ 3 } />
						<TextareaControl label="Paragraph 2" value={ p2 } onChange={ ( v ) => setAttributes( { p2: v } ) } rows={ 3 } />
					</PanelBody>
					<PanelBody title="Case Study Aside" initialOpen={ false }>
						<TextControl label="Case study heading (H3)" value={ caseH3 } onChange={ ( v ) => setAttributes( { caseH3: v } ) } />
						<TextareaControl label="Case study paragraph" value={ caseP } onChange={ ( v ) => setAttributes( { caseP: v } ) } rows={ 4 } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#f9fafb', padding: '40px 32px', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '32px', alignItems: 'start' } } ) }>
					<div>
						<h2 style={ { fontSize: '22px', fontWeight: 700, marginBottom: '12px' } }>{ heading }</h2>
						<p style={ { fontSize: '14px', color: '#364153' } }>{ p1 }</p>
					</div>
					<div style={ { background: '#020202', padding: '24px', color: '#fff' } }>
						<h3 style={ { fontSize: '18px', fontWeight: 700, marginBottom: '12px' } }>{ caseH3 }</h3>
						<p style={ { fontSize: '14px' } }>{ caseP }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
