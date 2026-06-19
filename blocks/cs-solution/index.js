import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { video, solutionText, solutionCallout } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fff', padding: '32px', display: 'flex', gap: '24px', alignItems: 'flex-start' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Solution Video (optional)" initialOpen={true}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) => setAttributes({ video: media.url })}
                                allowedTypes={['video']}
                                render={({ open }) => (
                                    <div style={{ marginBottom: '12px' }}>
                                        <Button variant="secondary" onClick={open} style={{ width: '100%', justifyContent: 'center' }}>
                                            {video ? 'Replace Video' : 'Upload Video'}
                                        </Button>
                                    </div>
                                )}
                            />
                        </MediaUploadCheck>
                        <TextControl
                            label="Video URL or filename"
                            value={video}
                            onChange={(val) => setAttributes({ video: val })}
                            placeholder="e.g. goliath-demo.mp4 or https://…"
                            help="Upload above or enter a URL / theme filename manually."
                        />
                        {video && (
                            <Button variant="link" isDestructive onClick={() => setAttributes({ video: '' })}>
                                Remove video
                            </Button>
                        )}
                    </PanelBody>
                    <PanelBody title="Solution Text" initialOpen={true}>
                        <TextareaControl
                            label="Solution body (separate paragraphs with a blank line)"
                            value={solutionText}
                            onChange={(val) => setAttributes({ solutionText: val })}
                            rows={6}
                        />
                    </PanelBody>
                    <PanelBody title="Orange Callout Box (optional)" initialOpen={false}>
                        <TextareaControl
                            label="Callout text (leave blank to hide)"
                            value={solutionCallout}
                            onChange={(val) => setAttributes({ solutionCallout: val })}
                            rows={3}
                        />
                    </PanelBody>
                </InspectorControls>
                <div {...blockProps}>
                    {video && (
                        <div style={{ flex: 1, background: '#000', aspectRatio: '16/9', display: 'flex', alignItems: 'center', justifyContent: 'center', overflow: 'hidden' }}>
                            <video src={video.startsWith('http') ? video : ''} style={{ width: '100%', height: '100%', objectFit: 'contain' }} muted />
                        </div>
                    )}
                    <div style={{ flex: 1 }}>
                        <p style={{ color: '#ff5c00', fontWeight: 700, fontSize: '22px', margin: '0 0 12px' }}>The Solution: Goliath™</p>
                        <p style={{ color: '#555', fontSize: '14px', margin: 0 }}>{solutionText || '(solution text — edit in sidebar)'}</p>
                        {solutionCallout && (
                            <div style={{ marginTop: '16px', background: '#ff6b2c', padding: '16px 24px' }}>
                                <p style={{ color: '#fff', fontWeight: 700, fontSize: '14px', margin: 0 }}>{solutionCallout}</p>
                            </div>
                        )}
                    </div>
                </div>
            </>
        );
    },
    save() {
        return null;
    },
});
