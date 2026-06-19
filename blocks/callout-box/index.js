import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, ToggleControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { text, subtext, theme, showArrow, layout } = attributes;
		const bgColors = { orange: '#ff5c00', dark: '#020202', gray: '#f3f4f6' };
		const textColors = { orange: '#fff', dark: '#fff', gray: '#020202' };

		return (
			<>
				<InspectorControls>
					<PanelBody title="Callout Box" initialOpen={ true }>
						<TextareaControl label="Main text" value={ text } rows={ 3 } onChange={ ( v ) => setAttributes( { text: v } ) } />
						<TextControl label="Sub-text (optional)" value={ subtext } onChange={ ( v ) => setAttributes( { subtext: v } ) } />
						<SelectControl label="Theme" value={ theme } options={ [ { label: 'Orange', value: 'orange' }, { label: 'Dark / black', value: 'dark' }, { label: 'Gray', value: 'gray' } ] } onChange={ ( v ) => setAttributes( { theme: v } ) } />
						<SelectControl label="Layout" value={ layout } options={ [ { label: 'Full width', value: 'full-width' }, { label: 'Inset (with margin)', value: 'inset' } ] } onChange={ ( v ) => setAttributes( { layout: v } ) } />
						<ToggleControl label="Show arrow →" checked={ showArrow } onChange={ ( v ) => setAttributes( { showArrow: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { padding: layout === 'inset' ? '0 32px' : '0' } } ) }>
					<div style={ { background: bgColors[ theme ], padding: '24px 32px', display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: '16px' } }>
						<div>
							<p style={ { color: textColors[ theme ], fontWeight: 700, fontSize: '17px', margin: subtext ? '0 0 4px' : 0 } }>
								{ text || 'Enter callout text in the sidebar…' }
							</p>
							{ subtext && <p style={ { color: textColors[ theme ], opacity: 0.8, fontSize: '13px', margin: 0 } }>{ subtext }</p> }
						</div>
						{ showArrow && <span style={ { color: textColors[ theme ], fontSize: '24px', flexShrink: 0 } }>→</span> }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
