import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			photo, description,
			benefit1Title, benefit1Subtitle,
			benefit2Title, benefit2Subtitle,
			benefit3Title, benefit3Subtitle,
			benefit4Title, benefit4Subtitle,
		} = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Photo" initialOpen={ true }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { photo: media.url } ) }
								allowedTypes={ [ 'image' ] }
								value={ photo }
								render={ ( { open } ) => (
									<>
										{ photo && <img src={ photo } alt="" style={ { width: '100%', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">
											{ photo ? 'Change Photo' : 'Choose Photo' }
										</Button>
									</>
								) }
							/>
						</MediaUploadCheck>
					</PanelBody>
					<PanelBody title="Description" initialOpen={ true }>
						<TextareaControl
							label="Description paragraph"
							value={ description }
							onChange={ ( val ) => setAttributes( { description: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
					<PanelBody title="Benefit Items" initialOpen={ true }>
						{ [
							[ 'Benefit 1', 'benefit1Title', 'benefit1Subtitle', benefit1Title, benefit1Subtitle ],
							[ 'Benefit 2', 'benefit2Title', 'benefit2Subtitle', benefit2Title, benefit2Subtitle ],
							[ 'Benefit 3', 'benefit3Title', 'benefit3Subtitle', benefit3Title, benefit3Subtitle ],
							[ 'Benefit 4', 'benefit4Title', 'benefit4Subtitle', benefit4Title, benefit4Subtitle ],
						].map( ( [ label, titleKey, subKey, titleVal, subVal ] ) => (
							<div key={ label } style={ { marginBottom: '16px', borderBottom: '1px solid #eee', paddingBottom: '16px' } }>
								<strong>{ label }</strong>
								<TextControl
									label="Title"
									value={ titleVal }
									onChange={ ( val ) => setAttributes( { [ titleKey ]: val } ) }
								/>
								<TextControl
									label="Subtitle"
									value={ subVal }
									onChange={ ( val ) => setAttributes( { [ subKey ]: val } ) }
								/>
							</div>
						) ) }
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps( { style: { background: '#fafafa', padding: '40px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>
						Contact Bottom Info
					</p>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '40px' } }>
						<div style={ { background: '#d9d9d9', height: '200px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
							{ photo ? <img src={ photo } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : <span style={ { color: '#888' } }>Team photo</span> }
						</div>
						<div>
							<p style={ { fontSize: '14px', color: '#364153', marginBottom: '16px' } }>{ description }</p>
							{ [ [ benefit1Title, benefit1Subtitle ], [ benefit2Title, benefit2Subtitle ], [ benefit3Title, benefit3Subtitle ], [ benefit4Title, benefit4Subtitle ] ].map( ( [ t, s ], i ) => (
								<div key={ i } style={ { display: 'flex', gap: '12px', marginBottom: '12px' } }>
									<div style={ { width: '28px', height: '28px', background: '#ff5c00', borderRadius: '50%', flexShrink: 0 } }></div>
									<div><strong style={ { fontSize: '14px' } }>{ t }</strong><br /><span style={ { fontSize: '13px', color: '#4a5565' } }>{ s }</span></div>
								</div>
							) ) }
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
