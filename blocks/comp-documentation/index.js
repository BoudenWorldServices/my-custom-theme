import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, subtitle, card1H3, card1Sub, card2H3, card2Sub, card3H3, card3Sub, closing } = attributes;
		const cards = [
			{ label: 'Card 1', h3: card1H3, sub: card1Sub, setH3: ( v ) => setAttributes( { card1H3: v } ), setSub: ( v ) => setAttributes( { card1Sub: v } ) },
			{ label: 'Card 2', h3: card2H3, sub: card2Sub, setH3: ( v ) => setAttributes( { card2H3: v } ), setSub: ( v ) => setAttributes( { card2Sub: v } ) },
			{ label: 'Card 3', h3: card3H3, sub: card3Sub, setH3: ( v ) => setAttributes( { card3H3: v } ), setSub: ( v ) => setAttributes( { card3Sub: v } ) },
		];
		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Header" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextControl label="Subtitle" value={ subtitle } onChange={ ( v ) => setAttributes( { subtitle: v } ) } />
					</PanelBody>
					{ cards.map( ( c, i ) => (
						<PanelBody key={ i } title={ c.label } initialOpen={ false }>
							<TextControl label="Heading (H3)" value={ c.h3 } onChange={ c.setH3 } />
							<TextControl label="Sub-label" value={ c.sub } onChange={ c.setSub } />
						</PanelBody>
					) ) }
					<PanelBody title="Closing Paragraph" initialOpen={ false }>
						<TextareaControl label="Closing text" value={ closing } onChange={ ( v ) => setAttributes( { closing: v } ) } rows={ 4 } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#020202', padding: '40px 32px' } } ) }>
					<h2 style={ { color: '#fff', fontSize: '22px', fontWeight: 700, marginBottom: '8px' } }>{ heading }</h2>
					<p style={ { color: '#fff', fontSize: '16px', marginBottom: '24px' } }>{ subtitle }</p>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: '16px' } }>
						{ cards.map( ( c, i ) => (
							<div key={ i } style={ { background: 'rgba(255,255,255,0.1)', padding: '20px' } }>
								<div style={ { width: '32px', height: '32px', background: '#fff', opacity: 0.3, marginBottom: '12px' } }></div>
								<p style={ { color: '#fff', fontWeight: 700, fontSize: '14px', marginBottom: '4px' } }>{ c.h3 }</p>
								<p style={ { color: 'rgba(255,255,255,0.7)', fontSize: '12px' } }>{ c.sub }</p>
							</div>
						) ) }
					</div>
					{ closing && <p style={ { color: '#fff', fontSize: '14px', marginTop: '24px' } }>{ closing }</p> }
				</div>
			</>
		);
	},
	save() { return null; },
} );
