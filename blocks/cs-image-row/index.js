import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, Button } from '@wordpress/components';
import metadata from './block.json';

function ImageField({ label, urlKey, altKey, captionKey, attributes, setAttributes }) {
    const url = attributes[urlKey];
    const alt = attributes[altKey];
    const caption = attributes[captionKey];

    return (
        <div style={{ marginBottom: '16px' }}>
            <p style={{ fontWeight: 600, fontSize: '12px', marginBottom: '8px' }}>{label}</p>
            <MediaUploadCheck>
                <MediaUpload
                    onSelect={(media) =>
                        setAttributes({
                            [urlKey]: media.url,
                            [altKey]: media.alt || '',
                        })
                    }
                    allowedTypes={['image']}
                    render={({ open }) => (
                        <div style={{ marginBottom: '8px' }}>
                            <Button
                                variant="secondary"
                                onClick={open}
                                style={{ width: '100%', justifyContent: 'center' }}
                            >
                                {url ? 'Replace Image' : 'Upload Image'}
                            </Button>
                            {url && (
                                <div style={{ marginTop: '8px' }}>
                                    <img src={url} alt="" style={{ width: '100%', height: 'auto', borderRadius: '4px' }} />
                                    <Button
                                        variant="link"
                                        isDestructive
                                        onClick={() => setAttributes({ [urlKey]: '', [altKey]: '', [captionKey]: '' })}
                                        style={{ marginTop: '4px' }}
                                    >
                                        Remove
                                    </Button>
                                </div>
                            )}
                        </div>
                    )}
                />
            </MediaUploadCheck>
            <TextControl
                label="Alt text"
                value={alt}
                onChange={(val) => setAttributes({ [altKey]: val })}
                placeholder="Describe the image"
            />
            <TextControl
                label="Caption (optional)"
                value={caption}
                onChange={(val) => setAttributes({ [captionKey]: val })}
                placeholder="Leave blank to hide"
            />
        </div>
    );
}

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { layout, image1Url, image2Url } = attributes;
        const blockProps = useBlockProps({ style: { background: '#f9fafb', padding: '24px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Layout" initialOpen={true}>
                        <SelectControl
                            label="Image layout"
                            value={layout}
                            options={[
                                { label: 'Single image (full width)', value: 'single' },
                                { label: 'Two images side by side', value: 'two-column' },
                            ]}
                            onChange={(val) => setAttributes({ layout: val })}
                        />
                    </PanelBody>
                    <PanelBody title="Image 1" initialOpen={true}>
                        <ImageField
                            label="Image 1"
                            urlKey="image1Url"
                            altKey="image1Alt"
                            captionKey="image1Caption"
                            attributes={attributes}
                            setAttributes={setAttributes}
                        />
                    </PanelBody>
                    {layout === 'two-column' && (
                        <PanelBody title="Image 2" initialOpen={true}>
                            <ImageField
                                label="Image 2"
                                urlKey="image2Url"
                                altKey="image2Alt"
                                captionKey="image2Caption"
                                attributes={attributes}
                                setAttributes={setAttributes}
                            />
                        </PanelBody>
                    )}
                </InspectorControls>

                <div {...blockProps}>
                    {!image1Url && !image2Url ? (
                        <p style={{ color: '#aaa', textAlign: 'center', margin: 0 }}>
                            Case Study – Image Row: upload images in the sidebar.
                        </p>
                    ) : (
                        <div
                            style={{
                                display: 'grid',
                                gridTemplateColumns: layout === 'two-column' ? '1fr 1fr' : '1fr',
                                gap: '16px',
                            }}
                        >
                            {image1Url && (
                                <img
                                    src={image1Url}
                                    alt=""
                                    style={{ width: '100%', height: '220px', objectFit: 'cover' }}
                                />
                            )}
                            {layout === 'two-column' && image2Url && (
                                <img
                                    src={image2Url}
                                    alt=""
                                    style={{ width: '100%', height: '220px', objectFit: 'cover' }}
                                />
                            )}
                        </div>
                    )}
                </div>
            </>
        );
    },
    save() {
        return null;
    },
});
