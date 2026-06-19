import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit({ attributes, setAttributes }) {
        const {
            eyebrow, heading, body,
            caseImg1, caseImg2, caseImg3,
            viewCaseStudiesText, viewCaseStudiesUrl,
            kpiEyebrow, kpiHeading, kpiSubheading,
            kpi1Value, kpi1Label, kpi2Value, kpi2Label, kpi3Value, kpi3Label,
            expertBadge, expertHeadline,
            expertFeature1Title, expertFeature1Sub,
            expertFeature2Title, expertFeature2Sub,
            expertFeature3Title, expertFeature3Sub,
            expertCta1Text, expertCta1Url, expertCta2Text, expertCta2Url,
        } = attributes;
        const blockProps = useBlockProps({ style: { background: '#f5f5f5', padding: '16px' } });

        const renderImageControl = (label, value, attrKey) => (
            <MediaUploadCheck>
                <div style={{ marginBottom: 16 }}>
                    <p style={{ marginBottom: 4, fontWeight: 600, fontSize: 11, textTransform: 'uppercase' }}>{label}</p>
                    {value && <img src={value} alt="" style={{ maxWidth: '100%', marginBottom: 8, borderRadius: 2 }} />}
                    <MediaUpload
                        onSelect={(media) => setAttributes({ [attrKey]: media.url })}
                        allowedTypes={['image']}
                        value={value}
                        render={({ open }) => (
                            <div>
                                <Button variant="secondary" onClick={open} style={{ marginRight: 8 }}>
                                    {value ? 'Replace' : 'Select image'}
                                </Button>
                                {value && (
                                    <Button variant="link" isDestructive onClick={() => setAttributes({ [attrKey]: '' })}>
                                        Remove
                                    </Button>
                                )}
                            </div>
                        )}
                    />
                </div>
            </MediaUploadCheck>
        );

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Case Study" initialOpen>
                        <TextControl label="Eyebrow" value={eyebrow} onChange={v => setAttributes({ eyebrow: v })} />
                        <TextareaControl label="Heading" value={heading} onChange={v => setAttributes({ heading: v })} />
                        <TextareaControl label="Body" value={body} onChange={v => setAttributes({ body: v })} />
                    </PanelBody>

                    <PanelBody title="Case Study Images" initialOpen={false}>
                        {renderImageControl('Main image (left)', caseImg1, 'caseImg1')}
                        {renderImageControl('Secondary image (top-right)', caseImg2, 'caseImg2')}
                        {renderImageControl('Third image (bottom-right)', caseImg3, 'caseImg3')}
                    </PanelBody>

                    <PanelBody title="Case Studies Card" initialOpen={false}>
                        <TextControl label="Card text" value={viewCaseStudiesText} onChange={v => setAttributes({ viewCaseStudiesText: v })} />
                        <TextControl label="Card URL" value={viewCaseStudiesUrl} onChange={v => setAttributes({ viewCaseStudiesUrl: v })} />
                    </PanelBody>

                    <PanelBody title="KPI Stats" initialOpen={false}>
                        <TextControl label="Eyebrow" value={kpiEyebrow} onChange={v => setAttributes({ kpiEyebrow: v })} />
                        <TextControl label="Heading" value={kpiHeading} onChange={v => setAttributes({ kpiHeading: v })} />
                        <TextareaControl label="Subheading" value={kpiSubheading} onChange={v => setAttributes({ kpiSubheading: v })} />
                        <hr />
                        <TextControl label="KPI 1 value" value={kpi1Value} onChange={v => setAttributes({ kpi1Value: v })} />
                        <TextControl label="KPI 1 label" value={kpi1Label} onChange={v => setAttributes({ kpi1Label: v })} />
                        <hr />
                        <TextControl label="KPI 2 value" value={kpi2Value} onChange={v => setAttributes({ kpi2Value: v })} />
                        <TextControl label="KPI 2 label" value={kpi2Label} onChange={v => setAttributes({ kpi2Label: v })} />
                        <hr />
                        <TextControl label="KPI 3 value" value={kpi3Value} onChange={v => setAttributes({ kpi3Value: v })} />
                        <TextControl label="KPI 3 label" value={kpi3Label} onChange={v => setAttributes({ kpi3Label: v })} />
                    </PanelBody>

                    <PanelBody title="Expert Section" initialOpen={false}>
                        <TextControl label="Badge text" value={expertBadge} onChange={v => setAttributes({ expertBadge: v })} />
                        <TextareaControl label="Headline" value={expertHeadline} onChange={v => setAttributes({ expertHeadline: v })} />
                        <hr />
                        <TextControl label="Feature 1 title" value={expertFeature1Title} onChange={v => setAttributes({ expertFeature1Title: v })} />
                        <TextControl label="Feature 1 subtitle" value={expertFeature1Sub} onChange={v => setAttributes({ expertFeature1Sub: v })} />
                        <hr />
                        <TextControl label="Feature 2 title" value={expertFeature2Title} onChange={v => setAttributes({ expertFeature2Title: v })} />
                        <TextControl label="Feature 2 subtitle" value={expertFeature2Sub} onChange={v => setAttributes({ expertFeature2Sub: v })} />
                        <hr />
                        <TextControl label="Feature 3 title" value={expertFeature3Title} onChange={v => setAttributes({ expertFeature3Title: v })} />
                        <TextControl label="Feature 3 subtitle" value={expertFeature3Sub} onChange={v => setAttributes({ expertFeature3Sub: v })} />
                        <hr />
                        <TextControl label="CTA 1 text" value={expertCta1Text} onChange={v => setAttributes({ expertCta1Text: v })} />
                        <TextControl label="CTA 1 URL" value={expertCta1Url} onChange={v => setAttributes({ expertCta1Url: v })} />
                        <hr />
                        <TextControl label="CTA 2 text" value={expertCta2Text} onChange={v => setAttributes({ expertCta2Text: v })} />
                        <TextControl label="CTA 2 URL" value={expertCta2Url} onChange={v => setAttributes({ expertCta2Url: v })} />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <p style={{ color: '#888', fontSize: 11, textTransform: 'uppercase', margin: 0 }}>{eyebrow}</p>
                    <h2 style={{ fontSize: 18, color: '#020202', margin: '4px 0 8px' }}>{heading}</h2>
                    <p style={{ color: '#555', fontSize: 13, marginBottom: 16 }}>{body}</p>
                    <div style={{ background: '#020202', color: '#fff', padding: '12px 16px', borderRadius: 2 }}>
                        <p style={{ margin: 0, fontWeight: 700, fontSize: 14 }}>Expert Section: {expertHeadline}</p>
                        <p style={{ margin: '4px 0 0', fontSize: 12, color: '#ff5c00' }}>KPI: {kpi1Value} {kpi1Label} · {kpi2Value} {kpi2Label} · {kpi3Value} {kpi3Label}</p>
                    </div>
                </div>
            </>
        );
    },
    save: () => null,
});
