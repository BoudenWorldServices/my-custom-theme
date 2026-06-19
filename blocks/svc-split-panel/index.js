import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl, Button } from '@wordpress/components';

registerBlockType( 'goliath/svc-split-panel', {
    edit( { attributes, setAttributes } ) {
        const { bgColor, heading, paragraphs, subHeading, tickItems, calloutText, calloutDesc, image, imageAlt, imagePosition, ctaText, ctaUrl } = attributes;
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody title="Layout">
                        <SelectControl label="Background" value={ bgColor } options={[ { label: 'Grey', value: 'grey' }, { label: 'White', value: 'white' }, { label: 'Dark', value: 'dark' } ]} onChange={ v => setAttributes({ bgColor: v }) } />
                        <SelectControl label="Image/callout position" value={ imagePosition } options={[ { label: 'Right', value: 'right' }, { label: 'Left', value: 'left' } ]} onChange={ v => setAttributes({ imagePosition: v }) } />
                    </PanelBody>
                    <PanelBody title="Text Content">
                        <TextControl label="Heading" value={ heading } onChange={ v => setAttributes({ heading: v }) } />
                        { paragraphs.map( ( p, i ) => (
                            <div key={ i } style={{ marginBottom: '8px' }}>
                                <TextareaControl label={ `Paragraph ${ i + 1 }` } value={ p } onChange={ v => { const n = [...paragraphs]; n[i] = v; setAttributes({ paragraphs: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ paragraphs: paragraphs.filter((_, idx) => idx !== i) }) }>Remove</Button>
                            </div>
                        ) ) }
                        <Button isSecondary isSmall onClick={ () => setAttributes({ paragraphs: [...paragraphs, ''] }) }>+ Add Paragraph</Button>
                        <TextControl label="Sub-heading" value={ subHeading } onChange={ v => setAttributes({ subHeading: v }) } />
                    </PanelBody>
                    <PanelBody title="Tick List" initialOpen={ false }>
                        { tickItems.map( ( item, i ) => (
                            <div key={ i } style={{ marginBottom: '8px' }}>
                                <TextControl label={ `Item ${ i + 1 }` } value={ item } onChange={ v => { const n = [...tickItems]; n[i] = v; setAttributes({ tickItems: n }); } } />
                                <Button isDestructive isSmall onClick={ () => setAttributes({ tickItems: tickItems.filter((_, idx) => idx !== i) }) }>Remove</Button>
                            </div>
                        ) ) }
                        <Button isSecondary isSmall onClick={ () => setAttributes({ tickItems: [...tickItems, ''] }) }>+ Add Item</Button>
                    </PanelBody>
                    <PanelBody title="Orange Callout" initialOpen={ false }>
                        <TextareaControl label="Callout text" value={ calloutText } onChange={ v => setAttributes({ calloutText: v }) } />
                        <TextareaControl label="Callout description" value={ calloutDesc } onChange={ v => setAttributes({ calloutDesc: v }) } />
                    </PanelBody>
                    <PanelBody title="Image" initialOpen={ false }>
                        <TextControl label="Image URL" value={ image } onChange={ v => setAttributes({ image: v }) } />
                        <TextControl label="Image alt text" value={ imageAlt } onChange={ v => setAttributes({ imageAlt: v }) } />
                    </PanelBody>
                    <PanelBody title="CTA" initialOpen={ false }>
                        <TextControl label="CTA text" value={ ctaText } onChange={ v => setAttributes({ ctaText: v }) } />
                        <TextControl label="CTA URL" value={ ctaUrl } onChange={ v => setAttributes({ ctaUrl: v }) } />
                    </PanelBody>
                </InspectorControls>
                <div style={{ display: 'flex', gap: '16px', padding: '20px', background: bgColor === 'dark' ? '#020202' : bgColor === 'grey' ? '#f8f8f8' : '#fff', border: '1px solid #e5e7eb' }}>
                    <div style={{ flex: 1 }}>
                        { heading && <h2 style={{ fontSize: '22px', fontWeight: 700, color: bgColor === 'dark' ? '#fff' : '#020202' }}>{ heading }</h2> }
                        { paragraphs.map( (p, i) => <p key={i} style={{ marginTop: '8px', color: bgColor === 'dark' ? '#ccc' : '#364153' }}>{p}</p> ) }
                    </div>
                    { calloutText && <div style={{ flex: '0 0 200px', background: '#ff5c00', padding: '16px', color: '#fff', fontWeight: 700 }}>{ calloutText }</div> }
                    { image && <div style={{ flex: '0 0 200px' }}><img src={ image } alt={ imageAlt } style={{ width: '100%', height: '120px', objectFit: 'cover' }} /></div> }
                </div>
            </div>
        );
    },
    save() { return null; }
} );
