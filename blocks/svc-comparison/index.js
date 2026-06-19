import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const { heading, description, bannerHeading, bannerDesc, row1LeftTitle, row1RightTitle, row2LeftTitle, row2RightTitle } = attributes;
        const blockProps = useBlockProps({ style: { background: '#fafafa', padding: '16px' } });

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Section Header" initialOpen>
                        <TextControl label="Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextareaControl label="Description" value={description} onChange={v => setAttributes({ description: v })} />
                    </PanelBody>
                    <PanelBody title="Row 1" initialOpen={false}>
                        <TextControl label="Left Title" value={attributes.row1LeftTitle} onChange={v => setAttributes({ row1LeftTitle: v })} />
                        <TextControl label="Left Desc" value={attributes.row1LeftDesc} onChange={v => setAttributes({ row1LeftDesc: v })} />
                        <TextControl label="Right Title" value={attributes.row1RightTitle} onChange={v => setAttributes({ row1RightTitle: v })} />
                        <TextControl label="Right Desc" value={attributes.row1RightDesc} onChange={v => setAttributes({ row1RightDesc: v })} />
                    </PanelBody>
                    <PanelBody title="Row 2" initialOpen={false}>
                        <TextControl label="Left Title" value={attributes.row2LeftTitle} onChange={v => setAttributes({ row2LeftTitle: v })} />
                        <TextControl label="Left Desc" value={attributes.row2LeftDesc} onChange={v => setAttributes({ row2LeftDesc: v })} />
                        <TextControl label="Right Title" value={attributes.row2RightTitle} onChange={v => setAttributes({ row2RightTitle: v })} />
                        <TextControl label="Right Desc" value={attributes.row2RightDesc} onChange={v => setAttributes({ row2RightDesc: v })} />
                    </PanelBody>
                    <PanelBody title="Row 3" initialOpen={false}>
                        <TextControl label="Left Title" value={attributes.row3LeftTitle} onChange={v => setAttributes({ row3LeftTitle: v })} />
                        <TextControl label="Left Desc" value={attributes.row3LeftDesc} onChange={v => setAttributes({ row3LeftDesc: v })} />
                        <TextControl label="Right Title" value={attributes.row3RightTitle} onChange={v => setAttributes({ row3RightTitle: v })} />
                        <TextControl label="Right Desc" value={attributes.row3RightDesc} onChange={v => setAttributes({ row3RightDesc: v })} />
                    </PanelBody>
                    <PanelBody title="Row 4" initialOpen={false}>
                        <TextControl label="Left Title" value={attributes.row4LeftTitle} onChange={v => setAttributes({ row4LeftTitle: v })} />
                        <TextControl label="Left Desc" value={attributes.row4LeftDesc} onChange={v => setAttributes({ row4LeftDesc: v })} />
                        <TextControl label="Right Title" value={attributes.row4RightTitle} onChange={v => setAttributes({ row4RightTitle: v })} />
                        <TextControl label="Right Desc" value={attributes.row4RightDesc} onChange={v => setAttributes({ row4RightDesc: v })} />
                    </PanelBody>
                    <PanelBody title="Bottom Banner" initialOpen={false}>
                        <TextControl label="Banner Heading" value={bannerHeading} onChange={v => setAttributes({ bannerHeading: v })} />
                        <TextareaControl label="Banner Description" value={bannerDesc} onChange={v => setAttributes({ bannerDesc: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <h2 style={{ fontSize: 18, margin: '0 0 8px' }}>{heading}</h2>
                    <p style={{ color: '#666', fontSize: 13, marginBottom: 16 }}>{description}</p>
                    <div style={{ border: '1px solid #e0e0e0', padding: 12, marginBottom: 8, display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 8 }}>
                        <div><strong style={{ color: '#666' }}>{row1LeftTitle}</strong></div>
                        <div><strong style={{ color: '#ff5c00' }}>{row1RightTitle}</strong></div>
                        <div><strong style={{ color: '#666' }}>{row2LeftTitle}</strong></div>
                        <div><strong style={{ color: '#ff5c00' }}>{row2RightTitle}</strong></div>
                    </div>
                    <div style={{ background: '#ff5c00', padding: '10px 16px', color: '#fff', textAlign: 'center', fontWeight: 700 }}>{bannerHeading}</div>
                </div>
            </>
        );
    },
    save: () => null,
});
