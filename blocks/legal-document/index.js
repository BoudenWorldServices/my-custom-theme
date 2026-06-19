import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { introText } = attributes;
		const sections = [];
		for ( let n = 1; n <= 8; n++ ) {
			sections.push( { n, heading: attributes[ `section${ n }Heading` ], body: attributes[ `section${ n }Body` ] } );
		}
		const activeSections = sections.filter( ( s ) => s.heading || s.body );

		return (
			<>
				<InspectorControls>
					<PanelBody title="Intro" initialOpen={ true }>
						<TextareaControl label="Introductory paragraph(s)" value={ introText } rows={ 4 } onChange={ ( v ) => setAttributes( { introText: v } ) } />
					</PanelBody>
					{ sections.map( ( s ) => (
						<PanelBody key={ s.n } title={ `Section ${ s.n }${ s.n > 4 ? ' (optional)' : '' }` } initialOpen={ s.n <= 2 }>
							<TextControl label="Heading" value={ s.heading } onChange={ ( v ) => setAttributes( { [ `section${ s.n }Heading` ]: v } ) } />
							<TextareaControl label="Body text (blank line = new paragraph)" value={ s.body } rows={ 5 } onChange={ ( v ) => setAttributes( { [ `section${ s.n }Body` ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px', maxWidth: '760px', margin: '0 auto' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Legal Document ({ activeSections.length } section{ activeSections.length !== 1 ? 's' : '' })</p>
					{ introText && <p style={ { color: '#555', fontSize: '14px', borderLeft: '3px solid #e5e7eb', paddingLeft: '12px', marginBottom: '16px' } }>{ introText.substring( 0, 150 ) }{ introText.length > 150 ? '…' : '' }</p> }
					{ activeSections.slice( 0, 3 ).map( ( s ) => (
						<div key={ s.n } style={ { marginBottom: '16px' } }>
							{ s.heading && <h2 style={ { fontWeight: 700, fontSize: '17px', margin: '0 0 4px', color: '#020202' } }>{ s.heading }</h2> }
							{ s.body && <p style={ { color: '#666', fontSize: '13px', margin: 0 } }>{ s.body.substring( 0, 100 ) }{ s.body.length > 100 ? '…' : '' }</p> }
						</div>
					) ) }
					{ activeSections.length > 3 && <p style={ { color: '#aaa', fontSize: '12px' } }>+ { activeSections.length - 3 } more sections</p> }
				</div>
			</>
		);
	},
	save() { return null; },
} );
