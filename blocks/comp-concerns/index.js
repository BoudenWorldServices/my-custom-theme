import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, intro, c1H3, c1P, c2H3, c2P, c3H3, c3P } = attributes;
		const cards = [
			{ label: 'Card 1', h3: c1H3, p: c1P, setH3: ( v ) => setAttributes( { c1H3: v } ), setP: ( v ) => setAttributes( { c1P: v } ) },
			{ label: 'Card 2', h3: c2H3, p: c2P, setH3: ( v ) => setAttributes( { c2H3: v } ), setP: ( v ) => setAttributes( { c2P: v } ) },
			{ label: 'Card 3', h3: c3H3, p: c3P, setH3: ( v ) => setAttributes( { c3H3: v } ), setP: ( v ) => setAttributes( { c3P: v } ) },
		];
		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Header" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Intro paragraph" value={ intro } onChange={ ( v ) => setAttributes( { intro: v } ) } rows={ 3 } />
					</PanelBody>
					{ cards.map( ( c, i ) => (
						<PanelBody key={ i } title={ c.label } initialOpen={ false }>
							<TextControl label="Heading (H3)" value={ c.h3 } onChange={ c.setH3 } />
							<TextareaControl label="Paragraph" value={ c.p } onChange={ c.setP } rows={ 4 } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '40px 32px' } } ) }>
					<h2 style={ { fontSize: '22px', fontWeight: 700, textAlign: 'center', marginBottom: '8px' } }>{ heading }</h2>
					<p style={ { textAlign: 'center', color: '#666', fontSize: '14px', marginBottom: '24px' } }>{ intro }</p>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: '16px' } }>
						{ cards.map( ( c, i ) => (
							<div key={ i } style={ { border: '1px solid #e8e8e9', padding: '24px', textAlign: 'center' } }>
								<div style={ { width: '40px', height: '40px', background: '#ff5c00', borderRadius: '50%', margin: '0 auto 12px' } }></div>
								<p style={ { fontWeight: 700, fontSize: '14px', marginBottom: '8px' } }>{ c.h3 }</p>
								<p style={ { fontSize: '12px', color: '#666' } }>{ c.p }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
