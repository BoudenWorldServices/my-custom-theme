import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, p3, bullets, callout } = attributes;

		const updateBullet = ( index, value ) => {
			const updated = [ ...bullets ];
			updated[ index ] = value;
			setAttributes( { bullets: updated } );
		};

		const addBullet = () => {
			setAttributes( { bullets: [ ...bullets, '' ] } );
		};

		const removeBullet = ( index ) => {
			setAttributes( { bullets: bullets.filter( ( _, i ) => i !== index ) } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="End the Repair Cycle Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 3 }
						/>
						<TextareaControl
							label="Paragraph 2 (bold)"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Paragraph 3 (intro to bullet list)"
							value={ p3 }
							onChange={ ( val ) => setAttributes( { p3: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Bullet Points" initialOpen={ true }>
						{ bullets.map( ( bullet, index ) => (
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
					<PanelBody title="Orange Callout Box" initialOpen={ false }>
						<TextareaControl
							label="Callout text"
							value={ callout }
							onChange={ ( val ) => setAttributes( { callout: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#f9fafb',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						Why Goliath – End the Repair Cycle
					</p>
					<h2 style={ { margin: '8px 0 12px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#020202', fontSize: '14px', margin: '0 0 8px' } }>{ p1 }</p>
					<p style={ { color: '#020202', fontWeight: 700, fontSize: '14px', margin: '0 0 8px' } }>{ p2 }</p>
					<p style={ { color: '#020202', fontSize: '13px', margin: '0 0 8px' } }>{ p3 }</p>
					<ul style={ { paddingLeft: '16px', color: '#020202', fontSize: '13px', margin: '0 0 16px' } }>
						{ bullets.map( ( bullet, i ) => (
							<li key={ i }>{ bullet }</li>
						) ) }
					</ul>
					<div style={ { background: '#ff5c00', padding: '16px 24px', borderRadius: '2px' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '13px', margin: 0 } }>{ callout }</p>
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
