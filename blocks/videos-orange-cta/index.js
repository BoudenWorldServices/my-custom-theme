import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, body, btnText, btnUrl } = attributes;
        const blockProps = useBlockProps({ style: { background: '#ff5c00', padding: '24px', textAlign: 'center' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Orange CTA" initialOpen>
                        <TextControl label="Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextareaControl label="Body" value={body} onChange={v => setAttributes({ body: v })} />
                        <TextControl label="Button Text" value={btnText} onChange={v => setAttributes({ btnText: v })} />
                        <TextControl label="Button URL" value={btnUrl} onChange={v => setAttributes({ btnUrl: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ color: '#fff', fontSize: 24, margin: '0 0 8px' }}>{heading}</h2>
                    <p style={{ color: '#fff', opacity: 0.9, fontSize: 14, marginBottom: 16 }}>{body}</p>
                    <div style={{ background: '#020202', color: '#fff', padding: '10px 24px', display: 'inline-block', fontWeight: 700 }}>{btnText}</div>
                </div>
            </>
        );
    },
    save: () => null,
});
