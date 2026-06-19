import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl, SelectControl, ToggleControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { text, background, centered, size } = attributes;
		const bgColors = { orange: '#ff5c00', dark: '#020202', gray: '#f3f4f6' };
		const textColors = { orange: '#fff', dark: '#fff', gray: '#020202' };
		const sizePads = { small: '16px 24px', medium: '28px 32px', large: '40px 32px' };
		const sizeFonts = { small: '15px', medium: '18px', large: '22px' };

		return (
			<>
				<InspectorControls>
					<PanelBody title="Banner Settings" initialOpen={ true }>
						<TextareaControl label="Banner text" value={ text } rows={ 3 } onChange={ ( v ) => setAttributes( { text: v } ) } />
						<SelectControl label="Background colour" value={ background } options={ [ { label: 'Orange', value: 'orange' }, { label: 'Dark / black', value: 'dark' }, { label: 'Light gray', value: 'gray' } ] } onChange={ ( v ) => setAttributes( { background: v } ) } />
						<SelectControl label="Size" value={ size } options={ [ { label: 'Small', value: 'small' }, { label: 'Medium', value: 'medium' }, { label: 'Large', value: 'large' } ] } onChange={ ( v ) => setAttributes( { size: v } ) } />
						<ToggleControl label="Centre text" checked={ centered } onChange={ ( v ) => setAttributes( { centered: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: bgColors[ background ], padding: sizePads[ size ], textAlign: centered ? 'center' : 'left' } } ) }>
					<p style={ { color: textColors[ background ], fontWeight: 700, fontSize: sizeFonts[ size ], margin: 0 } }>
						{ text || 'Enter banner text in the sidebar…' }
					</p>
				</div>
			</>
		);
	},
	save() { return null; },
} );
