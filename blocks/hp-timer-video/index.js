import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { eyebrow, heading, compat, video, fallbackImage } = attributes;
        const blockProps = useBlockProps({ style: { background: '#ff6b2c', padding: '24px', color: '#fff' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Timer/Video Banner" initialOpen>
                        <TextControl label="Eyebrow" value={eyebrow} onChange={v => setAttributes({ eyebrow: v })} />
                        <TextControl label="Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextControl label="Compatibility note" value={compat} onChange={v => setAttributes({ compat: v })} />
                        <TextControl label="Video URL (optional)" value={video} onChange={v => setAttributes({ video: v })} />
                    </PanelBody>
                    <PanelBody title="Fallback Image" initialOpen={false}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={m => setAttributes({ fallbackImage: m.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <>
                                        {fallbackImage && <img src={fallbackImage} style={{ width: '100%', marginBottom: 8 }} alt="" />}
                                        <Button variant="secondary" onClick={open}>{fallbackImage ? 'Replace Image' : 'Upload Image'}</Button>
                                    </>
                                )}
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <p style={{ fontSize: 11, textTransform: 'uppercase', margin: '0 0 4px', opacity: 0.8 }}>{eyebrow}</p>
                    <h2 style={{ color: '#fff', fontSize: 22, margin: '0 0 8px' }}>{heading}</h2>
                    <p style={{ fontWeight: 700, margin: 0, fontSize: 14 }}>{compat}</p>
                    <div style={{ marginTop: 12, padding: '8px', background: 'rgba(0,0,0,0.2)', fontSize: 12, color: '#fff' }}>
                        [Video panel – autoplay video or fallback image rendered server-side]
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
