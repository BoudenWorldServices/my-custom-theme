import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			heading, intro1, intro2,
			card1Title, card1Body,
			card2Title, card2Body,
			card3Title, card3Body,
			card4Title, card4Body,
			closing,
		} = attributes;

		const cards = [
			{ title: card1Title, body: card1Body, tKey: 'card1Title', bKey: 'card1Body', n: 1 },
			{ title: card2Title, body: card2Body, tKey: 'card2Title', bKey: 'card2Body', n: 2 },
			{ title: card3Title, body: card3Body, tKey: 'card3Title', bKey: 'card3Body', n: 3 },
			{ title: card4Title, body: card4Body, tKey: 'card4Title', bKey: 'card4Body', n: 4 },
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextareaControl label="Intro paragraph 1" value={ intro1 } rows={ 3 } onChange={ ( v ) => setAttributes( { intro1: v } ) } />
						<TextareaControl label="Intro paragraph 2" value={ intro2 } rows={ 2 } onChange={ ( v ) => setAttributes( { intro2: v } ) } />
						<TextareaControl label="Closing paragraph" value={ closing } rows={ 3 } onChange={ ( v ) => setAttributes( { closing: v } ) } />
					</PanelBody>
					{ cards.map( ( c ) => (
						<PanelBody key={ c.n } title={ `Card ${ c.n }` } initialOpen={ false }>
							<TextControl label="Title" value={ c.title } onChange={ ( v ) => setAttributes( { [ c.tKey ]: v } ) } />
							<TextareaControl label="Body" value={ c.body } rows={ 3 } onChange={ ( v ) => setAttributes( { [ c.bKey ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>HIW UK Standards</p>
					<p style={ { fontSize: '20px', fontWeight: 700, color: '#020202', margin: '0 0 16px' } }>{ heading }</p>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '16px' } }>
						{ cards.map( ( c ) => (
							<div key={ c.n } style={ { background: '#f9fafb', borderRadius: '8px', padding: '16px' } }>
								<div style={ { width: '32px', height: '32px', background: '#ff5c00', borderRadius: '4px', marginBottom: '8px' } }></div>
								<p style={ { fontWeight: 700, fontSize: '13px', margin: '0 0 4px' } }>{ c.title }</p>
								<p style={ { fontSize: '12px', color: '#555', margin: 0 } }>{ c.body.substring( 0, 60 ) }{ c.body.length > 60 ? '…' : '' }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
