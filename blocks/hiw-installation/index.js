import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			heading, videoText, videoFile, videoUrl, posterUrl, videoPageUrl,
			step1Title, step1Desc,
			step2Title, step2Desc,
			step3Title, step3Desc,
			step4Title, step4Desc,
			step5Title, step5Desc,
		} = attributes;

		const steps = [
			{ title: step1Title, desc: step1Desc, tKey: 'step1Title', dKey: 'step1Desc', n: 1 },
			{ title: step2Title, desc: step2Desc, tKey: 'step2Title', dKey: 'step2Desc', n: 2 },
			{ title: step3Title, desc: step3Desc, tKey: 'step3Title', dKey: 'step3Desc', n: 3 },
			{ title: step4Title, desc: step4Desc, tKey: 'step4Title', dKey: 'step4Desc', n: 4 },
			{ title: step5Title, desc: step5Desc, tKey: 'step5Title', dKey: 'step5Desc', n: 5 },
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<TextControl label="Video link text" value={ videoText } onChange={ ( v ) => setAttributes( { videoText: v } ) } />
						<TextControl label="Video page URL" value={ videoPageUrl } onChange={ ( v ) => setAttributes( { videoPageUrl: v } ) } help="Leave empty for auto /videos/{filename}/" />
					</PanelBody>
					<PanelBody title="Video" initialOpen={ false }>
						<TextControl label="Video filename (in theme assets)" value={ videoFile } onChange={ ( v ) => setAttributes( { videoFile: v } ) } />
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
									<div>
										{ posterUrl && <img src={ posterUrl } alt="" style={ { maxWidth: '100%', marginBottom: '4px' } } /> }
										<Button variant="secondary" onClick={ open }>{ posterUrl ? 'Replace poster' : 'Upload poster' }</Button>
										{ posterUrl && <Button variant="link" isDestructive onClick={ () => setAttributes( { posterUrl: '' } ) } style={ { marginLeft: '8px' } }>Remove</Button> }
									</div>
								) }
							/>
						</MediaUploadCheck>
					</PanelBody>
					{ steps.map( ( s ) => (
						<PanelBody key={ s.n } title={ `Step ${ s.n }` } initialOpen={ false }>
							<TextControl label="Title" value={ s.title } onChange={ ( v ) => setAttributes( { [ s.tKey ]: v } ) } />
							<TextareaControl label="Description" value={ s.desc } rows={ 4 } onChange={ ( v ) => setAttributes( { [ s.dKey ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>HIW Installation Process</p>
					<p style={ { fontSize: '20px', fontWeight: 700, color: '#020202', margin: '0 0 16px' } }>{ heading }</p>
					<div style={ { display: 'flex', gap: '32px', flexWrap: 'wrap' } }>
						<div style={ { flex: 1, minWidth: '200px', background: '#111', height: '200px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
							<span style={ { color: '#888', fontSize: '13px' } }>📹 Video player</span>
						</div>
						<div style={ { flex: 1, minWidth: '200px' } }>
							{ steps.map( ( s ) => (
								<div key={ s.n } style={ { display: 'flex', gap: '10px', borderTop: '1px solid #f0e8ff', paddingTop: '10px', marginBottom: '12px' } }>
									<div style={ { background: '#ff5c00', color: '#fff', width: '32px', height: '32px', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, flexShrink: 0 } }>{ s.n }</div>
									<div>
										<p style={ { fontWeight: 700, fontSize: '13px', margin: '0 0 2px' } }>{ s.title }</p>
										<p style={ { fontSize: '11px', color: '#555', margin: 0 } }>{ s.desc.substring( 0, 80 ) }{ s.desc.length > 80 ? '…' : '' }</p>
									</div>
								</div>
							) ) }
						</div>
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
