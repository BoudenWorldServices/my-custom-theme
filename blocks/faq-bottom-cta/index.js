import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { image, imageAlt, heading, body, buttonText, buttonUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Image" initialOpen={ true }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { image: media.url, imageAlt: media.alt || imageAlt } ) }
								allowedTypes={ [ 'image' ] }
								value={ image }
								render={ ( { open } ) => (
									<>
										{ image && <img src={ image } alt="" style={ { width: '100%', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">{ image ? 'Change Image' : 'Choose Image' }</Button>
									</>
								) }
							/>
						</MediaUploadCheck>
						<TextControl label="Alt text" value={ imageAlt } onChange={ ( val ) => setAttributes( { imageAlt: val } ) } />
					</PanelBody>
					<PanelBody title="Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( val ) => setAttributes( { heading: val } ) } />
						<TextareaControl label="Body text" value={ body } onChange={ ( val ) => setAttributes( { body: val } ) } rows={ 3 } />
						<TextControl label="Button text" value={ buttonText } onChange={ ( val ) => setAttributes( { buttonText: val } ) } />
						<TextControl label="Button URL" value={ buttonUrl } onChange={ ( val ) => setAttributes( { buttonUrl: val } ) } />
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#ff5c00', padding: '48px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: 'rgba(0,0,0,0.5)', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>
						FAQ Bottom CTA
					</p>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '32px', alignItems: 'center' } }>
						<div style={ { background: 'rgba(0,0,0,0.2)', height: '200px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
							{ image ? <img src={ image } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : <span style={ { color: '#fff' } }>CTA Image</span> }
						</div>
						<div>
							<p style={ { fontSize: '24px', fontWeight: 700, color: '#020202', margin: '0 0 12px' } }>{ heading }</p>
							<p style={ { fontSize: '14px', fontWeight: 700, color: '#364153', margin: '0 0 16px' } }>{ body }</p>
							<div style={ { display: 'inline-flex', background: '#020202', color: '#fff', padding: '14px 24px', fontSize: '14px', fontWeight: 700, alignItems: 'center', gap: '8px' } }>
								{ buttonText } →
							</div>
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
