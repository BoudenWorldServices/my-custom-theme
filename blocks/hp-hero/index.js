import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUploadCheck, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			companyName, heading, tagline1, tagline2,
			ctaText, ctaUrl, secondaryCtaText, secondaryCtaUrl,
			stat1Label, stat1Value, stat2Label, stat2Value, stat3Label, stat3Value,
			video1, video2, video3,
			slide1, slide2, slide3,
			slide1Alt, slide2Alt, slide3Alt,
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
					<PanelBody title="Hero Content" initialOpen={ true }>
						<TextControl
							label="Company name (small label above H1)"
							value={ companyName }
							onChange={ ( val ) => setAttributes( { companyName: val } ) }
						/>
						<TextControl
							label="H1 Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextControl
							label="Tagline 1"
							value={ tagline1 }
							onChange={ ( val ) => setAttributes( { tagline1: val } ) }
						/>
						<TextControl
							label="Tagline 2 (bold)"
							value={ tagline2 }
							onChange={ ( val ) => setAttributes( { tagline2: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Stat Pills" initialOpen={ false }>
						<TextControl
							label="Stat 1 Label"
							value={ stat1Label }
							onChange={ ( val ) => setAttributes( { stat1Label: val } ) }
						/>
						<TextControl
							label="Stat 1 Value"
							value={ stat1Value }
							onChange={ ( val ) => setAttributes( { stat1Value: val } ) }
						/>
						<TextControl
							label="Stat 2 Label"
							value={ stat2Label }
							onChange={ ( val ) => setAttributes( { stat2Label: val } ) }
						/>
						<TextControl
							label="Stat 2 Value"
							value={ stat2Value }
							onChange={ ( val ) => setAttributes( { stat2Value: val } ) }
						/>
						<TextControl
							label="Stat 3 Label"
							value={ stat3Label }
							onChange={ ( val ) => setAttributes( { stat3Label: val } ) }
						/>
						<TextControl
							label="Stat 3 Value"
							value={ stat3Value }
							onChange={ ( val ) => setAttributes( { stat3Value: val } ) }
						/>
					</PanelBody>
					<PanelBody title="CTA Buttons" initialOpen={ false }>
						<TextControl
							label="Primary CTA text"
							value={ ctaText }
							onChange={ ( val ) => setAttributes( { ctaText: val } ) }
						/>
						<TextControl
							label="Primary CTA URL"
							value={ ctaUrl }
							onChange={ ( val ) => setAttributes( { ctaUrl: val } ) }
						/>
						<TextControl
							label="Secondary CTA text"
							value={ secondaryCtaText }
							onChange={ ( val ) => setAttributes( { secondaryCtaText: val } ) }
						/>
						<TextControl
							label="Secondary CTA URL"
							value={ secondaryCtaUrl }
							onChange={ ( val ) => setAttributes( { secondaryCtaUrl: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Carousel Videos" initialOpen={ false }>
						<TextControl
							label="Video 1 URL"
							value={ video1 }
							onChange={ ( val ) => setAttributes( { video1: val } ) }
						/>
						<TextControl
							label="Video 2 URL"
							value={ video2 }
							onChange={ ( val ) => setAttributes( { video2: val } ) }
						/>
						<TextControl
							label="Video 3 URL"
							value={ video3 }
							onChange={ ( val ) => setAttributes( { video3: val } ) }
						/>
					</PanelBody>
					{ mediaControl( 'slide1', 'Carousel Image 1', slide1 ) }
					<PanelBody title="Carousel Image 1 – Alt Text" initialOpen={ false }>
						<TextControl
							label="Alt text"
							value={ slide1Alt }
							onChange={ ( val ) => setAttributes( { slide1Alt: val } ) }
						/>
					</PanelBody>
					{ mediaControl( 'slide2', 'Carousel Image 2', slide2 ) }
					<PanelBody title="Carousel Image 2 – Alt Text" initialOpen={ false }>
						<TextControl
							label="Alt text"
							value={ slide2Alt }
							onChange={ ( val ) => setAttributes( { slide2Alt: val } ) }
						/>
					</PanelBody>
					{ mediaControl( 'slide3', 'Carousel Image 3', slide3 ) }
					<PanelBody title="Carousel Image 3 – Alt Text" initialOpen={ false }>
						<TextControl
							label="Alt text"
							value={ slide3Alt }
							onChange={ ( val ) => setAttributes( { slide3Alt: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#ff5c00',
							padding: '48px 32px',
							minHeight: '320px',
							display: 'flex',
							flexDirection: 'column',
							justifyContent: 'flex-end',
							gap: '16px',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: '#020202', fontWeight: 600, textTransform: 'uppercase', letterSpacing: '1px', margin: 0 } }>
						{ companyName }
					</p>
					<h1 style={ { fontSize: '36px', fontWeight: 700, color: '#fff', margin: 0, lineHeight: 1.2 } }>
						{ heading }
					</h1>
					<p style={ { fontSize: '14px', color: '#020202', margin: 0 } }>{ tagline1 }</p>
					<p style={ { fontSize: '14px', fontWeight: 700, color: '#020202', margin: 0 } }>{ tagline2 }</p>
					<div style={ { display: 'inline-flex', background: '#020202', color: '#fff', padding: '14px 20px', fontSize: '12px', fontWeight: 700, letterSpacing: '0.35px', textTransform: 'uppercase', alignItems: 'center', gap: '8px', width: 'fit-content' } }>
						{ ctaText } →
					</div>
					{ slide1 && (
						<p style={ { fontSize: '11px', color: '#020202', margin: 0 } }>
							Slide 1: <em>{ slide1.split('/').pop() }</em>
						</p>
					) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
