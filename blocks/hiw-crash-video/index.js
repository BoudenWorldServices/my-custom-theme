import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { headline, videoFile, videoUrl, posterUrl, fallbackText, fallbackUrl } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Orange Panel" initialOpen={ true }>
						<TextareaControl label="Headline" value={ headline } onChange={ ( v ) => setAttributes( { headline: v } ) } />
					</PanelBody>
					<PanelBody title="Video" initialOpen={ true }>
						<TextControl label="Video filename (theme assets)" value={ videoFile } onChange={ ( v ) => setAttributes( { videoFile: v } ) } help="File in assets/videos/. Leave for default." />
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { videoUrl: media.url } ) }
								allowedTypes={ [ 'video' ] }
								render={ ( { open } ) => (
									<div style={ { marginBottom: '12px' } }>
										<Button variant="secondary" onClick={ open }>{ videoUrl ? 'Replace video' : 'Upload video' }</Button>
										{ videoUrl && <Button variant="link" isDestructive onClick={ () => setAttributes( { videoUrl: '' } ) } style={ { marginLeft: '8px' } }>Remove</Button> }
										{ videoUrl && <p style={ { fontSize: '11px', color: '#555', marginTop: '4px' } }>{ videoUrl }</p> }
									</div>
								) }
							/>
						</MediaUploadCheck>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { posterUrl: media.url } ) }
								allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<div style={ { marginBottom: '12px' } }>
										{ posterUrl && <img src={ posterUrl } alt="" style={ { maxWidth: '100%', marginBottom: '4px' } } /> }
										<Button variant="secondary" onClick={ open }>{ posterUrl ? 'Replace poster' : 'Upload poster image' }</Button>
										{ posterUrl && <Button variant="link" isDestructive onClick={ () => setAttributes( { posterUrl: '' } ) } style={ { marginLeft: '8px' } }>Remove</Button> }
									</div>
								) }
							/>
						</MediaUploadCheck>
					</PanelBody>
					<PanelBody title="Fallback (when no video)" initialOpen={ false }>
						<TextControl label="Button text" value={ fallbackText } onChange={ ( v ) => setAttributes( { fallbackText: v } ) } />
						<TextControl label="Link URL" value={ fallbackUrl } onChange={ ( v ) => setAttributes( { fallbackUrl: v } ) } help="Leave empty to auto-link to /videos/{filename}/" />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { display: 'flex', overflow: 'hidden' } } ) }>
					<div style={ { flex: '0 0 35%', background: '#ff5c00', padding: '32px', display: 'flex', alignItems: 'center' } }>
						<p style={ { color: '#fff', fontWeight: 700, fontSize: '20px', lineHeight: 1.2 } }>{ headline }</p>
					</div>
					<div style={ { flex: 1, background: '#000', minHeight: '200px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
						<span style={ { color: '#fff', fontSize: '12px' } }>{ videoUrl || videoFile || 'No video' }</span>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
