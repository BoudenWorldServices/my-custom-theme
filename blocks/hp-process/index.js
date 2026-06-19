import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, subheading, accent, body1, body2, steps } = attributes;

		const updateStep = ( index, field, value ) => {
			const updated = steps.map( ( step, i ) =>
				i === index ? { ...step, [ field ]: value } : step
			);
			setAttributes( { steps: updated } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Headings" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextControl
							label="Subheading"
							value={ subheading }
							onChange={ ( val ) => setAttributes( { subheading: val } ) }
						/>
						<TextareaControl
							label="Accent text (orange)"
							value={ accent }
							onChange={ ( val ) => setAttributes( { accent: val } ) }
							rows={ 2 }
						/>
						<TextareaControl
							label="Body paragraph 1"
							value={ body1 }
							onChange={ ( val ) => setAttributes( { body1: val } ) }
							rows={ 3 }
						/>
						<TextareaControl
							label="Body paragraph 2"
							value={ body2 }
							onChange={ ( val ) => setAttributes( { body2: val } ) }
							rows={ 2 }
						/>
					</PanelBody>
					{ steps.map( ( step, i ) => (
						<PanelBody key={ i } title={ `Step ${ i + 1 }` } initialOpen={ false }>
							<TextControl
								label="Step title"
								value={ step.title || '' }
								onChange={ ( val ) => updateStep( i, 'title', val ) }
							/>
							<TextareaControl
								label="Step description"
								value={ step.description || '' }
								onChange={ ( val ) => updateStep( i, 'description', val ) }
								rows={ 3 }
							/>
						</PanelBody>
					) ) }
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
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>
						Installation Process
					</p>
					<h2 style={ { fontSize: '30px', fontWeight: 700, color: '#020202', margin: '0 0 4px' } }>{ heading }</h2>
					<p style={ { fontSize: '18px', fontWeight: 500, color: '#020202', margin: '0 0 16px' } }>{ subheading }</p>
					<p style={ { fontSize: '14px', color: '#ff5c00', margin: '0 0 4px' } }>{ accent }</p>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '16px', marginTop: '24px' } }>
						{ steps.map( ( step, i ) => (
							<div key={ i } style={ { borderTop: '2px solid #e5e7eb', paddingTop: '16px' } }>
								<div style={ { width: '40px', height: '50px', background: '#ff5c00', marginBottom: '8px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>
									<span style={ { color: '#fff', fontWeight: 700, fontSize: '16px' } }>{ i + 1 }</span>
								</div>
								<p style={ { fontSize: '13px', fontWeight: 700, color: '#020202', margin: '0 0 4px' } }>{ step.title }</p>
								<p style={ { fontSize: '11px', color: '#020202', margin: 0 } }>{ step.description }</p>
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
