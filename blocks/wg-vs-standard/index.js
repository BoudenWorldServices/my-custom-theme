import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, tradH3, tradP, tradBold, golH3, golP, golBold, img1, img1Alt, img2, img2Alt, img3, img3Alt } = attributes;

		const renderImageControl = ( label, imgAttr, altAttr, imgVal, altVal ) => (
			<div style={ { marginBottom: '16px' } }>
				<p style={ { fontWeight: 600, marginBottom: '4px' } }>{ label }</p>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={ ( media ) => setAttributes( { [ imgAttr ]: media.url, [ altAttr ]: media.alt || altVal } ) }
						allowedTypes={ [ 'image' ] }
						value={ imgVal }
						render={ ( { open } ) => (
							<div>
								{ imgVal && (
									<img
										src={ imgVal }
										alt={ altVal }
										style={ { maxWidth: '100%', height: 'auto', marginBottom: '8px', borderRadius: '4px' } }
									/>
								) }
								<Button variant="secondary" onClick={ open } style={ { marginRight: '8px' } }>
									{ imgVal ? 'Replace image' : 'Select image' }
								</Button>
								{ imgVal && (
									<Button variant="link" isDestructive onClick={ () => setAttributes( { [ imgAttr ]: '' } ) }>
										Remove
									</Button>
								) }
							</div>
						) }
					/>
				</MediaUploadCheck>
				<TextControl
					label="Alt text"
					value={ altVal }
					onChange={ ( val ) => setAttributes( { [ altAttr ]: val } ) }
				/>
			</div>
		);

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Heading" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Traditional Repair (left column)" initialOpen={ true }>
						<TextControl
							label="Column heading"
							value={ tradH3 }
							onChange={ ( val ) => setAttributes( { tradH3: val } ) }
						/>
						<TextareaControl
							label="Body paragraph"
							value={ tradP }
							onChange={ ( val ) => setAttributes( { tradP: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Bold closing line"
							value={ tradBold }
							onChange={ ( val ) => setAttributes( { tradBold: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Goliath Method (right column)" initialOpen={ true }>
						<TextControl
							label="Column heading"
							value={ golH3 }
							onChange={ ( val ) => setAttributes( { golH3: val } ) }
						/>
						<TextareaControl
							label="Body paragraph"
							value={ golP }
							onChange={ ( val ) => setAttributes( { golP: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Bold closing line"
							value={ golBold }
							onChange={ ( val ) => setAttributes( { golBold: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Images" initialOpen={ false }>
						{ renderImageControl( 'Image 1', 'img1', 'img1Alt', img1, img1Alt ) }
						{ renderImageControl( 'Image 2', 'img2', 'img2Alt', img2, img2Alt ) }
						{ renderImageControl( 'Image 3', 'img3', 'img3Alt', img3, img3Alt ) }
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						Why Goliath vs Standard Repair
					</p>
					<h2 style={ { margin: '8px 0 4px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<div style={ { display: 'flex', gap: '8px', marginTop: '12px' } }>
						<div style={ { flex: 1, background: '#f9fafb', padding: '16px', borderRadius: '2px' } }>
							<strong style={ { display: 'block', marginBottom: '6px', color: '#364153' } }>{ tradH3 }</strong>
							<p style={ { fontSize: '13px', color: '#364153', margin: 0 } }>{ tradP }</p>
						</div>
						<div style={ { flex: 1, background: '#ff5c00', padding: '16px', borderRadius: '2px' } }>
							<strong style={ { display: 'block', marginBottom: '6px', color: '#fff' } }>{ golH3 }</strong>
							<p style={ { fontSize: '13px', color: '#fff', margin: 0 } }>{ golP }</p>
						</div>
					</div>
					{ ( img1 || img2 || img3 ) && (
						<div style={ { display: 'flex', gap: '8px', marginTop: '12px' } }>
							{ [ img1, img2, img3 ].map( ( src, i ) => (
								<div key={ i } style={ { flex: 1, height: '120px', background: '#e5e7eb', overflow: 'hidden', borderRadius: '2px' } }>
									{ src ? <img src={ src } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : <span style={ { display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', fontSize: '11px', color: '#888' } }>No image</span> }
								</div>
							) ) }
						</div>
					) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
