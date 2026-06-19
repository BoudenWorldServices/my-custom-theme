import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { videoUrl, heading, body, callout, videoPosition } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Video" initialOpen={ true }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { videoUrl: media.url } ) }
								allowedTypes={ [ 'video' ] }
								render={ ( { open } ) => (
									<>
										{ videoUrl && (
											<p style={ { fontSize: '12px', color: '#333', marginBottom: '8px', wordBreak: 'break-all' } }>
												{ videoUrl.split( '/' ).pop() }
											</p>
										) }
										<Button onClick={ open } variant="secondary">
											{ videoUrl ? 'Change video' : 'Choose video (MP4)' }
										</Button>
										{ videoUrl && (
											<Button onClick={ () => setAttributes( { videoUrl: '' } ) } variant="link" isDestructive style={ { marginLeft: '8px' } }>
												Remove
											</Button>
										) }
									</>
								) }
							/>
						</MediaUploadCheck>
						<SelectControl
							label="Video position"
							value={ videoPosition }
							options={ [
								{ label: 'Video on the left', value: 'left' },
								{ label: 'Video on the right', value: 'right' },
							] }
							onChange={ ( val ) => setAttributes( { videoPosition: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Text Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Body text"
							value={ body }
							onChange={ ( val ) => setAttributes( { body: val } ) }
							rows={ 4 }
						/>
						<TextControl
							label="Orange callout strip text (optional)"
							value={ callout }
							onChange={ ( val ) => setAttributes( { callout: val } ) }
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
							gap: '24px',
							alignItems: 'start',
						},
					} ) }
				>
					<div style={ { order: videoPosition === 'right' ? 2 : 1, background: '#000', aspectRatio: '16/9', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
						{ videoUrl
							? <p style={ { color: '#fff', fontSize: '12px', textAlign: 'center', padding: '8px' } }>▶ { videoUrl.split( '/' ).pop() }</p>
							: <p style={ { color: '#666', fontSize: '12px' } }>No video selected</p>
						}
					</div>
					<div style={ { order: videoPosition === 'right' ? 1 : 2 } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Video Section</p>
						{ heading && <h2 style={ { fontSize: '22px', fontWeight: 700, color: '#ff5c00', margin: '0 0 12px' } }>{ heading }</h2> }
						{ body && <p style={ { color: '#555', fontSize: '14px', margin: '0 0 12px' } }>{ body.substring( 0, 150 ) }{ body.length > 150 ? '…' : '' }</p> }
						{ callout && <p style={ { background: '#ff6b2c', color: '#fff', padding: '12px 16px', fontWeight: 700, fontSize: '13px', margin: 0 } }>{ callout }</p> }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
