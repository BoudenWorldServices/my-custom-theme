import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			resultsImage, resultsIntro,
			result1Title, result1Text,
			result2Title, result2Text,
			result3Title, result3Text,
			result4Title, result4Text,
			warrantyText,
		} = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Results Image & Intro" initialOpen={ true }>
						<TextControl
							label="Results image URL or attachment ID"
							value={ resultsImage }
							onChange={ ( val ) => setAttributes( { resultsImage: val } ) }
							help="Enter a full image URL or a WordPress media library attachment ID."
						/>
						<TextareaControl
							label="Results intro paragraph"
							value={ resultsIntro }
							onChange={ ( val ) => setAttributes( { resultsIntro: val } ) }
							rows={ 3 }
						/>
					</PanelBody>
					<PanelBody title="Result Cards (leave title blank to hide card)" initialOpen={ true }>
						{ [ 1, 2, 3, 4 ].map( ( n ) => (
							<div key={ n } style={ { borderBottom: '1px solid #eee', paddingBottom: '12px', marginBottom: '12px' } }>
								<TextControl
									label={ `Card ${ n } title` }
									value={ attributes[ `result${ n }Title` ] }
									onChange={ ( val ) => setAttributes( { [ `result${ n }Title` ]: val } ) }
								/>
								<TextControl
									label={ `Card ${ n } text` }
									value={ attributes[ `result${ n }Text` ] }
									onChange={ ( val ) => setAttributes( { [ `result${ n }Text` ]: val } ) }
								/>
							</div>
						) ) }
					</PanelBody>
					<PanelBody title="Warranty / Closing Panel (optional)" initialOpen={ false }>
						<TextareaControl
							label="Warranty text (separate paragraphs with a blank line — leave blank to hide)"
							value={ warrantyText }
							onChange={ ( val ) => setAttributes( { warrantyText: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '32px',
						},
					} ) }
				>
					{ resultsImage && (
						<img
							src={ resultsImage }
							alt="Results"
							style={ { width: '100%', height: '200px', objectFit: 'cover', marginBottom: '24px' } }
						/>
					) }
					<p style={ { fontWeight: 700, fontSize: '22px', color: '#020202', margin: '0 0 12px' } }>
						The Results
					</p>
					{ resultsIntro && (
						<p style={ { color: '#364153', fontSize: '14px', margin: '0 0 16px' } }>{ resultsIntro }</p>
					) }
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '12px' } }>
						{ [ 1, 2, 3, 4 ].map( ( n ) => {
							const t = attributes[ `result${ n }Title` ];
							const b = attributes[ `result${ n }Text` ];
							if ( ! t ) return null;
							return (
								<div key={ n } style={ { background: '#f9fafb', padding: '16px' } }>
									<p style={ { fontWeight: 700, fontSize: '13px', color: '#020202', margin: '0 0 4px' } }>{ t }</p>
									{ b && <p style={ { color: '#364153', fontSize: '13px', margin: 0 } }>{ b }</p> }
								</div>
							);
						} ) }
					</div>
					{ warrantyText && (
						<div style={ { marginTop: '16px', background: '#020202', padding: '24px', color: '#fff', fontSize: '14px' } }>
							{ warrantyText }
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
