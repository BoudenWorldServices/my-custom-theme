import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, ctaText, img1, img2, img3, img4, img5 } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fafafa', padding: '16px' } });

        const ImagePicker = ({ label, value, propKey }) => (
            <div style={{ marginBottom: 8 }}>
                <p style={{ fontSize: 11, margin: '0 0 4px', color: '#555' }}>{label}</p>
                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={m => setAttributes({ [propKey]: m.url })}
                        allowedTypes={['image']}
                        render={({ open }) => (
                            <>
                                {value && <img src={value} style={{ width: '100%', height: 60, objectFit: 'cover', marginBottom: 4 }} alt="" />}
                                <Button variant="secondary" onClick={open} style={{ fontSize: 11 }}>{value ? 'Replace' : 'Upload'}</Button>
                            </>
                        )}
                    />
                </MediaUploadCheck>
            </div>
        );

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Gallery" initialOpen>
                        <TextControl label="Section Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextControl label="CTA Button Text" value={ctaText} onChange={v => setAttributes({ ctaText: v })} />
                    </PanelBody>
                    <PanelBody title="Gallery Images" initialOpen={false}>
                        <ImagePicker label="Image 1" value={img1} propKey="img1" />
                        <ImagePicker label="Image 2" value={img2} propKey="img2" />
                        <ImagePicker label="Image 3" value={img3} propKey="img3" />
                        <ImagePicker label="Image 4 (wide)" value={img4} propKey="img4" />
                        <ImagePicker label="Image 5 (tall)" value={img5} propKey="img5" />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ fontSize: 18, marginBottom: 12 }}>{heading}</h2>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 8 }}>
                        {[img1, img2, img3, img4, img5].map((img, i) => (
                            <div key={i} style={{ background: '#d9d9d9', height: 80, overflow: 'hidden' }}>
                                {img ? <img src={img} style={{ width: '100%', height: '100%', objectFit: 'cover' }} alt="" /> : <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', fontSize: 11, color: '#888' }}>Image {i + 1}</div>}
                            </div>
                        ))}
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
