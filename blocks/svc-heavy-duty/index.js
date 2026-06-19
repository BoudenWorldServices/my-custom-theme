import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, h3, description, feat1Title, feat1Desc, feat2Title, feat2Desc, feat3Title, feat3Desc, feat4Title, feat4Desc, beforeImage, afterImage } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fafafa', padding: '16px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Section Header" initialOpen>
                        <TextControl label="H2 Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextControl label="H3 (orange)" value={h3} onChange={v => setAttributes({ h3: v })} />
                        <TextareaControl label="Description" value={description} onChange={v => setAttributes({ description: v })} />
                    </PanelBody>
                    <PanelBody title="Features" initialOpen={false}>
                        <TextControl label="Feature 1 Title" value={feat1Title} onChange={v => setAttributes({ feat1Title: v })} />
                        <TextareaControl label="Feature 1 Description" value={feat1Desc} onChange={v => setAttributes({ feat1Desc: v })} />
                        <TextControl label="Feature 2 Title" value={feat2Title} onChange={v => setAttributes({ feat2Title: v })} />
                        <TextareaControl label="Feature 2 Description" value={feat2Desc} onChange={v => setAttributes({ feat2Desc: v })} />
                        <TextControl label="Feature 3 Title" value={feat3Title} onChange={v => setAttributes({ feat3Title: v })} />
                        <TextareaControl label="Feature 3 Description" value={feat3Desc} onChange={v => setAttributes({ feat3Desc: v })} />
                        <TextControl label="Feature 4 Title" value={feat4Title} onChange={v => setAttributes({ feat4Title: v })} />
                        <TextareaControl label="Feature 4 Description" value={feat4Desc} onChange={v => setAttributes({ feat4Desc: v })} />
                    </PanelBody>
                    <PanelBody title="Before/After Images" initialOpen={false}>
                        <p style={{ margin: '0 0 4px', fontSize: 11, color: '#888' }}>Before Image</p>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={m => setAttributes({ beforeImage: m.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <>
                                        {beforeImage && <img src={beforeImage} style={{ width: '100%', marginBottom: 4 }} alt="" />}
                                        <Button variant="secondary" onClick={open}>{beforeImage ? 'Replace' : 'Upload Before Image'}</Button>
                                    </>
                                )}
                            />
                        </MediaUploadCheck>
                        <p style={{ margin: '12px 0 4px', fontSize: 11, color: '#888' }}>After Image</p>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={m => setAttributes({ afterImage: m.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <>
                                        {afterImage && <img src={afterImage} style={{ width: '100%', marginBottom: 4 }} alt="" />}
                                        <Button variant="secondary" onClick={open}>{afterImage ? 'Replace' : 'Upload After Image'}</Button>
                                    </>
                                )}
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ fontSize: 22, margin: '0 0 4px', color: '#020202' }}>{heading}</h2>
                    <h3 style={{ fontSize: 22, margin: '0 0 8px', color: '#ff5c00' }}>{h3}</h3>
                    <p style={{ color: '#666', fontSize: 13, marginBottom: 16 }}>{description}</p>
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 12 }}>
                        {[{ t: feat1Title, d: feat1Desc }, { t: feat2Title, d: feat2Desc }, { t: feat3Title, d: feat3Desc }, { t: feat4Title, d: feat4Desc }].map((f, i) => (
                            <div key={i} style={{ padding: 8, background: '#fff', border: '1px solid #eee' }}>
                                <p style={{ fontWeight: 700, margin: '0 0 4px', fontSize: 13 }}>{f.t}</p>
                                <p style={{ color: '#666', fontSize: 12, margin: 0 }}>{f.d}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
