import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, card1Title, card1Desc, card1Url, card2Title, card2Desc, card2Url, card3Title, card3Desc, card3Url } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Heading" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( val ) => setAttributes( { heading: val } ) } />
					</PanelBody>
					{ [
						[ 'Card 1', 'card1Title', 'card1Desc', 'card1Url', card1Title, card1Desc, card1Url ],
						[ 'Card 2', 'card2Title', 'card2Desc', 'card2Url', card2Title, card2Desc, card2Url ],
						[ 'Card 3', 'card3Title', 'card3Desc', 'card3Url', card3Title, card3Desc, card3Url ],
					].map( ( [ label, tKey, dKey, uKey, tVal, dVal, uVal ] ) => (
						<PanelBody key={ label } title={ label } initialOpen={ false }>
							<TextControl label="Title" value={ tVal } onChange={ ( val ) => setAttributes( { [ tKey ]: val } ) } />
							<TextareaControl label="Description" value={ dVal } onChange={ ( val ) => setAttributes( { [ dKey ]: val } ) } rows={ 2 } />
							<TextControl label="URL" value={ uVal } onChange={ ( val ) => setAttributes( { [ uKey ]: val } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#fafafa', padding: '40px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>
						FAQ Resources Grid
					</p>
					<h2 style={ { fontSize: '28px', fontWeight: 700, textAlign: 'center', marginBottom: '24px' } }>{ heading }</h2>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: '16px' } }>
						{ [ [ card1Title, card1Desc ], [ card2Title, card2Desc ], [ card3Title, card3Desc ] ].map( ( [ t, d ], i ) => (
							<div key={ i } style={ { background: '#f9fafb', padding: '20px' } }>
								<strong style={ { display: 'block', marginBottom: '8px' } }>{ t }</strong>
								<p style={ { fontSize: '14px', color: '#364153', margin: '0 0 8px' } }>{ d }</p>
								<span style={ { color: '#ff5c00', fontSize: '14px' } }>Learn More →</span>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
