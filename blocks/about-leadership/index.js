import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, subtitle, leaderName, leaderRole, leaderQualifications, bioP1, bioP2, photo } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Header" initialOpen={ true }>
						<TextControl
							label="Section heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextareaControl
							label="Section subtitle"
							value={ subtitle }
							onChange={ ( val ) => setAttributes( { subtitle: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					<PanelBody title="Leader Details" initialOpen={ true }>
						<TextControl
							label="Name"
							value={ leaderName }
							onChange={ ( val ) => setAttributes( { leaderName: val } ) }
						/>
						<TextControl
							label="Role / title (orange)"
							value={ leaderRole }
							onChange={ ( val ) => setAttributes( { leaderRole: val } ) }
						/>
						<TextControl
							label="Qualifications"
							value={ leaderQualifications }
							onChange={ ( val ) => setAttributes( { leaderQualifications: val } ) }
						/>
						<TextControl
							label="Photo URL (leave blank to use theme option)"
							value={ photo }
							onChange={ ( val ) => setAttributes( { photo: val } ) }
							help="Paste a full image URL or leave blank to use the saved theme option / fallback logo."
						/>
					</PanelBody>
					<PanelBody title="Biography" initialOpen={ false }>
						<TextareaControl
							label="Bio paragraph 1"
							value={ bioP1 }
							onChange={ ( val ) => setAttributes( { bioP1: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Bio paragraph 2"
							value={ bioP2 }
							onChange={ ( val ) => setAttributes( { bioP2: val } ) }
							rows={ 4 }
						/>
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
						About – Leadership
					</p>
					<h2 style={ { margin: '8px 0 4px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<p style={ { color: '#4a5565', fontSize: '13px', margin: '0 0 20px' } }>{ subtitle }</p>
					<div style={ { display: 'flex', gap: '24px', alignItems: 'flex-start' } }>
						<div style={ { width: '120px', height: '160px', background: '#f3f4f6', flexShrink: 0, display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '12px', color: '#9ca3af' } }>
							{ photo ? 'Custom photo set' : 'Photo from theme option' }
						</div>
						<div>
							<h3 style={ { margin: '0 0 4px', fontSize: '20px', fontWeight: 700, color: '#020202' } }>{ leaderName }</h3>
							<p style={ { margin: '0 0 2px', fontSize: '13px', fontWeight: 600, color: '#ff5c00' } }>{ leaderRole }</p>
							<p style={ { margin: '0 0 12px', fontSize: '12px', color: '#364153' } }>{ leaderQualifications }</p>
							<p style={ { margin: '0 0 8px', fontSize: '13px', color: '#4a5565' } }>{ bioP1 }</p>
							<p style={ { margin: 0, fontSize: '13px', color: '#4a5565' } }>{ bioP2 }</p>
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
