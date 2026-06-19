import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { sectionHeading, layout } = attributes;
		const steps = [];
		for ( let n = 1; n <= 6; n++ ) {
			steps.push( { n, title: attributes[ `step${ n }Title` ], body: attributes[ `step${ n }Body` ] } );
		}
		const activeSteps = steps.filter( ( s ) => s.title );

		return (
			<>
				<InspectorControls>
					<PanelBody title="Section Settings" initialOpen={ true }>
						<TextControl label="Section heading (optional)" value={ sectionHeading } onChange={ ( v ) => setAttributes( { sectionHeading: v } ) } />
						<SelectControl label="Layout" value={ layout } options={ [ { label: 'Vertical (stacked)', value: 'vertical' }, { label: 'Horizontal (side by side)', value: 'horizontal' } ] } onChange={ ( v ) => setAttributes( { layout: v } ) } />
					</PanelBody>
					{ steps.map( ( s ) => (
						<PanelBody key={ s.n } title={ `Step ${ s.n }${ s.n > 4 ? ' (optional)' : '' }` } initialOpen={ s.n <= 3 }>
							<TextControl label="Title" value={ s.title } onChange={ ( v ) => setAttributes( { [ `step${ s.n }Title` ]: v } ) } />
							<TextareaControl label="Description" value={ s.body } rows={ 3 } onChange={ ( v ) => setAttributes( { [ `step${ s.n }Body` ]: v } ) } />
						</PanelBody>
					) ) }
				</InspectorControls>
				<div { ...useBlockProps( { style: { background: '#fff', padding: '32px', borderLeft: '4px solid #ff5c00' } } ) }>
					<p style={ { fontSize: '11px', color: '#ff5c00', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: '0 0 8px' } }>Process Steps</p>
					{ sectionHeading && <h2 style={ { fontSize: '24px', fontWeight: 700, margin: '0 0 16px' } }>{ sectionHeading }</h2> }
					<div style={ { display: 'flex', flexDirection: layout === 'horizontal' ? 'row' : 'column', gap: '16px', flexWrap: 'wrap' } }>
						{ activeSteps.length === 0 && <p style={ { color: '#aaa', fontStyle: 'italic' } }>Add step titles in the sidebar to see them here.</p> }
						{ activeSteps.map( ( s ) => (
							<div key={ s.n } style={ { display: 'flex', gap: '12px', alignItems: 'flex-start', flex: layout === 'horizontal' ? '1 1 200px' : undefined } }>
								<div style={ { minWidth: '40px', height: '40px', background: '#ff5c00', color: '#fff', fontWeight: 700, fontSize: '18px', display: 'flex', alignItems: 'center', justifyContent: 'center' } }>{ s.n }</div>
								<div>
									<h3 style={ { fontWeight: 700, margin: 0, fontSize: '15px' } }>{ s.title }</h3>
									{ s.body && <p style={ { color: '#555', fontSize: '13px', margin: '4px 0 0' } }>{ s.body.substring( 0, 80 ) }{ s.body.length > 80 ? '…' : '' }</p> }
								</div>
							</div>
						) ) }
					</div>
				</div>
			</>
		);
	},
	save() { return null; },
} );
