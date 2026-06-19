import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { badge, heading, headingHighlight, description, ctaText, ctaUrl, minHeight } = attributes;

		const heightMap = { small: '320px', medium: '400px', large: '500px' };

		return (
			<>
				<InspectorControls>
					<PanelBody title="Hero Content" initialOpen={ true }>
						<TextControl
							label="Badge text (small orange label above heading — leave blank to hide)"
							value={ badge }
							onChange={ ( val ) => setAttributes( { badge: val } ) }
							placeholder="e.g. THE GOLIATH DIFFERENCE"
						/>
						<TextControl
							label="Heading (white part)"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
						<TextControl
							label="Heading highlight (orange part — leave blank for fully white heading)"
							value={ headingHighlight }
							onChange={ ( val ) => setAttributes( { headingHighlight: val } ) }
							help="Appears after the white heading text in orange. Example: heading = 'Why Choose' and highlight = 'GOLIATH™'"
						/>
						<TextareaControl
							label="Description paragraph"
							value={ description }
							onChange={ ( val ) => setAttributes( { description: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
					<PanelBody title="CTA Button (optional)" initialOpen={ false }>
						<TextControl
							label="Button text (leave blank to hide)"
							value={ ctaText }
							onChange={ ( val ) => setAttributes( { ctaText: val } ) }
							placeholder="e.g. View case studies"
						/>
						<TextControl
							label="Button URL"
							value={ ctaUrl }
							onChange={ ( val ) => setAttributes( { ctaUrl: val } ) }
							help="Default: /contact/"
						/>
					</PanelBody>
					<PanelBody title="Height" initialOpen={ false }>
						<SelectControl
							label="Section height"
							value={ minHeight }
							options={ [
								{ label: 'Small (320px)', value: 'small' },
								{ label: 'Medium (400px)', value: 'medium' },
								{ label: 'Large (500px)', value: 'large' },
							] }
							onChange={ ( val ) => setAttributes( { minHeight: val } ) }
						/>
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: 'linear-gradient(135deg, #020202 0%, #1a1a2e 100%)',
							padding: '48px 32px',
							minHeight: heightMap[ minHeight ],
							display: 'flex',
							flexDirection: 'column',
							justifyContent: 'flex-end',
							gap: '12px',
						},
					} ) }
				>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: 0 } }>
						{ badge || 'Hero Section' }
					</p>
					<h1 style={ { fontSize: '36px', fontWeight: 700, color: '#fff', margin: 0, lineHeight: 1.2 } }>
						{ heading || 'Page Heading' }
						{ headingHighlight && (
							<span style={ { color: '#ff5c00' } }> { headingHighlight }</span>
						) }
					</h1>
					{ description && (
						<p style={ { color: 'rgba(255,255,255,0.85)', fontSize: '16px', margin: 0, maxWidth: '720px' } }>
							{ description }
						</p>
					) }
					{ ctaText && (
						<div style={ { display: 'inline-block', background: '#ff5c00', color: '#fff', padding: '16px 24px', fontWeight: 700, fontSize: '13px', letterSpacing: '0.5px', textTransform: 'uppercase', marginTop: '8px' } }>
							{ ctaText }
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
