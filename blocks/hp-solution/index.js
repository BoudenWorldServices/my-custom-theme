import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { eyebrow, badge, heading, intro, promiseTitle, promiseQuote, mainImage, features } = attributes;

		const updateFeature = ( index, key, value ) => {
			const updated = features.map( ( item, i ) =>
				i === index ? { ...item, [key]: value } : item
			);
			setAttributes( { features: updated } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Labels" initialOpen={ true }>
						<TextControl
							label="Eyebrow text"
							value={ eyebrow }
							onChange={ ( val ) => setAttributes( { eyebrow: val } ) }
						/>
						<TextControl
							label="Badge label (orange pill)"
							value={ badge }
							onChange={ ( val ) => setAttributes( { badge: val } ) }
						/>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Intro paragraph"
							value={ intro }
							onChange={ ( val ) => setAttributes( { intro: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
					{ features.map( ( feature, index ) => (
						<PanelBody key={ index } title={ `Feature ${ index + 1 }` } initialOpen={ false }>
							<TextControl
								label="Title"
								value={ feature.title }
								onChange={ ( val ) => updateFeature( index, 'title', val ) }
							/>
							<TextareaControl
								label="Description"
								value={ feature.desc }
								onChange={ ( val ) => updateFeature( index, 'desc', val ) }
								rows={ 4 }
							/>
						</PanelBody>
					) ) }
					<PanelBody title="Promise Card" initialOpen={ false }>
						<TextControl
							label="Promise title"
							value={ promiseTitle }
							onChange={ ( val ) => setAttributes( { promiseTitle: val } ) }
						/>
						<TextareaControl
							label="Promise quote"
							value={ promiseQuote }
							onChange={ ( val ) => setAttributes( { promiseQuote: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
					<PanelBody title="Main Image" initialOpen={ false }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { mainImage: media.url } ) }
								allowedTypes={ [ 'image' ] }
								value={ mainImage }
								render={ ( { open } ) => (
									<>
										{ mainImage && <img src={ mainImage } alt="" style={ { width: '100%', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">
											{ mainImage ? 'Change Image' : 'Choose Image' }
										</Button>
										{ mainImage && (
											<Button
												onClick={ () => setAttributes( { mainImage: '' } ) }
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
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '48px 32px',
							display: 'grid',
							gridTemplateColumns: '1fr 1fr',
							gap: '32px',
							alignItems: 'center',
						},
					} ) }
				>
					<div style={ { height: '400px', background: '#e5e7eb', overflow: 'hidden' } }>
						{ mainImage
							? <img src={ mainImage } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } />
							: <span style={ { display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#9ca3af', fontSize: '14px' } }>Main Image</span>
						}
					</div>
					<div>
						<div style={ { display: 'flex', alignItems: 'center', gap: '12px', marginBottom: '8px' } }>
							<p style={ { fontSize: '16px', fontWeight: 500, textTransform: 'uppercase', margin: 0 } }>{ eyebrow }</p>
							<span style={ { background: '#ff5c00', color: '#fff', padding: '4px 10px', borderRadius: '6px', fontSize: '12px' } }>{ badge }</span>
						</div>
						<h2 style={ { fontSize: '30px', fontWeight: 700, color: '#020202', margin: '0 0 12px' } }>{ heading }</h2>
						<p style={ { fontSize: '14px', color: '#020202', margin: '0 0 20px' } }>{ intro }</p>
						<div style={ { background: '#ff5c00', padding: '24px', color: '#fff', maxWidth: '380px' } }>
							<p style={ { fontSize: '22px', fontWeight: 700, margin: '0 0 8px' } }>{ promiseTitle }</p>
							<p style={ { fontSize: '14px', margin: 0 } }>{ promiseQuote }</p>
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
