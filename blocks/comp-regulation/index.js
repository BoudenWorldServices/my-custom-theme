import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, boxH3, boxP } = attributes;
		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Content" initialOpen={ true }>
						<TextControl
							label="Heading (first word white, rest orange)"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Paragraph 2"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
					<PanelBody title="Dark Callout Box" initialOpen={ false }>
						<TextControl
							label="Box heading (H3)"
							value={ boxH3 }
							onChange={ ( val ) => setAttributes( { boxH3: val } ) }
						/>
						<TextareaControl
							label="Box paragraph"
							value={ boxP }
							onChange={ ( val ) => setAttributes( { boxP: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '40px 32px', borderLeft: '4px solid #ff5c00' } } ) }>
					<h2 style={ { fontSize: '28px', fontWeight: 700, color: '#020202', margin: '0 0 12px' } }>
						{ heading.split( ' ' )[0] }{ ' ' }
						<span style={ { color: '#ff5c00' } }>{ heading.split( ' ' ).slice( 1 ).join( ' ' ) }</span>
					</h2>
					<p style={ { color: '#666', fontSize: '14px', margin: '0 0 16px' } }>{ p1 }</p>
					<div style={ { background: '#020202', padding: '20px', display: 'flex', gap: '16px', alignItems: 'flex-start' } }>
						<div style={ { background: '#ff5c00', width: '48px', height: '48px', flexShrink: 0 } }></div>
						<div>
							<p style={ { color: '#fff', fontWeight: 700, margin: '0 0 4px', fontSize: '14px' } }>{ boxH3 }</p>
							<p style={ { color: '#fff', fontSize: '13px', margin: 0 } }>{ boxP }</p>
						</div>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
