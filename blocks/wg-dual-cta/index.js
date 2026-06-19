import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, para1, para2, primaryText, primaryUrl, secondaryText, secondaryUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ para1 } rows={ 3 } onChange={ ( v ) => setAttributes( { para1: v } ) } />
						<TextareaControl label="Paragraph 2" value={ para2 } rows={ 3 } onChange={ ( v ) => setAttributes( { para2: v } ) } />
					</PanelBody>
					<PanelBody title="Primary Button" initialOpen={ true }>
						<TextControl label="Button text" value={ primaryText } onChange={ ( v ) => setAttributes( { primaryText: v } ) } />
						<TextControl label="Button URL" value={ primaryUrl } onChange={ ( v ) => setAttributes( { primaryUrl: v } ) } />
					</PanelBody>
					<PanelBody title="Secondary Button" initialOpen={ true }>
						<TextControl label="Button text" value={ secondaryText } onChange={ ( v ) => setAttributes( { secondaryText: v } ) } />
						<TextControl label="Button URL" value={ secondaryUrl } onChange={ ( v ) => setAttributes( { secondaryUrl: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#ff5c00', padding: '40px', textAlign: 'center' } } ) }>
					<p style={ { fontSize: '11px', color: '#fff', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px', opacity: 0.7 } }>Dual CTA</p>
					<p style={ { fontSize: '22px', fontWeight: 700, color: '#fff', margin: '0 0 12px' } }>{ heading }</p>
					<p style={ { fontSize: '14px', color: '#fff', margin: '0 0 20px', opacity: 0.9 } }>{ para1.substring( 0, 80 ) }{ para1.length > 80 ? '…' : '' }</p>
					<div style={ { display: 'flex', gap: '16px', justifyContent: 'center', flexWrap: 'wrap' } }>
						{ primaryText && (
							<div style={ { background: '#fff', color: '#ff5c00', padding: '14px 32px', fontWeight: 700, fontSize: '14px' } }>{ primaryText }</div>
						) }
						{ secondaryText && (
							<div style={ { background: '#020202', color: '#fff', padding: '14px 32px', fontWeight: 700, fontSize: '14px' } }>{ secondaryText }</div>
						) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
