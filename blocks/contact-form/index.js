import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { formHeading, sidebarLine1, sidebarLine2, sidebarBody, whyHeading, bullet1, bullet2, bullet3, bullet4 } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Heading" initialOpen={ true }>
						<TextControl
							label="Form section heading (orange H2)"
							value={ formHeading }
							onChange={ ( val ) => setAttributes( { formHeading: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Sidebar — Large Text" initialOpen={ true }>
						<TextControl
							label="Large text line 1"
							value={ sidebarLine1 }
							onChange={ ( val ) => setAttributes( { sidebarLine1: val } ) }
						/>
						<TextControl
							label="Large text line 2"
							value={ sidebarLine2 }
							onChange={ ( val ) => setAttributes( { sidebarLine2: val } ) }
						/>
						<TextareaControl
							label="Body paragraph"
							value={ sidebarBody }
							onChange={ ( val ) => setAttributes( { sidebarBody: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
					<PanelBody title="Sidebar — Why Request?" initialOpen={ false }>
						<TextControl
							label="Section heading"
							value={ whyHeading }
							onChange={ ( val ) => setAttributes( { whyHeading: val } ) }
						/>
						<TextControl label="Bullet 1" value={ bullet1 } onChange={ ( val ) => setAttributes( { bullet1: val } ) } />
						<TextControl label="Bullet 2" value={ bullet2 } onChange={ ( val ) => setAttributes( { bullet2: val } ) } />
						<TextControl label="Bullet 3" value={ bullet3 } onChange={ ( val ) => setAttributes( { bullet3: val } ) } />
						<TextControl label="Bullet 4" value={ bullet4 } onChange={ ( val ) => setAttributes( { bullet4: val } ) } />
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#fff', padding: '40px 32px', borderLeft: '4px solid #ff5c00' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>
						Contact Form Section
					</p>
					<p style={ { fontSize: '24px', fontWeight: 700, color: '#ff5c00', margin: '0 0 8px' } }>{ formHeading }</p>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px', marginTop: '16px' } }>
						<div>
							<p style={ { fontSize: '28px', fontWeight: 700, margin: '0' } }>{ sidebarLine1 }</p>
							<p style={ { fontSize: '36px', fontWeight: 700, margin: '0' } }>{ sidebarLine2 }</p>
							<div style={ { width: '48px', height: '4px', background: '#ff5c00', margin: '8px 0 12px' } }></div>
							<p style={ { fontSize: '14px', color: '#555', margin: '0 0 12px' } }>{ sidebarBody }</p>
							<strong style={ { fontSize: '14px' } }>{ whyHeading }</strong>
							<ul style={ { marginTop: '8px', paddingLeft: '16px', fontSize: '14px', color: '#333' } }>
								{ [ bullet1, bullet2, bullet3, bullet4 ].filter( Boolean ).map( ( b, i ) => <li key={ i }>{ b }</li> ) }
							</ul>
						</div>
						<div style={ { background: '#f9fafb', padding: '24px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
							<p style={ { color: '#888', fontSize: '14px', textAlign: 'center' } }>Assessment request form renders on the front end</p>
						</div>
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
