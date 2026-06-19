import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading1, heading2, intro, submitText, privacyNote, trustBarText, whyH3, whyReasons } = attributes;
        const blockProps = useBlockProps({ style: { background: '#ff5c00', padding: '24px', color: '#fff' } });

        const updateReason = (index, value) => {
            const updated = [...whyReasons];
            updated[index] = value;
            setAttributes({ whyReasons: updated });
        };

        const removeReason = (index) => {
            const updated = whyReasons.filter((_, i) => i !== index);
            setAttributes({ whyReasons: updated });
        };

        const addReason = () => {
            setAttributes({ whyReasons: [...whyReasons, ''] });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Form Content" initialOpen>
                        <TextControl label="Heading Line 1" value={heading1} onChange={v => setAttributes({ heading1: v })} />
                        <TextControl label="Heading Line 2" value={heading2} onChange={v => setAttributes({ heading2: v })} />
                        <TextareaControl label="Intro Text" value={intro} onChange={v => setAttributes({ intro: v })} />
                        <TextControl label="Submit Button Text" value={submitText} onChange={v => setAttributes({ submitText: v })} />
                        <TextControl label="Privacy Note" value={privacyNote} onChange={v => setAttributes({ privacyNote: v })} />
                    </PanelBody>
                    <PanelBody title="Trust Bar" initialOpen={false}>
                        <TextControl label="Trust Bar Text" value={trustBarText} onChange={v => setAttributes({ trustBarText: v })} />
                    </PanelBody>
                    <PanelBody title="Why Section" initialOpen={false}>
                        <TextControl label="Heading" value={whyH3} onChange={v => setAttributes({ whyH3: v })} />
                        {whyReasons.map((reason, i) => (
                            <div key={i} style={{ display: 'flex', alignItems: 'flex-start', gap: '4px', marginBottom: '8px' }}>
                                <TextControl
                                    label={`Reason ${i + 1}`}
                                    value={reason}
                                    onChange={v => updateReason(i, v)}
                                    style={{ flex: 1 }}
                                />
                                <Button
                                    isDestructive
                                    variant="secondary"
                                    size="small"
                                    onClick={() => removeReason(i)}
                                    style={{ marginTop: '24px' }}
                                >
                                    ✕
                                </Button>
                            </div>
                        ))}
                        <Button variant="secondary" onClick={addReason}>
                            Add reason
                        </Button>
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ color: '#fff', fontSize: 20, margin: '0 0 4px' }}>{heading1}</h2>
                    <h2 style={{ color: '#fff', fontSize: 28, margin: '0 0 12px', fontWeight: 900 }}>{heading2}</h2>
                    <p style={{ color: '#fff', opacity: 0.85, fontSize: 14, marginBottom: 16 }}>{intro}</p>
                    <div style={{ background: '#fff', color: '#020202', padding: '16px', borderRadius: 2, opacity: 0.9, fontSize: 13 }}>
                        [Consultation form – rendered server-side with live phone/email/address]
                        <div style={{ background: '#ff5c00', color: '#fff', padding: '10px 16px', marginTop: 12, textAlign: 'center', fontWeight: 700 }}>
                            {submitText}
                        </div>
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
