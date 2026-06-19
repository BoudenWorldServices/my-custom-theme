import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, card1Title, card1Body, card2Title, card2Body, card3Title, card3Body, card4Title, card4Body } = attributes;
		const cards = [
			{ title: card1Title, body: card1Body, setTitle: ( v ) => setAttributes( { card1Title: v } ), setBody: ( v ) => setAttributes( { card1Body: v } ) },
			{ title: card2Title, body: card2Body, setTitle: ( v ) => setAttributes( { card2Title: v } ), setBody: ( v ) => setAttributes( { card2Body: v } ) },
			{ title: card3Title, body: card3Body, setTitle: ( v ) => setAttributes( { card3Title: v } ), setBody: ( v ) => setAttributes( { card3Body: v } ) },
			{ title: card4Title, body: card4Body, setTitle: ( v ) => setAttributes( { card4Title: v } ), setBody: ( v ) => setAttributes( { card4Body: v } ) },
		];
		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Paragraph 1" value={ p1 } onChange={ ( v ) => setAttributes( { p1: v } ) } rows={ 3 } />
						<TextareaControl label="Paragraph 2" value={ p2 } onChange={ ( v ) => setAttributes( { p2: v } ) } rows={ 3 } />
					</PanelBody>
					{ cards.map( ( c, i ) => (
						<PanelBody key={ i } title={ `Card ${ i + 1 }` } initialOpen={ false }>
							<TextControl label="Title" value={ c.title } onChange={ c.setTitle } />
							<TextareaControl label="Body" value={ c.body } onChange={ c.setBody } rows={ 3 } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px' } } ) }>
					<h2 style={ { fontSize: '22px', fontWeight: 700, color: '#020202', marginBottom: '12px' } }>{ heading }</h2>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(4,1fr)', gap: '12px', marginTop: '16px' } }>
						{ cards.map( ( c, i ) => (
							<div key={ i } style={ { background: '#f9fafb', borderRadius: '8px', padding: '16px' } }>
								<div style={ { width: '32px', height: '32px', background: '#ff5c00', borderRadius: '4px', marginBottom: '8px' } }></div>
								<p style={ { fontWeight: 700, fontSize: '13px', color: '#020202', margin: '0 0 4px' } }>{ c.title }</p>
								<p style={ { fontSize: '12px', color: '#364153', margin: 0 } }>{ c.body }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
