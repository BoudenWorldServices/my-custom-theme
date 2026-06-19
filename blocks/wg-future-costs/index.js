import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, bullets, p3, p4 } = attributes;

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
					<PanelBody title="Future Costs Content" initialOpen={ true }>
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
							label="Paragraph 2 (intro to bullet list)"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Paragraph 3 (after bullet list)"
							value={ p3 }
							onChange={ ( val ) => setAttributes( { p3: val } ) }
							rows={ 3 }
						/>
						<TextareaControl
							label="Paragraph 4"
							value={ p4 }
							onChange={ ( val ) => setAttributes( { p4: val } ) }
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
						Why Goliath – Future Costs
					</p>
					<h2 style={ { margin: '8px 0 12px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p1 }</p>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p2 }</p>
					<ul style={ { paddingLeft: '16px', color: '#364153', fontSize: '13px', margin: '0 0 8px' } }>
						{ bullets.map( ( bullet, i ) => (
							<li key={ i }>{ bullet }</li>
						) ) }
					</ul>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p3 }</p>
					<p style={ { color: '#364153', fontSize: '14px', margin: 0 } }>{ p4 }</p>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
