import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { description, btnText, btnUrl } = attributes;
        const blockProps = useBlockProps({ style: { background: '#ff5c00', padding: '24px', textAlign: 'center' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Services Final CTA" initialOpen>
                        <TextareaControl label="Description" value={description} onChange={v => setAttributes({ description: v })} />
                        <TextControl label="Button Text" value={btnText} onChange={v => setAttributes({ btnText: v })} />
                        <TextControl label="Button URL" value={btnUrl} onChange={v => setAttributes({ btnUrl: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ color: '#fff', fontSize: 22, margin: '0 0 8px' }}>
                        Interested in <span style={{ color: '#020202' }}>GOLIATH™?</span>
                    </h2>
                    <p style={{ color: '#fff', opacity: 0.9, fontSize: 14, marginBottom: 16, maxWidth: 600, margin: '0 auto 16px' }}>{description}</p>
                    <div style={{ background: '#020202', color: '#fff', padding: '12px 28px', display: 'inline-block', fontWeight: 700 }}>{btnText}</div>
                </div>
            </>
        );
    },
    save: () => null,
});
