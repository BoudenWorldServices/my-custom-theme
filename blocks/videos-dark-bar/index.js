import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { text, btn1, btn2, btn1Url, btn2Url } = attributes;
        const blockProps = useBlockProps({ style: { background: '#020202', padding: '16px', color: '#fff' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Dark CTA Bar" initialOpen>
                        <TextControl label="Text" value={text} onChange={v => setAttributes({ text: v })} />
                        <TextControl label="Button 1 Text" value={btn1} onChange={v => setAttributes({ btn1: v })} />
                        <TextControl label="Button 1 URL" value={btn1Url} onChange={v => setAttributes({ btn1Url: v })} />
                        <TextControl label="Button 2 Text" value={btn2} onChange={v => setAttributes({ btn2: v })} />
                        <TextControl label="Button 2 URL" value={btn2Url} onChange={v => setAttributes({ btn2Url: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps} style={{ ...blockProps.style, display: 'flex', justifyContent: 'space-between', alignItems: 'center', gap: 16, flexWrap: 'wrap' }}>
                    <p style={{ color: '#fff', fontWeight: 700, margin: 0 }}>{text}</p>
                    <div style={{ display: 'flex', gap: 12 }}>
                        <div style={{ border: '1px solid #fff', padding: '8px 16px', color: '#fff', fontSize: 13 }}>{btn1}</div>
                        <div style={{ background: '#ff5c00', padding: '8px 16px', color: '#fff', fontSize: 13 }}>{btn2}</div>
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
