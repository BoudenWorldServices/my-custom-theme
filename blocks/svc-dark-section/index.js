import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';

registerBlockType( 'goliath/svc-dark-section', {
    edit( { attributes, setAttributes } ) {
        const { heading, paragraphs, tickItems, afterListText, calloutIcon, calloutHeading, calloutDesc, boldText } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Text Content">
                        <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ heading: v }) } />
                        <TextControl label="Bold intro text" value={ boldText } onChange={ v => setAttributes({ boldText: v }) } />
                        { paragraphs.map( (p, i) => (
                            <div key={i} style={{ marginBottom: '6px' }}>
                                <TextareaControl label={`Paragraph ${i+1}`} value={p} onChange={ v => { const n=[...paragraphs]; n[i]=v; setAttributes({ paragraphs: n }); }} />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ paragraphs: paragraphs.filter((_,idx)=>idx!==i) }) }>Remove</Button>
                            </div>
                        ))}
                        <Button isSecondary isSmall onClick={ () => setAttributes({ paragraphs: [...paragraphs, ''] }) }>+ Para</Button>
                    </PanelBody>
                    <PanelBody title="Tick List" initialOpen={false}>
                        { tickItems.map( (item, i) => (
                            <div key={i} style={{ marginBottom: '6px' }}>
                                <TextControl label={`Item ${i+1}`} value={item} onChange={ v => { const n=[...tickItems]; n[i]=v; setAttributes({ tickItems: n }); }} />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ tickItems: tickItems.filter((_,idx)=>idx!==i) }) }>Remove</Button>
                            </div>
                        ))}
                        <Button isSecondary isSmall onClick={ () => setAttributes({ tickItems: [...tickItems, ''] }) }>+ Item</Button>
                        <TextareaControl label="Text after list" value={ afterListText } onChange={ v => setAttributes({ afterListText: v }) } />
                    </PanelBody>
                    <PanelBody title="Orange Callout Card">
                        <TextControl label="Icon URL" value={ calloutIcon } onChange={ v => setAttributes({ calloutIcon: v }) } />
                        <TextareaControl label="Callout heading" value={ calloutHeading } onChange={ v => setAttributes({ calloutHeading: v }) } />
                        <TextareaControl label="Callout description" value={ calloutDesc } onChange={ v => setAttributes({ calloutDesc: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ display: 'flex', gap: '16px', padding: '20px', background: '#020202', border: '1px solid #333' }}>
                    { calloutHeading && <div style={{ flex: '0 0 180px', background: '#ff5c00', padding: '16px', color: '#fff', fontWeight: 700 }}>{ calloutHeading }</div> }
                    <div style={{ flex: 1, color: '#fff' }}>
                        { heading && <h2 style={{ fontSize: '20px', fontWeight: 700 }}>{ heading }</h2> }
                        { paragraphs.map( (p, i) => <p key={i} style={{ marginTop: '6px', color: '#ccc' }}>{p}</p> ) }
                    </div>
                </div>
            </div>
        );
    },
    save() { return null; }
} );
