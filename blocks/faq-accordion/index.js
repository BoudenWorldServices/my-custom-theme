import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { items } = attributes;

		const updateItem = ( index, key, value ) => {
			const updated = items.map( ( item, i ) =>
				i === index ? { ...item, [ key ]: value } : item
			);
			setAttributes( { items: updated } );
		};

		const addItem = () => {
			setAttributes( { items: [ ...items, { question: '', answer: '' } ] } );
		};

		const removeItem = ( index ) => {
			setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="FAQ Items" initialOpen={ true }>
						<p style={ { fontSize: '12px', color: '#666', marginBottom: '12px' } }>
							Add each question and answer. Leave empty to use the global FAQ items from Theme Settings.
						</p>
						{ items.map( ( item, index ) => (
							<div key={ index } style={ { borderBottom: '1px solid #eee', paddingBottom: '16px', marginBottom: '16px' } }>
								<div style={ { display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '8px' } }>
									<strong style={ { fontSize: '13px' } }>Item { index + 1 }</strong>
									<Button isDestructive variant="link" onClick={ () => removeItem( index ) } style={ { fontSize: '12px' } }>Remove</Button>
								</div>
								<TextControl
									label="Question"
									value={ item.question }
									onChange={ ( val ) => updateItem( index, 'question', val ) }
								/>
								<TextareaControl
									label="Answer (use blank lines to separate paragraphs)"
									value={ item.answer }
									onChange={ ( val ) => updateItem( index, 'answer', val ) }
									rows={ 4 }
								/>
							</div>
						) ) }
						<Button variant="secondary" onClick={ addItem }>+ Add FAQ Item</Button>
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#fff', padding: '40px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 16px' } }>
						FAQ Accordion ({ items.length } items{ items.length === 0 ? ' — will use global FAQ' : '' })
					</p>
					{ items.length === 0 && (
						<p style={ { color: '#888', fontStyle: 'italic', fontSize: '14px' } }>
							No items set — global FAQ items will render on the front end.
						</p>
					) }
					{ items.slice( 0, 5 ).map( ( item, i ) => (
						<div key={ i } style={ { borderBottom: '1px solid #dedfe0', padding: '16px 0', cursor: 'pointer' } }>
							<div style={ { display: 'flex', justifyContent: 'space-between', alignItems: 'center' } }>
								<strong style={ { fontSize: '15px' } }>{ item.question || `Question ${ i + 1 }` }</strong>
								<span style={ { color: '#6b7280', fontSize: '18px' } }>▾</span>
							</div>
						</div>
					) ) }
					{ items.length > 5 && (
						<p style={ { color: '#888', fontSize: '13px', marginTop: '8px' } }>+ { items.length - 5 } more items</p>
					) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
