import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { description, ctaText, image, proj1Title, proj1Desc, proj2Title, proj2Desc, proj3Title, proj3Desc, proj4Title, proj4Desc } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fafafa', padding: '16px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Section Content" initialOpen>
                        <TextareaControl label="Description" value={description} onChange={v => setAttributes({ description: v })} />
                        <TextControl label="CTA Button Text" value={ctaText} onChange={v => setAttributes({ ctaText: v })} />
                    </PanelBody>
                    <PanelBody title="Projects" initialOpen={false}>
                        {[
                            { t: proj1Title, tKey: 'proj1Title', d: proj1Desc, dKey: 'proj1Desc', label: 'Project 1' },
                            { t: proj2Title, tKey: 'proj2Title', d: proj2Desc, dKey: 'proj2Desc', label: 'Project 2' },
                            { t: proj3Title, tKey: 'proj3Title', d: proj3Desc, dKey: 'proj3Desc', label: 'Project 3' },
                            { t: proj4Title, tKey: 'proj4Title', d: proj4Desc, dKey: 'proj4Desc', label: 'Project 4' },
                        ].map(p => (
                            <div key={p.label}>
                                <p style={{ margin: '8px 0 4px', fontWeight: 700, fontSize: 11, color: '#555' }}>{p.label}</p>
                                <TextControl label="Title" value={p.t} onChange={v => setAttributes({ [p.tKey]: v })} />
                                <TextareaControl label="Description" value={p.d} onChange={v => setAttributes({ [p.dKey]: v })} />
                            </div>
                        ))}
                    </PanelBody>
                    <PanelBody title="Image" initialOpen={false}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={m => setAttributes({ image: m.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <>
                                        {image && <img src={image} style={{ width: '100%', marginBottom: 8 }} alt="" />}
                                        <Button variant="secondary" onClick={open}>{image ? 'Replace Image' : 'Upload Image'}</Button>
                                    </>
                                )}
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps} style={{ ...blockProps.style, display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16 }}>
                    <div>
                        <h2 style={{ fontSize: 18, margin: '0 0 8px' }}>Perfect for <span style={{ color: '#ff5c00' }}>Every Project</span></h2>
                        <p style={{ color: '#666', fontSize: 13, marginBottom: 12 }}>{description}</p>
                        {[{t: proj1Title, d: proj1Desc}, {t: proj2Title, d: proj2Desc}, {t: proj3Title, d: proj3Desc}, {t: proj4Title, d: proj4Desc}].map((p, i) => (
                            <div key={i} style={{ marginBottom: 8 }}>
                                <p style={{ fontWeight: 700, fontSize: 13, margin: 0 }}>{p.t}</p>
                                <p style={{ color: '#666', fontSize: 12, margin: 0 }}>{p.d}</p>
                            </div>
                        ))}
                    </div>
                    <div style={{ background: '#d9d9d9', minHeight: 200, overflow: 'hidden' }}>
                        {image
                            ? <img src={image} style={{ width: '100%', height: '100%', objectFit: 'cover' }} alt="" />
                            : <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: 200, color: '#888', fontSize: 12 }}>No image set</div>
                        }
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
