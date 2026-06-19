import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			eyebrow, heading, img1, img2, img3,
			subheading, bodyIntro, bodyInstalled,
			leftH3, leftP,
			rightH3, rightP, rightTransition,
			bullet1, bullet2, bullet3, bullet4,
			rightOutro,
		} = attributes;

		const mediaControl = ( key, label, value ) => (
			<PanelBody title={ label } initialOpen={ false }>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={ ( media ) => setAttributes( { [ key ]: media.url } ) }
						allowedTypes={ [ 'image' ] }
						value={ value }
						render={ ( { open } ) => (
							<>
								{ value && <img src={ value } alt="" style={ { width: '100%', marginBottom: '8px' } } /> }
								<Button onClick={ open } variant="secondary">
									{ value ? 'Change Image' : 'Choose Image' }
								</Button>
								{ value && (
									<Button
										onClick={ () => setAttributes( { [ key ]: '' } ) }
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
		);

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
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
					</PanelBody>

					{ mediaControl( 'img1', 'Image 1', img1 ) }
					{ mediaControl( 'img2', 'Image 2', img2 ) }
					{ mediaControl( 'img3', 'Image 3 (wide)', img3 ) }

					<PanelBody title="Left Column" initialOpen={ false }>
						<TextControl
							label="Subheading (orange)"
							value={ subheading }
							onChange={ ( val ) => setAttributes( { subheading: val } ) }
						/>
						<TextareaControl
							label="Intro paragraph"
							value={ bodyIntro }
							onChange={ ( val ) => setAttributes( { bodyIntro: val } ) }
						/>
						<TextControl
							label="Installed line"
							value={ bodyInstalled }
							onChange={ ( val ) => setAttributes( { bodyInstalled: val } ) }
						/>
						<TextControl
							label="Left H3 heading"
							value={ leftH3 }
							onChange={ ( val ) => setAttributes( { leftH3: val } ) }
						/>
						<TextareaControl
							label="Left paragraph"
							value={ leftP }
							onChange={ ( val ) => setAttributes( { leftP: val } ) }
						/>
					</PanelBody>

					<PanelBody title="Right Column" initialOpen={ false }>
						<TextControl
							label="Right H3 heading"
							value={ rightH3 }
							onChange={ ( val ) => setAttributes( { rightH3: val } ) }
						/>
						<TextareaControl
							label="Right paragraph"
							value={ rightP }
							onChange={ ( val ) => setAttributes( { rightP: val } ) }
						/>
						<TextControl
							label="Transition line"
							value={ rightTransition }
							onChange={ ( val ) => setAttributes( { rightTransition: val } ) }
						/>
						<TextControl
							label="Bullet 1"
							value={ bullet1 }
							onChange={ ( val ) => setAttributes( { bullet1: val } ) }
						/>
						<TextControl
							label="Bullet 2"
							value={ bullet2 }
							onChange={ ( val ) => setAttributes( { bullet2: val } ) }
						/>
						<TextControl
							label="Bullet 3"
							value={ bullet3 }
							onChange={ ( val ) => setAttributes( { bullet3: val } ) }
						/>
						<TextControl
							label="Bullet 4"
							value={ bullet4 }
							onChange={ ( val ) => setAttributes( { bullet4: val } ) }
						/>
						<TextareaControl
							label="Outro paragraph"
							value={ rightOutro }
							onChange={ ( val ) => setAttributes( { rightOutro: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#f9fafb',
							padding: '40px 32px',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: '#020202', fontWeight: 600, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 4px' } }>
						{ eyebrow }
					</p>
					<h2 style={ { fontSize: '30px', fontWeight: 700, color: '#12192d', margin: '0 0 16px' } }>{ heading }</h2>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr 2fr', gap: '16px' } }>
						{ [ img1, img2, img3 ].map( ( src, i ) => (
							<div key={ i } style={ { height: '200px', background: '#e5e7eb', overflow: 'hidden' } }>
								{ src
									? <img src={ src } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } />
									: <span style={ { display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#9ca3af', fontSize: '13px' } }>Image { i + 1 }</span>
								}
							</div>
						) ) }
					</div>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px', marginTop: '20px' } }>
						<div>
							<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '14px', textTransform: 'uppercase', margin: '0 0 4px' } }>{ subheading }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 4px' } }>{ bodyIntro }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 12px' } }>{ bodyInstalled }</p>
							<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '14px', textTransform: 'uppercase', margin: '0 0 4px' } }>{ leftH3 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: 0 } }>{ leftP }</p>
						</div>
						<div>
							<p style={ { color: '#ff5c00', fontWeight: 700, fontSize: '14px', textTransform: 'uppercase', margin: '0 0 4px' } }>{ rightH3 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 4px' } }>{ rightP }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 4px' } }>{ rightTransition }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 2px' } }>{ bullet1 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 2px' } }>{ bullet2 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 2px' } }>{ bullet3 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: '0 0 8px' } }>{ bullet4 }</p>
							<p style={ { fontSize: '13px', color: '#020202', margin: 0 } }>{ rightOutro }</p>
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
