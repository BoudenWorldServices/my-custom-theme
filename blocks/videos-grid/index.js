import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { installHeading, installSubtitle, safetyHeading, safetySubtitle } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fff', padding: '16px', border: '1px solid #eee' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Installation Videos" initialOpen>
                        <TextControl label="Section Heading" value={installHeading} onChange={v => setAttributes({ installHeading: v })} />
                        <TextControl label="Subtitle" value={installSubtitle} onChange={v => setAttributes({ installSubtitle: v })} />
                    </PanelBody>
                    <PanelBody title="Safety Videos" initialOpen={false}>
                        <TextControl label="Section Heading" value={safetyHeading} onChange={v => setAttributes({ safetyHeading: v })} />
                        <TextControl label="Subtitle" value={safetySubtitle} onChange={v => setAttributes({ safetySubtitle: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h3 style={{ color: '#020202', fontSize: 18, margin: '0 0 4px' }}>{installHeading}</h3>
                    <p style={{ color: '#ff5c00', fontSize: 13, margin: '0 0 12px' }}>{installSubtitle}</p>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 12 }}>
                        {[1, 2, 3].map(i => (
                            <div key={i} style={{ background: '#020202', height: 100, display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#fff', fontSize: 12 }}>
                                Video {i}
                            </div>
                        ))}
                    </div>
                    <p style={{ color: '#888', fontSize: 11, marginTop: 8 }}>[Videos loaded dynamically from theme library]</p>
                </div>
            </>
        );
    },
    save: () => null,
});
