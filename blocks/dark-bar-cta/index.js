import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { text, primaryButtonText, primaryButtonUrl, secondaryButtonText, secondaryButtonUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Dark Bar CTA" initialOpen={ true }>
						<TextareaControl label="Body text" value={ text } rows={ 3 } onChange={ ( v ) => setAttributes( { text: v } ) } />
					</PanelBody>
					<PanelBody title="Primary Button" initialOpen={ true }>
						<TextControl label="Button text" value={ primaryButtonText } onChange={ ( v ) => setAttributes( { primaryButtonText: v } ) } />
						<TextControl label="Button URL" value={ primaryButtonUrl } onChange={ ( v ) => setAttributes( { primaryButtonUrl: v } ) } />
					</PanelBody>
					<PanelBody title="Secondary Button (optional)" initialOpen={ false }>
						<TextControl label="Button text" value={ secondaryButtonText } onChange={ ( v ) => setAttributes( { secondaryButtonText: v } ) } />
						<TextControl label="Button URL" value={ secondaryButtonUrl } onChange={ ( v ) => setAttributes( { secondaryButtonUrl: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#020202', padding: '32px', display: 'flex', gap: '24px', alignItems: 'center', flexWrap: 'wrap' } } ) }>
					<div style={ { flex: 1, minWidth: '200px' } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 6px' } }>Dark Bar CTA</p>
						{ text && <p style={ { color: '#ccc', fontSize: '15px', margin: 0 } }>{ text.substring( 0, 100 ) }{ text.length > 100 ? '…' : '' }</p> }
					</div>
					<div style={ { display: 'flex', gap: '12px', flexWrap: 'wrap' } }>
						{ primaryButtonText && <div style={ { background: '#1a1a1a', border: '1px solid #333', color: '#fff', padding: '10px 20px', fontWeight: 700, fontSize: '13px' } }>{ primaryButtonText }</div> }
						{ secondaryButtonText && <div style={ { border: '1px solid #555', color: '#ccc', padding: '10px 20px', fontSize: '13px' } }>{ secondaryButtonText }</div> }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
