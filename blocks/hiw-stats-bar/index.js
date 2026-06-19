import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			stat1Value, stat1Label,
			stat2Value, stat2Label,
			stat3Value, stat3Label,
			stat4Value, stat4Label,
		} = attributes;

		const stats = [
			{ value: stat1Value, label: stat1Label, valueKey: 'stat1Value', labelKey: 'stat1Label' },
			{ value: stat2Value, label: stat2Label, valueKey: 'stat2Value', labelKey: 'stat2Label' },
			{ value: stat3Value, label: stat3Label, valueKey: 'stat3Value', labelKey: 'stat3Label' },
			{ value: stat4Value, label: stat4Label, valueKey: 'stat4Value', labelKey: 'stat4Label' },
		];

		return (
			<>
				<InspectorControls>
					{ stats.map( ( stat, i ) => (
						<PanelBody key={ i } title={ `Stat ${ i + 1 }` } initialOpen={ i === 0 }>
							<TextControl
								label="Value"
								value={ stat.value }
								onChange={ ( v ) => setAttributes( { [ stat.valueKey ]: v } ) }
							/>
							<TextControl
								label="Label"
								value={ stat.label }
								onChange={ ( v ) => setAttributes( { [ stat.labelKey ]: v } ) }
							/>
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', borderBottom: '1px solid #e8e8e9', padding: '24px 32px' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 12px' } }>HIW Stats Bar</p>
					<div style={ { display: 'flex', gap: '32px', flexWrap: 'wrap' } }>
						{ stats.map( ( stat, i ) => (
							<div key={ i } style={ { borderRight: i < 3 ? '1px solid #e8e8e9' : 'none', paddingRight: i < 3 ? '32px' : 0 } }>
								<p style={ { fontSize: '11px', color: '#666', margin: '0 0 2px' } }>{ stat.label }</p>
								<p style={ { fontSize: '20px', fontWeight: 700, color: '#020202', margin: 0 } }>{ stat.value }</p>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
