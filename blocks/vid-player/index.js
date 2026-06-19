import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { videoUrl, posterUrl, heading, description } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Video" initialOpen={true}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) => setAttributes({ videoUrl: media.url })}
                                allowedTypes={['video']}
                                render={({ open }) => (
                                    <div style={{ marginBottom: '12px' }}>
                                        <Button variant="secondary" onClick={open} style={{ width: '100%', justifyContent: 'center' }}>
                                            {videoUrl ? 'Replace Video' : 'Upload Video'}
                                        </Button>
                                        {videoUrl && (
                                            <div style={{ marginTop: '8px' }}>
                                                <TextControl
                                                    label="Video URL"
                                                    value={videoUrl}
                                                    onChange={(val) => setAttributes({ videoUrl: val })}
                                                    help="Or paste a URL manually"
                                                />
                                                <Button
                                                    variant="link"
                                                    isDestructive
                                                    onClick={() => setAttributes({ videoUrl: '' })}
                                                    style={{ marginTop: '4px' }}
                                                >
                                                    Remove video
                                                </Button>
                                            </div>
                                        )}
                                    </div>
                                )}
                            />
                        </MediaUploadCheck>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) => setAttributes({ posterUrl: media.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <div style={{ marginBottom: '12px' }}>
                                        <Button variant="secondary" onClick={open} style={{ width: '100%', justifyContent: 'center' }}>
                                            {posterUrl ? 'Replace Poster Image' : 'Upload Poster Image'}
                                        </Button>
                                        {posterUrl && (
                                            <div style={{ marginTop: '8px' }}>
                                                <img src={posterUrl} alt="" style={{ width: '100%', height: 'auto', borderRadius: '4px' }} />
                                                <Button
                                                    variant="link"
                                                    isDestructive
                                                    onClick={() => setAttributes({ posterUrl: '' })}
                                                    style={{ marginTop: '4px' }}
                                                >
                                                    Remove poster
                                                </Button>
                                            </div>
                                        )}
                                    </div>
                                )}
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                    <PanelBody title="Content">
                        <TextControl
                            label="Heading"
                            value={heading}
                            onChange={(val) => setAttributes({ heading: val })}
                        />
                        <TextareaControl
                            label="Description"
                            value={description}
                            onChange={(val) => setAttributes({ description: val })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div style={{ display: 'flex', gap: '24px', padding: '20px', background: '#f9fafb', borderRadius: '4px' }}>
                    <div style={{ flex: 1, background: '#000', borderRadius: '4px', aspectRatio: '16/9', display: 'flex', alignItems: 'center', justifyContent: 'center', overflow: 'hidden' }}>
                        {videoUrl ? (
                            <video src={videoUrl} style={{ width: '100%', height: '100%', objectFit: 'contain' }} muted />
                        ) : (
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={(media) => setAttributes({ videoUrl: media.url })}
                                    allowedTypes={['video']}
                                    render={({ open }) => (
                                        <Button variant="primary" onClick={open}>
                                            Upload Video
                                        </Button>
                                    )}
                                />
                            </MediaUploadCheck>
                        )}
                    </div>
                    <div style={{ flex: 1 }}>
                        <h3 style={{ color: '#ff5c00', fontSize: '22px', fontWeight: 700, margin: 0 }}>{heading || 'Video title...'}</h3>
                        <p style={{ color: '#666', fontSize: '14px', marginTop: '8px' }}>{description || 'Video description...'}</p>
                    </div>
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
