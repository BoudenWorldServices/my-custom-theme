import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { photo, name, role, qualifications, bio, background } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Team Member" initialOpen={ true }>
						<MediaUploadCheck>
							<MediaUpload onSelect={ ( m ) => setAttributes( { photo: m.url } ) } allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<>
										{ photo && <img src={ photo } alt="" style={ { width: '80px', height: '80px', objectFit: 'cover', borderRadius: '50%', marginBottom: '8px' } } /> }
										<Button onClick={ open } variant="secondary">{ photo ? 'Change photo' : 'Choose photo' }</Button>
										{ photo && <Button onClick={ () => setAttributes( { photo: '' } ) } variant="link" isDestructive style={ { marginLeft: '8px' } }>Remove</Button> }
									</>
								) }
							/>
						</MediaUploadCheck>
						<TextControl label="Full name" value={ name } onChange={ ( v ) => setAttributes( { name: v } ) } />
						<TextControl label="Job title / role" value={ role } onChange={ ( v ) => setAttributes( { role: v } ) } />
						<TextControl label="Qualifications (optional)" value={ qualifications } onChange={ ( v ) => setAttributes( { qualifications: v } ) } />
						<TextareaControl label="Biography" value={ bio } rows={ 5 } onChange={ ( v ) => setAttributes( { bio: v } ) } />
						<SelectControl label="Card background" value={ background } options={ [ { label: 'White', value: 'white' }, { label: 'Light gray', value: 'gray' } ] } onChange={ ( v ) => setAttributes( { background: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: background === 'gray' ? '#f9fafb' : '#fff', padding: '24px', borderTop: '3px solid #ff5c00', maxWidth: '360px' } } ) }>
					<div style={ { display: 'flex', gap: '16px', alignItems: 'center', marginBottom: '12px' } }>
						{ photo ? <img src={ photo } alt="" style={ { width: '64px', height: '64px', objectFit: 'cover', borderRadius: '50%' } } /> : <div style={ { width: '64px', height: '64px', background: '#e5e7eb', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '24px' } }>👤</div> }
						<div>
							<p style={ { fontWeight: 700, fontSize: '16px', margin: '0 0 2px' } }>{ name || 'Team Member Name' }</p>
							<p style={ { fontSize: '13px', color: '#ff5c00', margin: 0 } }>{ role || 'Role' }</p>
							{ qualifications && <p style={ { fontSize: '11px', color: '#888', margin: '2px 0 0' } }>{ qualifications }</p> }
						</div>
					</div>
					{ bio && <p style={ { fontSize: '13px', color: '#555', margin: 0 } }>{ bio.substring( 0, 100 ) }{ bio.length > 100 ? '…' : '' }</p> }
				</div>
			</>
		);
	},
	save() { return null; },
} );
