import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { quote, attribution } = attributes;
        const blockProps = useBlockProps({
            style: { background: '#fff', padding: '32px' },
        });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Quote" initialOpen={true}>
                        <TextareaControl
                            label="Quote text"
                            value={quote}
                            onChange={(val) => setAttributes({ quote: val })}
                            rows={4}
                            placeholder="Enter the client quote…"
                        />
                        <TextControl
                            label="Attribution (optional)"
                            value={attribution}
                            onChange={(val) => setAttributes({ attribution: val })}
                            placeholder="e.g. John Smith, Warehouse Manager"
                            help="Displayed below the quote. Leave blank to omit."
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div
                        style={{
                            borderLeft: '4px solid #ff5c00',
                            paddingLeft: '32px',
                        }}
                    >
                        <p style={{ color: '#ff5c00', fontSize: '72px', fontWeight: 700, lineHeight: 1, margin: '0 0 -12px' }}>
                            "
                        </p>
                        {quote ? (
                            <p style={{ color: '#020202', fontSize: '18px', fontStyle: 'italic', fontWeight: 500, lineHeight: '28px', margin: '0 0 16px' }}>
                                {quote}
                            </p>
                        ) : (
                            <p style={{ color: '#aaa', fontSize: '14px', fontStyle: 'italic', margin: '0 0 16px' }}>
                                Enter the quote text in the sidebar…
                            </p>
                        )}
                        {attribution && (
                            <p style={{ color: '#666', fontSize: '12px', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '1px', margin: 0 }}>
                                — {attribution}
                            </p>
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
