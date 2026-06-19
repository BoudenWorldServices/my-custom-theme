import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, body, iconUrl, background, headingColor } = attributes;

		const bgColors = { light: '#f9fafb', dark: '#020202', white: '#fff' };
		const headingColors = { black: '#020202', orange: '#ff5c00' };

		return (
			<>
				<InspectorControls>
					<PanelBody title="Card Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Body text"
							value={ body }
							onChange={ ( val ) => setAttributes( { body: val } ) }
							rows={ 3 }
						/>
						<SelectControl
							label="Heading colour"
							value={ headingColor }
							options={ [
								{ label: 'Black', value: 'black' },
								{ label: 'Orange', value: 'orange' },
							] }
							onChange={ ( val ) => setAttributes( { headingColor: val } ) }
						/>
						<SelectControl
							label="Background"
							value={ background }
							options={ [
								{ label: 'Light grey', value: 'light' },
								{ label: 'Dark / black', value: 'dark' },
								{ label: 'White', value: 'white' },
							] }
							onChange={ ( val ) => setAttributes( { background: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Icon" initialOpen={ false }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { iconUrl: media.url } ) }
								allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<>
										{ iconUrl && (
											<img src={ iconUrl } alt="" style={ { width: '48px', height: '48px', objectFit: 'contain', marginBottom: '8px' } } />
										) }
										<Button onClick={ open } variant="secondary">
											{ iconUrl ? 'Change icon' : 'Choose icon' }
										</Button>
										{ iconUrl && (
											<Button onClick={ () => setAttributes( { iconUrl: '' } ) } variant="link" isDestructive style={ { marginLeft: '8px' } }>
												Remove
											</Button>
										) }
									</>
								) }
							/>
						</MediaUploadCheck>
						<p style={ { fontSize: '12px', color: '#666', marginTop: '8px' } }>SVG icons are in: theme assets/images/icons/</p>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: bgColors[ background ],
							padding: '24px',
							border: background === 'white' ? '1px solid #eee' : 'none',
						},
					} ) }
				>
					{ iconUrl && (
						<img src={ iconUrl } alt="" style={ { width: '40px', height: '40px', objectFit: 'contain', marginBottom: '12px' } } />
					) }
					{ heading && (
						<h4 style={ { fontWeight: 700, color: headingColors[ headingColor ], margin: '0 0 8px', fontSize: '15px' } }>
							{ heading }
						</h4>
					) }
					{ body && (
						<p style={ { color: background === 'dark' ? 'rgba(255,255,255,0.8)' : '#555', fontSize: '14px', margin: 0 } }>
							{ body }
						</p>
					) }
					{ ! heading && ! body && (
						<p style={ { color: '#aaa', fontSize: '13px', fontStyle: 'italic' } }>Content card — fill in heading and body in the sidebar</p>
					) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
