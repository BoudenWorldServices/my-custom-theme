import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, subtitle, p1, p2, p3, quote, quoteBullets } = attributes;

		const updateBullet = ( index, value ) => {
			const updated = [ ...quoteBullets ];
			updated[ index ] = value;
			setAttributes( { quoteBullets: updated } );
		};

		const addBullet = () => {
			setAttributes( { quoteBullets: [ ...quoteBullets, '' ] } );
		};

		const removeBullet = ( index ) => {
			setAttributes( { quoteBullets: quoteBullets.filter( ( _, i ) => i !== index ) } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Repair vs Replace Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextControl
							label="Subtitle"
							value={ subtitle }
							onChange={ ( val ) => setAttributes( { subtitle: val } ) }
						/>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 3 }
						/>
						<TextareaControl
							label="Paragraph 2"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Paragraph 3"
							value={ p3 }
							onChange={ ( val ) => setAttributes( { p3: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Orange Quote Box" initialOpen={ false }>
						<TextareaControl
							label="Quote text"
							value={ quote }
							onChange={ ( val ) => setAttributes( { quote: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
					<PanelBody title="Quote Box Bullets" initialOpen={ true }>
						{ quoteBullets.map( ( bullet, index ) => (
							<div key={ index } style={ { display: 'flex', alignItems: 'flex-start', gap: '4px', marginBottom: '8px' } }>
								<TextControl
									label={ `Bullet ${ index + 1 }` }
									value={ bullet }
									onChange={ ( val ) => updateBullet( index, val ) }
									style={ { flex: 1 } }
								/>
								<Button
									isDestructive
									variant="secondary"
									size="small"
									onClick={ () => removeBullet( index ) }
									style={ { marginTop: '24px' } }
								>
									✕
								</Button>
							</div>
						) ) }
						<Button variant="secondary" onClick={ addBullet }>
							Add bullet
						</Button>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#020202',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						Why Goliath – Repair vs Replace
					</p>
					<h2 style={ { margin: '8px 0 4px', fontSize: '24px', fontWeight: 700, color: '#fff' } }>
						{ heading }
					</h2>
					<p style={ { color: '#d1d5dc', fontSize: '14px', margin: '0 0 8px' } }>{ subtitle }</p>
					<p style={ { color: '#d1d5dc', fontSize: '13px', margin: '0 0 6px' } }>{ p1 }</p>
					<p style={ { color: '#d1d5dc', fontSize: '13px', margin: '0 0 6px' } }>{ p2 }</p>
					<p style={ { color: '#d1d5dc', fontSize: '13px', margin: '0 0 12px' } }>{ p3 }</p>
					<div style={ { background: '#ff5c00', padding: '16px', borderRadius: '2px' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '14px', margin: '0 0 8px' } }>{ quote }</p>
						<ul style={ { paddingLeft: '16px', color: '#fff', fontSize: '13px', margin: 0 } }>
							{ quoteBullets.map( ( bullet, i ) => (
								<li key={ i }>{ bullet }</li>
							) ) }
						</ul>
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
