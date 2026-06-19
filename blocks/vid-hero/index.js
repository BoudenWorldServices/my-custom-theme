import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { label, titleOrange, titleWhite, description } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Hero Content">
                        <TextControl
                            label="Label"
                            value={label}
                            onChange={(val) => setAttributes({ label: val })}
                        />
                        <TextControl
                            label="Title (orange part)"
                            value={titleOrange}
                            onChange={(val) => setAttributes({ titleOrange: val })}
                        />
                        <TextControl
                            label="Title (white part)"
                            value={titleWhite}
                            onChange={(val) => setAttributes({ titleWhite: val })}
                        />
                        <TextareaControl
                            label="Description"
                            value={description}
                            onChange={(val) => setAttributes({ description: val })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div style={{ background: 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)', padding: '40px 30px', borderRadius: '4px' }}>
                    <p style={{ color: '#ff5c00', fontSize: '14px', fontWeight: 500 }}>{label}</p>
                    <h2 style={{ color: '#fff', fontSize: '28px', fontWeight: 700, margin: '8px 0' }}>
                        <span style={{ color: '#ff5c00' }}>{titleOrange}</span> {titleWhite}
                    </h2>
                    <p style={{ color: 'rgba(255,255,255,0.85)', fontSize: '15px' }}>{description}</p>
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
