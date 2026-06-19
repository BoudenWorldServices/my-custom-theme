import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { image, imageAlt, imagePosition, heading, headingColor, body, callout, buttonText, buttonUrl, background } = attributes;

		const headingColors = { black: '#020202', orange: '#ff5c00', white: '#fff' };
		const bgColors = { white: '#fff', gray: '#f9fafb', dark: '#020202' };

		return (
			<>
				<InspectorControls>
					<PanelBody title="Image" initialOpen={ true }>
						<MediaUploadCheck>
							<MediaUpload onSelect={ ( m ) => setAttributes( { image: m.url, imageAlt: m.alt || '' } ) } allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<>
										{ image && <img src={ image } alt="" style={ { width: '100%', height: '100px', objectFit: 'cover', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">{ image ? 'Change image' : 'Choose image' }</Button>
										{ image && <Button onClick={ () => setAttributes( { image: '' } ) } variant="link" isDestructive style={ { marginLeft: '8px' } }>Remove</Button> }
									</>
								) }
							/>
						</MediaUploadCheck>
						<TextControl label="Alt text" value={ imageAlt } onChange={ ( v ) => setAttributes( { imageAlt: v } ) } />
						<SelectControl label="Image position" value={ imagePosition } options={ [ { label: 'Image left', value: 'left' }, { label: 'Image right', value: 'right' } ] } onChange={ ( v ) => setAttributes( { imagePosition: v } ) } />
					</PanelBody>
					<PanelBody title="Text Content" initialOpen={ true }>
						<TextControl label="Heading" value={ heading } onChange={ ( v ) => setAttributes( { heading: v } ) } />
						<SelectControl label="Heading colour" value={ headingColor } options={ [ { label: 'Black', value: 'black' }, { label: 'Orange', value: 'orange' }, { label: 'White', value: 'white' } ] } onChange={ ( v ) => setAttributes( { headingColor: v } ) } />
						<TextareaControl label="Body text (blank line = new paragraph)" value={ body } rows={ 5 } onChange={ ( v ) => setAttributes( { body: v } ) } />
						<TextControl label="Orange callout text (optional)" value={ callout } onChange={ ( v ) => setAttributes( { callout: v } ) } />
					</PanelBody>
					<PanelBody title="Button (optional)" initialOpen={ false }>
						<TextControl label="Button text" value={ buttonText } onChange={ ( v ) => setAttributes( { buttonText: v } ) } />
						<TextControl label="Button URL" value={ buttonUrl } onChange={ ( v ) => setAttributes( { buttonUrl: v } ) } />
					</PanelBody>
					<PanelBody title="Background" initialOpen={ false }>
						<SelectControl label="Background colour" value={ background } options={ [ { label: 'White', value: 'white' }, { label: 'Light gray', value: 'gray' }, { label: 'Dark / black', value: 'dark' } ] } onChange={ ( v ) => setAttributes( { background: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: bgColors[ background ], padding: '32px', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px', alignItems: 'center' } } ) }>
					<div style={ { order: imagePosition === 'right' ? 2 : 1, background: image ? 'transparent' : '#ddd', minHeight: '200px', display: 'flex', alignItems: 'center', justifyContent: 'center', overflow: 'hidden' } }>
						{ image ? <img src={ image } alt="" style={ { width: '100%', height: '200px', objectFit: 'cover' } } /> : <p style={ { color: '#999', fontSize: '12px' } }>No image selected</p> }
					</div>
					<div style={ { order: imagePosition === 'right' ? 1 : 2 } }>
						<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Image + Text Split</p>
						{ heading && <h2 style={ { fontSize: '22px', fontWeight: 700, color: headingColors[ headingColor ], margin: '0 0 12px' } }>{ heading }</h2> }
						{ body && <p style={ { color: background === 'dark' ? '#ccc' : '#555', fontSize: '14px', margin: '0 0 12px' } }>{ body.substring( 0, 120 ) }{ body.length > 120 ? '…' : '' }</p> }
						{ callout && <p style={ { background: '#ff5c00', color: '#fff', padding: '8px 12px', fontWeight: 700, fontSize: '13px' } }>{ callout }</p> }
						{ buttonText && <div style={ { marginTop: '12px', background: '#020202', color: '#fff', padding: '10px 20px', display: 'inline-block', fontSize: '13px', fontWeight: 700 } }>{ buttonText }</div> }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
