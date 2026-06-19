import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, subtitle, members } = attributes;

		function updateMember( index, field, value ) {
			const updated = members.map( ( m, i ) =>
				i === index ? { ...m, [ field ]: value } : m
			);
			setAttributes( { members: updated } );
		}

	function addMember() {
		setAttributes( {
			members: [ ...members, { name: '', role: '', photo: '', qualifications: '', bio: '' } ],
		} );
	}

		function removeMember( index ) {
			setAttributes( {
				members: members.filter( ( _, i ) => i !== index ),
			} );
		}

		return (
			<>
				<InspectorControls>
					<PanelBody title="Team Section" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Subtitle"
							value={ subtitle }
							onChange={ ( val ) => setAttributes( { subtitle: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Team Members" initialOpen={ true }>
						{ members.length === 0 && (
							<p style={ { fontSize: '12px', color: '#6b7280', fontStyle: 'italic' } }>
								No members added. The block will fall back to the saved theme option data.
							</p>
						) }
						{ members.map( ( member, index ) => (
							<div key={ index } style={ { marginBottom: '16px', padding: '12px', background: '#f9fafb', borderRadius: '4px' } }>
								<p style={ { margin: '0 0 8px', fontWeight: 600, fontSize: '13px' } }>
									Member { index + 1 }
								</p>
								<TextControl
									label="Name"
									value={ member.name || '' }
									onChange={ ( val ) => updateMember( index, 'name', val ) }
								/>
								<TextControl
									label="Role"
									value={ member.role || '' }
									onChange={ ( val ) => updateMember( index, 'role', val ) }
								/>
							<TextControl
								label="Photo URL (or leave blank for placeholder)"
								value={ member.photo || '' }
								onChange={ ( val ) => updateMember( index, 'photo', val ) }
							/>
							<TextControl
								label="Qualifications"
								value={ member.qualifications || '' }
								onChange={ ( val ) => updateMember( index, 'qualifications', val ) }
							/>
							<TextareaControl
								label="Bio"
								value={ member.bio || '' }
								onChange={ ( val ) => updateMember( index, 'bio', val ) }
								rows={ 3 }
							/>
							<Button
									isDestructive
									variant="secondary"
									onClick={ () => removeMember( index ) }
									style={ { marginTop: '4px' } }
								>
									Remove member
								</Button>
							</div>
						) ) }
						<Button
							variant="secondary"
							onClick={ addMember }
							style={ { marginTop: '8px' } }
						>
							Add team member
						</Button>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#f9fafb',
							padding: '40px 32px',
							borderLeft: '4px solid #ff5c00',
						},
					} ) }
				>
					<p style={ { margin: 0, fontWeight: 700, fontSize: '13px', color: '#ff5c00', textTransform: 'uppercase', letterSpacing: '1px' } }>
						About – Our Team
					</p>
					<h2 style={ { margin: '8px 0 4px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#4a5565', fontSize: '13px', margin: '0 0 20px' } }>{ subtitle }</p>
					{ members.length === 0 ? (
						<p style={ { fontSize: '13px', color: '#6b7280', fontStyle: 'italic' } }>
							No members configured — front end will use saved theme option data.
						</p>
					) : (
						<div style={ { display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: '12px' } }>
							{ members.map( ( member, index ) => (
								<div key={ index } style={ { background: '#fff', padding: '16px', borderRadius: '2px' } }>
									<div style={ { width: '100%', aspectRatio: '1', background: '#f3f4f6', marginBottom: '8px', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '11px', color: '#9ca3af' } }>
										{ member.photo ? '📷 Photo set' : 'No photo' }
									</div>
									<strong style={ { display: 'block', fontSize: '14px', color: '#020202' } }>{ member.name || 'Team Member' }</strong>
									<p style={ { margin: '2px 0 0', fontSize: '12px', color: '#ff5c00', fontWeight: 600 } }>{ member.role }</p>
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
