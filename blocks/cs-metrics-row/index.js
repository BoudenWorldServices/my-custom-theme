import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps({
            style: { background: '#020202', padding: '32px' },
        });

        const metrics = [1, 2, 3, 4].map((n) => ({
            value: attributes[`metric${n}Value`],
            label: attributes[`metric${n}Label`],
        }));

        const activeMetrics = metrics.filter((m) => m.value !== '');

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Metrics" initialOpen={true}>
                        {[1, 2, 3, 4].map((n) => (
                            <div
                                key={n}
                                style={{
                                    borderBottom: '1px solid #333',
                                    paddingBottom: '12px',
                                    marginBottom: '12px',
                                }}
                            >
                                <TextControl
                                    label={`Metric ${n} — value`}
                                    value={attributes[`metric${n}Value`]}
                                    onChange={(val) =>
                                        setAttributes({ [`metric${n}Value`]: val })
                                    }
                                    placeholder="e.g. 397, 100%, £380k"
                                />
                                <TextControl
                                    label={`Metric ${n} — label`}
                                    value={attributes[`metric${n}Label`]}
                                    onChange={(val) =>
                                        setAttributes({ [`metric${n}Label`]: val })
                                    }
                                    placeholder="e.g. Units repaired"
                                />
                            </div>
                        ))}
                        <p style={{ color: '#aaa', fontSize: '12px', margin: 0 }}>
                            Leave value blank to hide a metric. Up to 4 metrics are supported.
                        </p>
                    </PanelBody>
                </InspectorControls>
                <div {...blockProps}>
                    {activeMetrics.length === 0 ? (
                        <p style={{ color: '#aaa', textAlign: 'center', margin: 0 }}>
                            Case Study – Metrics Row: add values in the sidebar.
                        </p>
                    ) : (
                        <div
                            style={{
                                display: 'grid',
                                gridTemplateColumns: `repeat(${activeMetrics.length}, 1fr)`,
                                gap: '24px',
                                textAlign: 'center',
                            }}
                        >
                            {activeMetrics.map((m, i) => (
                                <div key={i}>
                                    <p
                                        style={{
                                            color: '#ff5c00',
                                            fontSize: '40px',
                                            fontWeight: 700,
                                            margin: '0 0 6px',
                                        }}
                                    >
                                        {m.value}
                                    </p>
                                    {m.label && (
                                        <p
                                            style={{
                                                color: '#fff',
                                                fontSize: '14px',
                                                margin: 0,
                                            }}
                                        >
                                            {m.label}
                                        </p>
                                    )}
                                </div>
                            ))}
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
