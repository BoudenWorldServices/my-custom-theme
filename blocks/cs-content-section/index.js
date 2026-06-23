import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, body, callout, imageUrl, imageAlt, imagePosition } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fff', padding: '32px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Section Heading" initialOpen={true}>
                        <TextControl
                            label="Heading"
                            value={heading}
                            onChange={(val) => setAttributes({ heading: val })}
                            placeholder="e.g. The Challenge, What We Replaced…"
                            help="Orange H2 heading. Leave blank to omit."
                        />
                    </PanelBody>
                    <PanelBody title="Body Text" initialOpen={true}>
                        <TextareaControl
                            label="Body paragraphs (separate with a blank line)"
                            value={body}
                            onChange={(val) => setAttributes({ body: val })}
                            rows={6}
                        />
                    </PanelBody>
                    <PanelBody title="Orange Callout Bar (optional)" initialOpen={false}>
                        <TextareaControl
                            label="Callout text (leave blank to hide)"
                            value={callout}
                            onChange={(val) => setAttributes({ callout: val })}
                            rows={3}
                        />
                    </PanelBody>
                    <PanelBody title="Image (optional)" initialOpen={false}>
                        <SelectControl
                            label="Image position"
                            value={imagePosition}
                            options={[
                                { label: 'No image', value: 'none' },
                                { label: 'Image on the right', value: 'right' },
                                { label: 'Image on the left', value: 'left' },
                            ]}
                            onChange={(val) => setAttributes({ imagePosition: val })}
                        />
                        {imagePosition !== 'none' && (
                            <>
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={(media) =>
                                            setAttributes({ imageUrl: media.url, imageAlt: media.alt || '' })
                                        }
                                        allowedTypes={['image']}
                                        render={({ open }) => (
                                            <div style={{ marginBottom: '8px' }}>
                                                <Button
                                                    variant="secondary"
                                                    onClick={open}
                                                    style={{ width: '100%', justifyContent: 'center' }}
                                                >
                                                    {imageUrl ? 'Replace Image' : 'Upload Image'}
                                                </Button>
                                                {imageUrl && (
                                                    <div style={{ marginTop: '8px' }}>
                                                        <img
                                                            src={imageUrl}
                                                            alt=""
                                                            style={{ width: '100%', height: 'auto', borderRadius: '4px' }}
                                                        />
                                                        <Button
                                                            variant="link"
                                                            isDestructive
                                                            onClick={() =>
                                                                setAttributes({ imageUrl: '', imageAlt: '' })
                                                            }
                                                            style={{ marginTop: '4px' }}
                                                        >
                                                            Remove image
                                                        </Button>
                                                    </div>
                                                )}
                                            </div>
                                        )}
                                    />
                                </MediaUploadCheck>
                                <TextControl
                                    label="Alt text"
                                    value={imageAlt}
                                    onChange={(val) => setAttributes({ imageAlt: val })}
                                    placeholder="Describe the image"
                                />
                            </>
                        )}
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div
                        style={{
                            display: 'flex',
                            flexDirection: imageUrl && imagePosition !== 'none' ? 'row' : 'column',
                            gap: '24px',
                            alignItems: 'flex-start',
                        }}
                    >
                        {imageUrl && imagePosition === 'left' && (
                            <img
                                src={imageUrl}
                                alt={imageAlt}
                                style={{ flex: 1, width: '50%', height: 'auto', objectFit: 'cover' }}
                            />
                        )}
                        <div style={{ flex: 1, maxWidth: imageUrl && imagePosition !== 'none' ? '50%' : '672px' }}>
                            {heading ? (
                                <p style={{ color: '#ff5c00', fontWeight: 700, fontSize: '22px', margin: '0 0 12px' }}>
                                    {heading}
                                </p>
                            ) : (
                                <p style={{ color: '#aaa', fontSize: '13px', margin: '0 0 12px', fontStyle: 'italic' }}>
                                    No heading — set in sidebar
                                </p>
                            )}
                            <p style={{ color: '#555', fontSize: '14px', margin: '0 0 12px' }}>
                                {body || '(body text — edit in sidebar)'}
                            </p>
                            {callout && (
                                <div style={{ background: '#ff6b2c', padding: '16px 24px' }}>
                                    <p style={{ color: '#fff', fontWeight: 700, fontSize: '14px', margin: 0 }}>
                                        {callout}
                                    </p>
                                </div>
                            )}
                        </div>
                        {imageUrl && imagePosition === 'right' && (
                            <img
                                src={imageUrl}
                                alt={imageAlt}
                                style={{ flex: 1, width: '50%', height: 'auto', objectFit: 'cover' }}
                            />
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
