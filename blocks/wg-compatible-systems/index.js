import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, bold, items } = attributes;

		const updateItem = ( index, value ) => {
			const updated = [ ...items ];
			updated[ index ] = value;
			setAttributes( { items: updated } );
		};

		const addItem = () => {
			setAttributes( { items: [ ...items, '' ] } );
		};

		const removeItem = ( index ) => {
			setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Compatible Systems Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Paragraph 2"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 4 }
						/>
						<TextControl
							label="Bold intro line (before bullet grid)"
							value={ bold }
							onChange={ ( val ) => setAttributes( { bold: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Grid Items" initialOpen={ true }>
						{ items.map( ( item, index ) => (
							<div key={ index } style={ { display: 'flex', alignItems: 'flex-start', gap: '4px', marginBottom: '8px' } }>
								<TextControl
									label={ `Item ${ index + 1 }` }
									value={ item }
									onChange={ ( val ) => updateItem( index, val ) }
									style={ { flex: 1 } }
								/>
								<Button
									isDestructive
									variant="secondary"
									size="small"
									onClick={ () => removeItem( index ) }
									style={ { marginTop: '24px' } }
								>
									✕
								</Button>
							</div>
						) ) }
						<Button variant="secondary" onClick={ addItem }>
							Add item
						</Button>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						Why Goliath – Compatible Systems
					</p>
					<h2 style={ { margin: '8px 0 12px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 8px' } }>{ p1 }</p>
					<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 12px' } }>{ p2 }</p>
					<p style={ { color: '#020202', fontWeight: 700, fontSize: '15px', margin: '0 0 8px' } }>{ bold }</p>
					<ul style={ { paddingLeft: '16px', color: '#364153', fontSize: '13px', margin: 0 } }>
						{ items.map( ( item, i ) => (
							<li key={ i }>{ item }</li>
						) ) }
					</ul>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
