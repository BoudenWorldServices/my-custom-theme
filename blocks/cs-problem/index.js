import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { title, problemText, problemCallout, triedText, triedCallout } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Heading" initialOpen={ true }>
						<TextControl
							label="Section title (displayed in orange above the two columns)"
							value={ title }
							onChange={ ( val ) => setAttributes( { title: val } ) }
							placeholder="e.g. How B&M Eliminated Pallet Racking Damage"
						/>
					</PanelBody>
					<PanelBody title="The Problem Column" initialOpen={ true }>
						<TextareaControl
							label="Problem text (separate paragraphs with a blank line)"
							value={ problemText }
							onChange={ ( val ) => setAttributes( { problemText: val } ) }
							rows={ 6 }
						/>
						<TextControl
							label="Problem callout (bold orange text — leave blank to hide)"
							value={ problemCallout }
							onChange={ ( val ) => setAttributes( { problemCallout: val } ) }
						/>
					</PanelBody>
					<PanelBody title="What They Tried Column" initialOpen={ false }>
						<TextareaControl
							label="Tried text (separate paragraphs with a blank line)"
							value={ triedText }
							onChange={ ( val ) => setAttributes( { triedText: val } ) }
							rows={ 6 }
						/>
						<TextControl
							label="Tried callout (bold orange text — leave blank to hide)"
							value={ triedCallout }
							onChange={ ( val ) => setAttributes( { triedCallout: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '32px',
							borderBottom: '1px solid #dedfe0',
						},
					} ) }
				>
					{ title && (
						<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '28px', margin: '0 0 16px' } }>
							{ title }
						</p>
					) }
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px' } }>
						<div>
							<p style={ { fontWeight: 700, fontSize: '20px', color: '#020202', margin: '0 0 8px' } }>The Problem</p>
							<p style={ { color: '#555', fontSize: '14px', margin: 0 } }>
								{ problemText || '(problem text — edit in sidebar)' }
							</p>
							{ problemCallout && (
								<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '13px', marginTop: '8px' } }>
									{ problemCallout }
								</p>
							) }
						</div>
						<div>
							<p style={ { fontWeight: 700, fontSize: '20px', color: '#020202', margin: '0 0 8px' } }>What They Tried</p>
							<p style={ { color: '#555', fontSize: '14px', margin: 0 } }>
								{ triedText || '(tried text — edit in sidebar)' }
							</p>
							{ triedCallout && (
								<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '13px', marginTop: '8px' } }>
									{ triedCallout }
								</p>
							) }
						</div>
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
