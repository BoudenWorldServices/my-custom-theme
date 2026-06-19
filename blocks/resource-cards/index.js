import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading } = attributes;
		const cards = [ 1, 2, 3, 4 ].map( ( n ) => ( {
			n,
			title: attributes[ `card${ n }Title` ],
			desc: attributes[ `card${ n }Desc` ],
			buttonText: attributes[ `card${ n }ButtonText` ],
			url: attributes[ `card${ n }Url` ],
		} ) );
		const activeCards = cards.filter( ( c ) => c.title || c.url );

		return (
			<>
				<InspectorControls>
					{ heading !== undefined && (
						<PanelBody title="Section Settings" initialOpen={ true }>
							<TextControl label="Section heading (optional)" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						</PanelBody>
					) }
					{ cards.map( ( c ) => (
						<PanelBody key={ c.n } title={ `Card ${ c.n }${ c.n > 2 ? ' (optional)' : '' }` } initialOpen={ c.n <= 2 }>
							<TextControl label="Title" value={ c.title } onChange={ ( v ) => setAttributes( { [ `card${ c.n }Title` ]: v } ) } />
							<TextareaControl label="Description" value={ c.desc } rows={ 2 } onChange={ ( v ) => setAttributes( { [ `card${ c.n }Desc` ]: v } ) } />
							<TextControl label="Button text" value={ c.buttonText } onChange={ ( v ) => setAttributes( { [ `card${ c.n }ButtonText` ]: v } ) } />
							<TextControl label="URL" value={ c.url } onChange={ ( v ) => setAttributes( { [ `card${ c.n }Url` ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { padding: '32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Resource Cards ({ activeCards.length } card{ activeCards.length !== 1 ? 's' : '' })</p>
					{ heading && <h2 style={ { fontWeight: 700, fontSize: '20px', margin: '0 0 16px' } }>{ heading }</h2> }
					<div style={ { display: 'grid', gridTemplateColumns: `repeat(${ Math.min( activeCards.length || 1, 4 ) }, 1fr)`, gap: '16px' } }>
						{ ( activeCards.length ? activeCards : cards.slice( 0, 2 ) ).map( ( c ) => (
							<div key={ c.n } style={ { border: '1px solid #e5e7eb', borderBottom: '3px solid #ff5c00', padding: '20px' } }>
								<p style={ { fontWeight: 700, fontSize: '15px', margin: '0 0 8px' } }>{ c.title || `Card ${ c.n } Title` }</p>
								<p style={ { fontSize: '13px', color: '#666', margin: '0 0 12px' } }>{ c.desc || 'Description text…' }</p>
								<p style={ { fontSize: '12px', color: '#ff5c00', fontWeight: 600, margin: 0 } }>{ c.buttonText || 'Learn More' } →</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
