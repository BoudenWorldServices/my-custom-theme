import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { eyebrow, heading, stat, body, ctaText, ctaUrl, image, imageAlt } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Content" initialOpen={ true }>
						<TextControl
							label="Eyebrow (small uppercase label)"
							value={ eyebrow }
							onChange={ ( val ) => setAttributes( { eyebrow: val } ) }
						/>
						<TextControl
							label="Heading (orange)"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Stat / risk statement (bold)"
							value={ stat }
							onChange={ ( val ) => setAttributes( { stat: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Body paragraph"
							value={ body }
							onChange={ ( val ) => setAttributes( { body: val } ) }
							rows={ 3 }
						/>
						<TextControl
							label="CTA button text"
							value={ ctaText }
							onChange={ ( val ) => setAttributes( { ctaText: val } ) }
						/>
						<TextControl
							label="CTA button URL"
							value={ ctaUrl }
							onChange={ ( val ) => setAttributes( { ctaUrl: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Section Image" initialOpen={ false }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { image: media.url } ) }
								allowedTypes={ [ 'image' ] }
								value={ image }
								render={ ( { open } ) => (
									<>
										{ image && <img src={ image } alt="" style={ { width: '100%', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">
											{ image ? 'Change Image' : 'Choose Image' }
										</Button>
										{ image && (
											<Button
												onClick={ () => setAttributes( { image: '' } ) }
												variant="link"
												isDestructive
												style={ { marginLeft: '8px' } }
											>
												Remove
											</Button>
										) }
									</>
								) }
							/>
						</MediaUploadCheck>
						<TextControl
							label="Image alt text"
							value={ imageAlt }
							onChange={ ( val ) => setAttributes( { imageAlt: val } ) }
							style={ { marginTop: '12px' } }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '32px',
							display: 'grid',
							gridTemplateColumns: '1fr 1fr',
							gap: '32px',
							alignItems: 'center',
						},
					} ) }
				>
					<div style={ { height: '300px', background: '#e5e7eb', overflow: 'hidden' } }>
						{ image
							? <img src={ image } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover', objectPosition: 'bottom' } } />
							: <span style={ { display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#9ca3af', fontSize: '14px' } }>Section Image</span>
						}
					</div>
					<div style={ { display: 'flex', flexDirection: 'column', gap: '12px' } }>
						<p style={ { fontSize: '11px', fontWeight: 500, textTransform: 'uppercase', letterSpacing: '1.4px', color: '#020202', margin: 0 } }>{ eyebrow }</p>
						<h2 style={ { fontSize: '28px', fontWeight: 700, color: '#ff5c00', margin: 0, lineHeight: 1.2 } }>{ heading }</h2>
						<p style={ { fontSize: '14px', fontWeight: 700, color: '#020202', margin: 0 } }>{ stat }</p>
						<p style={ { fontSize: '14px', color: '#020202', margin: 0 } }>{ body }</p>
						<div style={ { background: '#ff5c00', color: '#fff', padding: '14px 20px', fontSize: '13px', fontWeight: 700, textTransform: 'uppercase', display: 'inline-flex', alignItems: 'center', gap: '8px', width: 'fit-content', marginTop: '4px' } }>
							{ ctaText } →
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
