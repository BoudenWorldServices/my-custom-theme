import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, useGlobalContactDetails } = attributes;
		const cards = [
			{ n: 1, title: attributes.card1Title, subtitle: attributes.card1Subtitle },
			{ n: 2, title: attributes.card2Title, subtitle: attributes.card2Subtitle },
			{ n: 3, title: attributes.card3Title, subtitle: attributes.card3Subtitle },
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title="Contact Cards" initialOpen={ true }>
						<TextControl label="Section heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<ToggleControl label="Use global contact details (phone/email/address from site settings)" checked={ useGlobalContactDetails } onChange={ ( v ) => setAttributes( { useGlobalContactDetails: v } ) } />
					</PanelBody>
					{ !useGlobalContactDetails && [ 1, 2, 3 ].map( ( n ) => (
						<PanelBody key={ n } title={ `Card ${ n }` } initialOpen={ n === 1 }>
							<TextControl label="Title" value={ attributes[ `card${ n }Title` ] } onChange={ ( v ) => setAttributes( { [ `card${ n }Title` ]: v } ) } />
							<TextControl label="Subtitle / number / email" value={ attributes[ `card${ n }Subtitle` ] } onChange={ ( v ) => setAttributes( { [ `card${ n }Subtitle` ]: v } ) } />
							<TextControl label="Link URL (optional)" value={ attributes[ `card${ n }Href` ] } onChange={ ( v ) => setAttributes( { [ `card${ n }Href` ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { padding: '32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Contact Info Cards</p>
					{ heading && <h2 style={ { fontWeight: 700, fontSize: '20px', margin: '0 0 16px' } }>{ heading }</h2> }
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: '16px' } }>
						{ cards.map( ( card ) => (
							<div key={ card.n } style={ { border: '1px solid #e5e7eb', padding: '20px' } }>
								<div style={ { width: '40px', height: '40px', background: '#ff5c00', marginBottom: '12px' } }></div>
								<p style={ { fontWeight: 700, fontSize: '15px', margin: '0 0 4px' } }>{ card.title }</p>
								<p style={ { fontSize: '13px', color: '#888', margin: 0 } }>{ useGlobalContactDetails ? '(from site settings)' : ( card.subtitle || '—' ) }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
