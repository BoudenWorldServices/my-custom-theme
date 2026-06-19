import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, credentials } = attributes;

		const updateCredential = ( index, field, value ) => {
			const updated = [ ...credentials ];
			updated[ index ] = { ...updated[ index ], [ field ]: value };
			setAttributes( { credentials: updated } );
		};

		const addCredential = () => {
			setAttributes( { credentials: [ ...credentials, { title: '', desc: '' } ] } );
		};

		const removeCredential = ( index ) => {
			setAttributes( { credentials: credentials.filter( ( _, i ) => i !== index ) } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Credentials Section" initialOpen={ true }>
						<TextControl
							label="Section heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
					</PanelBody>
					{ credentials.map( ( cred, i ) => (
						<PanelBody key={ i } title={ cred.title || `Credential ${ i + 1 }` } initialOpen={ false }>
							<TextControl
								label="Title"
								value={ cred.title }
								onChange={ ( val ) => updateCredential( i, 'title', val ) }
							/>
							<TextareaControl
								label="Description"
								value={ cred.desc }
								onChange={ ( val ) => updateCredential( i, 'desc', val ) }
								rows={ 3 }
							/>
							<Button variant="link" isDestructive onClick={ () => removeCredential( i ) }>
								Remove credential
							</Button>
						</PanelBody>
					) ) }
					<PanelBody title="Add Credential" initialOpen={ true }>
						<Button variant="secondary" onClick={ addCredential }>
							+ Add credential
						</Button>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#020202',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						About – Credentials
					</p>
					<h2 style={ { margin: '8px 0 20px', fontSize: '24px', fontWeight: 700, color: '#fff', textAlign: 'center' } }>
						{ heading }
					</h2>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '16px' } }>
						{ credentials.map( ( cred, i ) => (
							<div key={ i } style={ { borderLeft: '2px solid #ff5c00', paddingLeft: '16px' } }>
								<strong style={ { display: 'block', color: '#fff', fontSize: '14px', marginBottom: '6px' } }>{ cred.title }</strong>
								<p style={ { color: 'rgba(255,255,255,0.7)', fontSize: '12px', margin: 0 } }>{ cred.desc }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
