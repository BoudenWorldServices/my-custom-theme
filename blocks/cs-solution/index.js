import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { video, solutionText, solutionCallout } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Solution Video (optional)" initialOpen={ true }>
						<TextControl
							label="Video URL or filename (leave blank to hide)"
							value={ video }
							onChange={ ( val ) => setAttributes( { video: val } ) }
							placeholder="e.g. goliath-demo.mp4 or https://…"
							help="Enter a full URL or a filename stored in the theme's assets/videos/ folder."
						/>
					</PanelBody>
					<PanelBody title="Solution Text" initialOpen={ true }>
						<TextareaControl
							label="Solution body (separate paragraphs with a blank line)"
							value={ solutionText }
							onChange={ ( val ) => setAttributes( { solutionText: val } ) }
							rows={ 6 }
						/>
					</PanelBody>
					<PanelBody title="Orange Callout Box (optional)" initialOpen={ false }>
						<TextareaControl
							label="Callout text (leave blank to hide)"
							value={ solutionCallout }
							onChange={ ( val ) => setAttributes( { solutionCallout: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '32px',
							display: 'flex',
							gap: '24px',
							alignItems: 'flex-start',
						},
					} ) }
				>
					{ video && (
						<div style={ { flex: 1, background: '#000', aspectRatio: '16/9', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
							<span style={ { color: '#fff', opacity: 0.7, fontSize: '13px' } }>▶ Video: { video }</span>
						</div>
					) }
					<div style={ { flex: 1 } }>
						<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '22px', margin: '0 0 12px' } }>
							The Solution: Goliath™
						</p>
						<p style={ { color: '#555', fontSize: '14px', margin: 0 } }>
							{ solutionText || '(solution text — edit in sidebar)' }
						</p>
						{ solutionCallout && (
							<div style={ { marginTop: '16px', background: '#ff6b2c', padding: '16px 24px' } }>
								<p style={ { color: '#fff', fontWeight: 700, fontSize: '14px', margin: 0 } }>
									{ solutionCallout }
								</p>
							</div>
						) }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
