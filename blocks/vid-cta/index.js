import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, description, buttonText, buttonUrl } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="CTA Content">
                        <TextControl
                            label="Heading"
                            value={heading}
                            onChange={(val) => setAttributes({ heading: val })}
                        />
                        <TextareaControl
                            label="Description"
                            value={description}
                            onChange={(val) => setAttributes({ description: val })}
                        />
                        <TextControl
                            label="Button Text"
                            value={buttonText}
                            onChange={(val) => setAttributes({ buttonText: val })}
                        />
                        <TextControl
                            label="Button URL"
                            value={buttonUrl}
                            onChange={(val) => setAttributes({ buttonUrl: val })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div style={{ background: '#ff5c00', padding: '40px 30px', borderRadius: '4px', textAlign: 'center' }}>
                    <h3 style={{ color: '#fff', fontSize: '22px', fontWeight: 700, margin: 0 }}>{heading}</h3>
                    <p style={{ color: '#fff', fontSize: '15px', marginTop: '12px' }}>{description}</p>
                    <span style={{ display: 'inline-block', marginTop: '16px', background: '#020202', color: '#fff', padding: '12px 24px', fontWeight: 700, fontSize: '14px' }}>
                        {buttonText}
                    </span>
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
