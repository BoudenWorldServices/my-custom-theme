import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { stat1Value, stat1Label, stat2Value, stat2Label, stat3Value, stat3Label, stat4Value, stat4Label } = attributes;

		const stats = [
			{ value: stat1Value, label: stat1Label, setV: ( v ) => setAttributes( { stat1Value: v } ), setL: ( v ) => setAttributes( { stat1Label: v } ), n: 1 },
			{ value: stat2Value, label: stat2Label, setV: ( v ) => setAttributes( { stat2Value: v } ), setL: ( v ) => setAttributes( { stat2Label: v } ), n: 2 },
			{ value: stat3Value, label: stat3Label, setV: ( v ) => setAttributes( { stat3Value: v } ), setL: ( v ) => setAttributes( { stat3Label: v } ), n: 3 },
			{ value: stat4Value, label: stat4Label, setV: ( v ) => setAttributes( { stat4Value: v } ), setL: ( v ) => setAttributes( { stat4Label: v } ), n: 4 },
		];

		return (
			<>
				<InspectorControls>
					<PanelBody title="Statistics" initialOpen={ true }>
						{ stats.map( ( s ) => (
							<div key={ s.n } style={ { marginBottom: '16px', paddingBottom: '16px', borderBottom: '1px solid #ddd' } }>
								<p style={ { fontSize: '11px', fontWeight: 600, textTransform: 'uppercase', color: '#666', margin: '0 0 6px' } }>Stat { s.n }{ s.n === 4 ? ' (optional)' : '' }</p>
								<TextControl
									label="Value"
									value={ s.value }
									onChange={ s.setV }
								/>
								<TextControl
									label="Label"
									value={ s.label }
									onChange={ s.setL }
								/>
							</div>
						) ) }
					</PanelBody>
				</InspectorControls>

				<div
					{ ...useBlockProps( {
						style: {
							background: '#020202',
							padding: '32px',
							display: 'flex',
							gap: '32px',
							flexWrap: 'wrap',
						},
					} ) }
				>
					<p style={ { width: '100%', fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Stats Strip</p>
					{ stats.filter( ( s ) => s.value ).map( ( s ) => (
						<div key={ s.n } style={ { flex: '1 1 120px', textAlign: 'center' } }>
							<p style={ { fontSize: '28px', fontWeight: 700, color: '#ff5c00', margin: 0 } }>{ s.value }</p>
							<p style={ { fontSize: '12px', color: 'rgba(255,255,255,0.7)', margin: 0 } }>{ s.label }</p>
						</div>
					) ) }
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
