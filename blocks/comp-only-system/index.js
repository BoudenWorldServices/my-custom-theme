import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { leftH2, leftP1, leftP2, rightH3, rightP1, rightP2 } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Left Column" initialOpen={ true }>
						<TextControl label="Heading (H2)" value={ leftH2 } onChange={ ( v ) => setAttributes( { leftH2: v } ) } />
						<TextareaControl label="Paragraph 1" value={ leftP1 } onChange={ ( v ) => setAttributes( { leftP1: v } ) } rows={ 3 } />
						<TextareaControl label="Paragraph 2" value={ leftP2 } onChange={ ( v ) => setAttributes( { leftP2: v } ) } rows={ 3 } />
					</PanelBody>
					<PanelBody title="Right Panel" initialOpen={ false }>
						<TextControl label="Heading (H3)" value={ rightH3 } onChange={ ( v ) => setAttributes( { rightH3: v } ) } />
						<TextareaControl label="Paragraph 1" value={ rightP1 } onChange={ ( v ) => setAttributes( { rightP1: v } ) } rows={ 3 } />
						<TextareaControl label="Paragraph 2" value={ rightP2 } onChange={ ( v ) => setAttributes( { rightP2: v } ) } rows={ 3 } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#ff5c00', padding: '40px 32px', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '40px' } } ) }>
					<div>
						<h2 style={ { color: '#fff', fontWeight: 700, fontSize: '22px', marginBottom: '12px' } }>{ leftH2 }</h2>
						<p style={ { color: '#fff', fontSize: '14px' } }>{ leftP1 }</p>
					</div>
					<div style={ { background: '#ff8f66', padding: '24px' } }>
						<h3 style={ { color: '#fff', fontWeight: 700, fontSize: '18px', marginBottom: '12px' } }>{ rightH3 }</h3>
						<p style={ { color: '#fff', fontSize: '14px' } }>{ rightP1 }</p>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
