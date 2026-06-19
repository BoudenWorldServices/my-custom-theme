import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { description, item1, item2, item3, item4, certH3, certLine1, certLine2, certBanner } = attributes;
        const blockProps = useBlockProps({ style: { background: '#020202', padding: '16px', color: '#fff' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Regulation Content" initialOpen>
                        <TextareaControl label="Description" value={description} onChange={v => setAttributes({ description: v })} />
                        <TextControl label="Item 1" value={item1} onChange={v => setAttributes({ item1: v })} />
                        <TextControl label="Item 2" value={item2} onChange={v => setAttributes({ item2: v })} />
                        <TextControl label="Item 3" value={item3} onChange={v => setAttributes({ item3: v })} />
                        <TextControl label="Item 4" value={item4} onChange={v => setAttributes({ item4: v })} />
                    </PanelBody>
                    <PanelBody title="Certificate Card" initialOpen={false}>
                        <TextControl label="Card Heading" value={certH3} onChange={v => setAttributes({ certH3: v })} />
                        <TextControl label="Line 1" value={certLine1} onChange={v => setAttributes({ certLine1: v })} />
                        <TextControl label="Line 2" value={certLine2} onChange={v => setAttributes({ certLine2: v })} />
                        <TextControl label="Banner Text" value={certBanner} onChange={v => setAttributes({ certBanner: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps} style={{ ...blockProps.style, display: 'flex', gap: 16, flexWrap: 'wrap' }}>
                    <div style={{ flex: 1, minWidth: 200 }}>
                        <h2 style={{ color: '#fff', fontSize: 16, margin: '0 0 4px' }}>UK Regulation <span style={{ color: '#ff5c00' }}>Compliant</span></h2>
                        <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: 13, marginBottom: 8 }}>{description}</p>
                        {[item1, item2, item3, item4].map((i, idx) => (
                            <div key={idx} style={{ display: 'flex', gap: 8, alignItems: 'center', marginBottom: 4 }}>
                                <span style={{ color: '#ff5c00', fontSize: 14 }}>✓</span>
                                <span style={{ color: '#fff', fontSize: 13 }}>{i}</span>
                            </div>
                        ))}
                    </div>
                    <div style={{ border: '2px solid #ff5c00', padding: 16, textAlign: 'center', minWidth: 200 }}>
                        <h3 style={{ color: '#fff', margin: '0 0 4px' }}>{certH3}</h3>
                        <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: 12, margin: 0 }}>{certLine1}</p>
                        <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: 12, margin: 0 }}>{certLine2}</p>
                        <div style={{ background: '#ff5c00', padding: '6px', marginTop: 12, color: '#fff', fontWeight: 700, fontSize: 13 }}>{certBanner}</div>
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
