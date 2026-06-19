import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

registerBlockType( 'goliath/svc-case-banner', {
    edit( { attributes, setAttributes } ) {
        const { heading, description, ctaText, ctaUrl } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Case Banner">
                        <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ heading: v }) } />
                        <TextareaControl label="Description" value={ description } onChange={ v => setAttributes({ description: v }) } />
                        <TextControl label="CTA text" value={ ctaText } onChange={ v => setAttributes({ ctaText: v }) } />
                        <TextControl label="CTA URL" value={ ctaUrl } onChange={ v => setAttributes({ ctaUrl: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ background: '#ff5c00', padding: '20px', color: '#fff' }}>
                    { heading && <h3 style={{ fontWeight: 700 }}>{ heading }</h3> }
                    { description && <p style={{ marginTop: '8px' }}>{ description }</p> }
                    { ctaText && <span style={{ display: 'inline-block', marginTop: '12px', background: '#020202', padding: '8px 20px' }}>{ ctaText }</span> }
                </div>
            </div>
        );
    },
    save() { return null; }
} );
