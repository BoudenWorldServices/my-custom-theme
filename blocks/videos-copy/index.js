import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { leftHeading, leftP1, leftP2, rightHeading, rightP1, rightP2 } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fafafa', padding: '16px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Left Column" initialOpen>
                        <TextControl label="Heading" value={leftHeading} onChange={v => setAttributes({ leftHeading: v })} />
                        <TextareaControl label="Paragraph 1" value={leftP1} onChange={v => setAttributes({ leftP1: v })} />
                        <TextareaControl label="Paragraph 2" value={leftP2} onChange={v => setAttributes({ leftP2: v })} />
                    </PanelBody>
                    <PanelBody title="Right Column" initialOpen={false}>
                        <TextControl label="Heading" value={rightHeading} onChange={v => setAttributes({ rightHeading: v })} />
                        <TextareaControl label="Paragraph 1" value={rightP1} onChange={v => setAttributes({ rightP1: v })} />
                        <TextareaControl label="Paragraph 2" value={rightP2} onChange={v => setAttributes({ rightP2: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps} style={{ ...blockProps.style, display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 24 }}>
                    <div>
                        <h3 style={{ color: '#020202', fontSize: 16, marginBottom: 8 }}>{leftHeading}</h3>
                        <p style={{ color: '#666', fontSize: 13, marginBottom: 6 }}>{leftP1}</p>
                        <p style={{ color: '#666', fontSize: 13 }}>{leftP2}</p>
                    </div>
                    <div>
                        <h3 style={{ color: '#020202', fontSize: 16, marginBottom: 8 }}>{rightHeading}</h3>
                        <p style={{ color: '#666', fontSize: 13, marginBottom: 6 }}>{rightP1}</p>
                        <p style={{ color: '#666', fontSize: 13 }}>{rightP2}</p>
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
