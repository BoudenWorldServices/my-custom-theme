import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { image1, image1Alt, image2, image2Alt, image3, image3Alt, columns, height, caption } = attributes;
		const heights = { short: '140px', medium: '200px', tall: '280px' };
		const images = [
			{ url: image1, alt: image1Alt, key: 1 },
			{ url: image2, alt: image2Alt, key: 2 },
			{ url: image3, alt: image3Alt, key: 3 },
		].slice( 0, parseInt( columns ) );

		return (
			<>
				<InspectorControls>
					<PanelBody title="Gallery Settings" initialOpen={ true }>
						<SelectControl label="Number of columns" value={ columns } options={ [ { label: '2 images', value: '2' }, { label: '3 images', value: '3' } ] } onChange={ ( v ) => setAttributes( { columns: v } ) } />
						<SelectControl label="Image height" value={ height } options={ [ { label: 'Short', value: 'short' }, { label: 'Medium', value: 'medium' }, { label: 'Tall', value: 'tall' } ] } onChange={ ( v ) => setAttributes( { height: v } ) } />
						<TextControl label="Caption (optional)" value={ caption } onChange={ ( v ) => setAttributes( { caption: v } ) } />
					</PanelBody>
					{ [ 1, 2, 3 ].map( ( n ) => (
						<PanelBody key={ n } title={ `Image ${ n }${ n > parseInt( columns ) ? ' (not shown)' : '' }` } initialOpen={ n <= parseInt( columns ) }>
							<MediaUploadCheck>
								<MediaUpload onSelect={ ( m ) => setAttributes( { [ `image${ n }` ]: m.url, [ `image${ n }Alt` ]: m.alt || '' } ) } allowedTypes={ [ 'image' ] }
									render={ ( { open } ) => (
										<>
											{ attributes[ `image${ n }` ] && <img src={ attributes[ `image${ n }` ] } alt="" style={ { width: '100%', height: '70px', objectFit: 'cover', marginBottom: '6px' } } /> }
											<Button onClick={ open } variant="secondary">{ attributes[ `image${ n }` ] ? 'Change' : 'Choose' } image { n }</Button>
											{ attributes[ `image${ n }` ] && <Button onClick={ () => setAttributes( { [ `image${ n }` ]: '' } ) } variant="link" isDestructive style={ { marginLeft: '6px' } }>Remove</Button> }
										</>
									) }
								/>
							</MediaUploadCheck>
							<TextControl label="Alt text" value={ attributes[ `image${ n }Alt` ] } onChange={ ( v ) => setAttributes( { [ `image${ n }Alt` ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { padding: '16px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>Media Gallery ({ columns } columns)</p>
					<div style={ { display: 'grid', gridTemplateColumns: `repeat(${ columns }, 1fr)`, gap: '8px' } }>
						{ images.map( ( img ) => (
							<div key={ img.key } style={ { background: img.url ? 'transparent' : '#e5e7eb', height: heights[ height ], overflow: 'hidden', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
								{ img.url ? <img src={ img.url } alt="" style={ { width: '100%', height: '100%', objectFit: 'cover' } } /> : <span style={ { color: '#9ca3af', fontSize: '12px' } }>Image { img.key }</span> }
							</div>
						) ) }
					</div>
					{ caption && <p style={ { textAlign: 'center', fontSize: '12px', color: '#777', marginTop: '8px' } }>{ caption }</p> }
				</div>
			</>
		);
	},
	save() { return null; },
} );
