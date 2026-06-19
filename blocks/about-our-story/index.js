import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { heading, p1, p2, p3, p4 } = attributes;

		return (
			<>
				<InspectorControls>
					<PanelBody title="Our Story Content" initialOpen={ true }>
						<TextControl
							label="Heading"
							value={ heading }
							onChange={ ( val ) => setAttributes( { heading: val } ) }
						/>
					</PanelBody>
					<PanelBody title="Left Column" initialOpen={ true }>
						<TextareaControl
							label="Paragraph 1"
							value={ p1 }
							onChange={ ( val ) => setAttributes( { p1: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Paragraph 2"
							value={ p2 }
							onChange={ ( val ) => setAttributes( { p2: val } ) }
							rows={ 4 }
						/>
					</PanelBody>
					<PanelBody title="Right Column" initialOpen={ true }>
						<TextareaControl
							label="Paragraph 3"
							value={ p3 }
							onChange={ ( val ) => setAttributes( { p3: val } ) }
							rows={ 4 }
						/>
						<TextareaControl
							label="Paragraph 4"
							value={ p4 }
							onChange={ ( val ) => setAttributes( { p4: val } ) }
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
						About – Our Story
					</p>
					<h2 style={ { margin: '8px 0 16px', fontSize: '24px', fontWeight: 700, color: '#020202' } }>
						{ heading }
					</h2>
					<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px' } }>
						<div>
							<p style={ { color: '#4a5565', fontSize: '14px', margin: '0 0 8px' } }>{ p1 }</p>
							<p style={ { color: '#4a5565', fontSize: '14px', margin: 0 } }>{ p2 }</p>
						</div>
						<div>
							<p style={ { color: '#4a5565', fontSize: '14px', margin: '0 0 8px' } }>{ p3 }</p>
							<p style={ { color: '#4a5565', fontSize: '14px', margin: 0 } }>{ p4 }</p>
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
