import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { img1, img1Alt, img2, img2Alt, img3, img3Alt } = attributes;

		const ImagePanel = ( { label, imgAttr, altAttr, imgVal, altVal } ) => (
			<PanelBody title={ label } initialOpen={ false }>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={ ( media ) => setAttributes( { [imgAttr]: media.url } ) }
						allowedTypes={ [ 'image' ] }
						render={ ( { open } ) => (
							<div>
								{ imgVal && <img src={ imgVal } alt="" style={ { maxWidth: '100%', marginBottom: '8px' } } /> }
								<Button variant="secondary" onClick={ open }>
									{ imgVal ? 'Replace image' : 'Select image' }
								</Button>
								{ imgVal && (
									<Button variant="link" isDestructive onClick={ () => setAttributes( { [imgAttr]: '' } ) } style={ { marginLeft: '8px' } }>
										Remove
									</Button>
								) }
							</div>
						) }
					/>
				</MediaUploadCheck>
				<TextControl label="Alt text" value={ altVal } onChange={ ( v ) => setAttributes( { [altAttr]: v } ) } />
			</PanelBody>
		);

		return (
			<>
				<InspectorControls>
					<ImagePanel label="Image 1" imgAttr="img1" altAttr="img1Alt" imgVal={ img1 } altVal={ img1Alt } />
					<ImagePanel label="Image 2" imgAttr="img2" altAttr="img2Alt" imgVal={ img2 } altVal={ img2Alt } />
					<ImagePanel label="Image 3" imgAttr="img3" altAttr="img3Alt" imgVal={ img3 } altVal={ img3Alt } />
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>HIW Image Gallery</p>
					<div style={ { display: 'flex', gap: '16px' } }>
						{ [ img1, img2, img3 ].map( ( src, i ) => (
							<div key={ i } style={ { flex: i === 1 ? '0 0 280px' : 1, height: '120px', background: '#e0e0e0', overflow: 'hidden' } }>
								{ src ? <img src={ src } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : <span style={ { display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', fontSize: '12px', color: '#888' } }>No image</span> }
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
