import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';

registerBlockType( 'goliath/svc-two-articles', {
    edit( { attributes, setAttributes } ) {
        const { article1Icon, article1Heading, article1Paragraphs, article1Bold, article1SubHeading, article1Items, article2Icon, article2Heading, article2Paragraphs, article2Bold, article2SubHeading, article2Items, bannerText } = attributes;
        const renderArticleControls = ( prefix, icon, heading, paragraphs, bold, subHeading, items ) => (
            <>
                <TextControl label="Icon URL" value={ icon } onChange={ v => setAttributes({ [prefix + 'Icon']: v }) } />
                <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ [prefix + 'Heading']: v }) } />
                { paragraphs.map( (p, i) => (
                    <div key={i} style={{ marginBottom: '6px' }}>
                        <TextareaControl label={`Para ${i+1}`} value={p} onChange={ v => { const n=[...paragraphs]; n[i]=v; setAttributes({ [prefix+'Paragraphs']: n }); }} />
                        <Button isDestructive isSmall onClick={ () => setAttributes({ [prefix+'Paragraphs']: paragraphs.filter((_,idx)=>idx!==i) }) }>Remove</Button>
                    </div>
                ))}
                <Button isSecondary isSmall onClick={ () => setAttributes({ [prefix+'Paragraphs']: [...paragraphs, ''] }) }>+ Para</Button>
                <TextControl label="Bold text" value={ bold } onChange={ v => setAttributes({ [prefix + 'Bold']: v }) } />
                <TextControl label="Sub-heading" value={ subHeading } onChange={ v => setAttributes({ [prefix + 'SubHeading']: v }) } />
                { items.map( (item, i) => (
                    <div key={i} style={{ marginBottom: '6px' }}>
                        <TextControl label={`List ${i+1}`} value={item} onChange={ v => { const n=[...items]; n[i]=v; setAttributes({ [prefix+'Items']: n }); }} />
                        <Button isDestructive isSmall onClick={ () => setAttributes({ [prefix+'Items']: items.filter((_,idx)=>idx!==i) }) }>Remove</Button>
                    </div>
                ))}
                <Button isSecondary isSmall onClick={ () => setAttributes({ [prefix+'Items']: [...items, ''] }) }>+ Item</Button>
            </>
        );
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Article 1">
                        { renderArticleControls('article1', article1Icon, article1Heading, article1Paragraphs, article1Bold, article1SubHeading, article1Items) }
                    </PanelBody>
                    <PanelBody title="Article 2">
                        { renderArticleControls('article2', article2Icon, article2Heading, article2Paragraphs, article2Bold, article2SubHeading, article2Items) }
                    </PanelBody>
                    <PanelBody title="Orange Banner" initialOpen={false}>
                        <TextareaControl label="Banner text" value={ bannerText } onChange={ v => setAttributes({ bannerText: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px', padding: '20px', border: '1px solid #e5e7eb' }}>
                    <div><strong>{ article1Heading || 'Article 1' }</strong></div>
                    <div><strong>{ article2Heading || 'Article 2' }</strong></div>
                </div>
            </div>
        );
    },
    save() { return null; }
} );
