import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';

registerBlockType( 'goliath/svc-hero', {
    edit( { attributes, setAttributes } ) {
        const { headingWhite, headingOrange, orangeFirst, description } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Hero Content">
                        <TextControl label="Heading (white part)" value={ headingWhite } onChange={ v => setAttributes({ headingWhite: v }) } />
                        <TextControl label="Heading (orange part)" value={ headingOrange } onChange={ v => setAttributes({ headingOrange: v }) } />
                        <ToggleControl label="Orange text first" checked={ orangeFirst } onChange={ v => setAttributes({ orangeFirst: v }) } />
                        <TextareaControl label="Description" value={ description } onChange={ v => setAttributes({ description: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ background: '#020202', padding: '40px 30px', color: '#fff' }}>
                    <h1 style={{ fontSize: '36px', fontWeight: 700, margin: 0 }}>
                        { orangeFirst ? <><span style={{ color: '#ff5c00' }}>{ headingOrange } </span>{ headingWhite }</> : <>{ headingWhite } <span style={{ color: '#ff5c00' }}>{ headingOrange }</span></> }
                    </h1>
                    { description && <p style={{ marginTop: '16px', color: '#d1d5dc', fontSize: '16px' }}>{ description }</p> }
                </div>
            </div>
        );
    },
    save() { return null; }
} );
