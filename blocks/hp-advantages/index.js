import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { eyebrow, heading, intro1, intro2, advantages, barText, cta1Text, cta1Url, cta2Text, cta2Url } = attributes;

		const updateAdvantage = ( index, key, value ) => {
			const updated = advantages.map( ( adv, i ) =>
				i === index ? { ...adv, [key]: value } : adv
			);
			setAttributes( { advantages: updated } );
		};

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Labels" initialOpen={ true }>
						<TextControl
							label="Eyebrow text"
							value={ eyebrow }
							onChange={ ( val ) => setAttributes( { eyebrow: val } ) }
						/>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
					</PanelBody>

					<PanelBody title="Intro Text" initialOpen={ false }>
						<TextareaControl
							label="Intro paragraph 1"
							value={ intro1 }
							onChange={ ( val ) => setAttributes( { intro1: val } ) }
						/>
						<TextareaControl
							label="Intro paragraph 2"
							value={ intro2 }
							onChange={ ( val ) => setAttributes( { intro2: val } ) }
						/>
					</PanelBody>

					{ advantages.map( ( adv, i ) => (
						<PanelBody key={ i } title={ `Advantage ${ i + 1 }` } initialOpen={ false }>
							<TextControl
								label="Number"
								value={ adv.num }
								onChange={ ( val ) => updateAdvantage( i, 'num', val ) }
							/>
							<TextControl
								label="Title"
								value={ adv.title }
								onChange={ ( val ) => updateAdvantage( i, 'title', val ) }
							/>
							<TextareaControl
								label="Description"
								value={ adv.desc }
								onChange={ ( val ) => updateAdvantage( i, 'desc', val ) }
							/>
							<TextControl
								label="Badge text"
								value={ adv.badge }
								onChange={ ( val ) => updateAdvantage( i, 'badge', val ) }
							/>
							<ToggleControl
								label="Highlight (orange)"
								checked={ !! adv.highlight }
								onChange={ ( val ) => updateAdvantage( i, 'highlight', val ) }
							/>
						</PanelBody>
					) ) }

					<PanelBody title="CTA Bar" initialOpen={ false }>
						<TextControl
							label="Bar text"
							value={ barText }
							onChange={ ( val ) => setAttributes( { barText: val } ) }
						/>
						<TextControl
							label="CTA 1 text"
							value={ cta1Text }
							onChange={ ( val ) => setAttributes( { cta1Text: val } ) }
						/>
						<TextControl
							label="CTA 1 URL"
							value={ cta1Url }
							onChange={ ( val ) => setAttributes( { cta1Url: val } ) }
						/>
						<TextControl
							label="CTA 2 text"
							value={ cta2Text }
							onChange={ ( val ) => setAttributes( { cta2Text: val } ) }
						/>
						<TextControl
							label="CTA 2 URL"
							value={ cta2Url }
							onChange={ ( val ) => setAttributes( { cta2Url: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#fff',
							padding: '40px 32px',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: '#020202', fontWeight: 600, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 4px' } }>
						{ eyebrow }
					</p>
					<h2 style={ { fontSize: '28px', fontWeight: 700, color: '#020202', margin: '0 0 24px' } }>{ heading }</h2>
					<p style={ { fontSize: '13px', color: '#666', margin: 0 } }>
						6 Advantages + CTA Bar (edit in sidebar)
					</p>
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
