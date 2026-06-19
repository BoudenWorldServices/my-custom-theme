import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { headingBlack, headingOrange, introText, bulletPoints, closingText } = attributes;
        const blockProps = useBlockProps();

        const updateBullet = (index, value) => {
            const updated = [...bulletPoints];
            updated[index] = value;
            setAttributes({ bulletPoints: updated });
        };

        const addBullet = () => {
            setAttributes({ bulletPoints: [...bulletPoints, ''] });
        };

        const removeBullet = (index) => {
            const updated = bulletPoints.filter((_, i) => i !== index);
            setAttributes({ bulletPoints: updated });
        };

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Heading">
                        <TextControl
                            label="Heading (black part)"
                            value={headingBlack}
                            onChange={(val) => setAttributes({ headingBlack: val })}
                        />
                        <TextControl
                            label="Heading (orange part)"
                            value={headingOrange}
                            onChange={(val) => setAttributes({ headingOrange: val })}
                        />
                    </PanelBody>
                    <PanelBody title="Content">
                        <TextareaControl
                            label="Intro text"
                            value={introText}
                            onChange={(val) => setAttributes({ introText: val })}
                        />
                        <TextareaControl
                            label="Closing text"
                            value={closingText}
                            onChange={(val) => setAttributes({ closingText: val })}
                        />
                    </PanelBody>
                    <PanelBody title="Bullet Points">
                        {bulletPoints.map((point, i) => (
                            <div key={i} style={{ display: 'flex', gap: '4px', marginBottom: '8px' }}>
                                <TextControl
                                    value={point}
                                    onChange={(val) => updateBullet(i, val)}
                                    style={{ flex: 1 }}
                                />
                                <Button
                                    isDestructive
                                    isSmall
                                    onClick={() => removeBullet(i)}
                                >
                                    ✕
                                </Button>
                            </div>
                        ))}
                        <Button variant="secondary" onClick={addBullet}>
                            Add bullet point
                        </Button>
                    </PanelBody>
                </InspectorControls>
                <div style={{ padding: '30px', background: '#fff', border: '1px solid #e5e7eb', borderRadius: '4px' }}>
                    <h3 style={{ fontSize: '22px', fontWeight: 700, margin: 0 }}>
                        <span style={{ color: '#020202' }}>{headingBlack} </span>
                        <span style={{ color: '#ff5c00' }}>{headingOrange}</span>
                    </h3>
                    {introText && <p style={{ color: '#666', marginTop: '8px' }}>{introText}</p>}
                    {bulletPoints.length > 0 && (
                        <ul style={{ marginTop: '12px', paddingLeft: '20px' }}>
                            {bulletPoints.map((point, i) => (
                                <li key={i} style={{ color: '#666', marginBottom: '4px' }}>{point}</li>
                            ))}
                        </ul>
                    )}
                    {closingText && <p style={{ color: '#666', marginTop: '12px' }}>{closingText}</p>}
                </div>
            </div>
        );
    },
    save() {
        return null;
    },
});
